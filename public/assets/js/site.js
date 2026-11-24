// Dalmatian Feeding Guide: small progressive enhancements, no dependencies.

// ----- Theme toggle -----
const root = document.documentElement;
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
const currentTheme = () => root.dataset.theme || (prefersDark.matches ? 'dark' : 'light');

document.querySelector('.theme-toggle')?.addEventListener('click', () => {
  const next = currentTheme() === 'dark' ? 'light' : 'dark';
  root.dataset.theme = next;
  try { localStorage.setItem('theme', next); } catch (e) { /* storage unavailable */ }
});

// ----- Mobile menu -----
const nav = document.getElementById('site-nav');
const navToggle = document.querySelector('.nav-toggle');
navToggle?.addEventListener('click', () => {
  const open = nav.classList.toggle('is-open');
  navToggle.setAttribute('aria-expanded', String(open));
});

// Dropdown menus. On small screens they're shown expanded as plain groups
// (no toggling, so nothing jumps). On larger screens only one is open at a time.
const menus = [...document.querySelectorAll('details.menu')];
const smallScreen = window.matchMedia('(max-width: 60rem)');

const syncMenus = () => menus.forEach((m) => { m.open = smallScreen.matches; });
syncMenus();
smallScreen.addEventListener('change', syncMenus);

menus.forEach((menu) => {
  menu.querySelector('summary').addEventListener('click', (e) => {
    if (smallScreen.matches) e.preventDefault();
  });
  menu.addEventListener('toggle', () => {
    if (menu.open && !smallScreen.matches) {
      menus.forEach((other) => { if (other !== menu) other.open = false; });
    }
  });
});

document.addEventListener('click', (e) => {
  if (smallScreen.matches) return;
  menus.forEach((m) => { if (!m.contains(e.target)) m.open = false; });
});
document.addEventListener('keydown', (e) => {
  if (e.key !== 'Escape') return;
  if (!smallScreen.matches) menus.forEach((m) => { m.open = false; });
  if (nav?.classList.contains('is-open')) { nav.classList.remove('is-open'); navToggle.setAttribute('aria-expanded', 'false'); }
});

// ----- Searchable, filterable, sortable tables -----
document.querySelectorAll('[data-table-tools]').forEach((tools) => {
  const table = document.getElementById(tools.dataset.tableTools);
  if (!table) return;

  const tbody = table.tBodies[0];
  const rows = [...tbody.rows];
  const search = tools.querySelector('[data-search]');
  const chips = [...tools.querySelectorAll('.chip')];
  const count = tools.querySelector('[data-count]');
  const empty = table.parentElement.querySelector('[data-empty]');
  let level = '';

  // Pre-compute search text once.
  rows.forEach((r) => { r._text = r.cells[0].textContent.toLowerCase(); });

  const apply = () => {
    const terms = search.value.toLowerCase().trim().split(/\s+/).filter(Boolean);
    let shown = 0;
    rows.forEach((r) => {
      const match = (!level || r.dataset.level === level) && terms.every((t) => r._text.includes(t));
      r.hidden = !match;
      if (match) shown++;
    });
    count.textContent = `${shown} ${shown === 1 ? 'food' : 'foods'}`;
    if (empty) empty.hidden = shown !== 0;
  };

  search.addEventListener('input', apply);
  chips.forEach((chip) => chip.addEventListener('click', () => {
    level = chip.dataset.level;
    chips.forEach((c) => c.setAttribute('aria-pressed', String(c === chip)));
    apply();
  }));

  // Allow linking to a pre-filled search, e.g. /purine-guide?q=chicken
  const q = new URLSearchParams(location.search).get('q');
  if (q) { search.value = q; apply(); }

  // Sorting
  const buttons = [...table.querySelectorAll('thead .sort')];
  const collator = new Intl.Collator('en', { sensitivity: 'base', numeric: true });

  buttons.forEach((btn) => {
    const index = btn.closest('th').cellIndex;
    const type = btn.dataset.sort;

    btn.addEventListener('click', () => {
      const dir = btn.getAttribute('aria-sort') === 'ascending' ? 'descending' : 'ascending';
      buttons.forEach((b) => { b.removeAttribute('aria-sort'); b.closest('th').removeAttribute('aria-sort'); });
      btn.setAttribute('aria-sort', dir);
      btn.closest('th').setAttribute('aria-sort', dir);
      const sign = dir === 'ascending' ? 1 : -1;

      const value = (row) => {
        const cell = row.cells[index];
        if (type === 'text') return cell.textContent.trim();
        const v = cell.dataset.value;
        return v === '' || v === undefined ? null : parseFloat(v);
      };

      const sorted = [...rows].sort((a, b) => {
        const va = value(a);
        const vb = value(b);
        if (type === 'text') return sign * collator.compare(va, vb);
        if (va === null && vb === null) return 0;
        if (va === null) return 1;   // blanks always last
        if (vb === null) return -1;
        return sign * (va - vb) || collator.compare(a._text, b._text);
      });
      tbody.append(...sorted);
    });
  });
});
