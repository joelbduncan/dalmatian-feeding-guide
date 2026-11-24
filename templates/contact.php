<?php /** @var array $site @var ?array $page @var ?ContactForm $form */ ?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight narrow">
  <?php if (!empty($page['html'])): ?>
    <div class="prose"><?= $page['html'] ?></div>
  <?php endif ?>

  <?php if (!$form): ?>
    <p class="callout">The contact form isn't set up yet. Add your SMTP details to <code>config.local.php</code>.</p>

  <?php elseif ($form->sent): ?>
    <div class="notice notice-success" role="status">
      <h2>Thanks, your message is on its way</h2>
      <p>We'll get back to you as soon as we can.</p>
      <p><a href="/">Back to the home page</a></p>
    </div>

  <?php else: $err = $form->errors; $old = $form->old; ?>
    <?php if (isset($err['form'])): ?>
      <p class="notice notice-error" role="alert"><?= e($err['form']) ?></p>
    <?php endif ?>

    <form class="form card" action="/contact" method="post" novalidate>
      <input type="hidden" name="_token" value="<?= e($form->token()) ?>">

      <div class="field<?= isset($err['name']) ? ' has-error' : '' ?>">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" autocomplete="name" maxlength="100" required
               value="<?= e($old['name']) ?>" <?= isset($err['name']) ? 'aria-invalid="true" aria-describedby="name-error"' : '' ?>>
        <?php if (isset($err['name'])): ?><p class="field-error" id="name-error"><?= e($err['name']) ?></p><?php endif ?>
      </div>

      <div class="field<?= isset($err['email']) ? ' has-error' : '' ?>">
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" autocomplete="email" required
               value="<?= e($old['email']) ?>" <?= isset($err['email']) ? 'aria-invalid="true" aria-describedby="email-error"' : '' ?>>
        <?php if (isset($err['email'])): ?><p class="field-error" id="email-error"><?= e($err['email']) ?></p><?php endif ?>
      </div>

      <div class="field<?= isset($err['message']) ? ' has-error' : '' ?>">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" maxlength="5000" required
                  <?= isset($err['message']) ? 'aria-invalid="true" aria-describedby="message-error"' : '' ?>><?= e($old['message']) ?></textarea>
        <?php if (isset($err['message'])): ?><p class="field-error" id="message-error"><?= e($err['message']) ?></p><?php endif ?>
      </div>

      <!-- Spam trap: hidden from people, but bots fill it in. -->
      <div class="visually-hidden" aria-hidden="true">
        <label for="hp_field">Leave this empty</label>
        <input id="hp_field" name="hp_field" type="text" tabindex="-1" autocomplete="off">
      </div>

      <button class="button" type="submit">Send message</button>
      <p class="muted form-note">We'll only use your email address to reply to you.</p>
    </form>
  <?php endif ?>
</div>
