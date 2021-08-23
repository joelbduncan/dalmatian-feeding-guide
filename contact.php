<?php
if($_POST['firstname'] != ''){
  //die("You spammer!");
  header('Location: /contact.php');
  die("");
  }

 if (isset($_POST["submit"])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $message = $_POST['message'];
   $human = intval($_POST['human']);
   $from = 'Dalmatian Feeding Guide';
   $to = 'joel@slethen.io';
   $subject = 'Message from Dalmatian Feeding Guide';

   $body = "From: $name\n E-Mail: $email\n Message:\n $message";

   // Check if name has been entered
   if (!$_POST['name']) {
     $errName = 'Please enter your name';
   }

   // Check if email has been entered and is valid
   if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
     $errEmail = 'Please enter a valid email address';
   }

   //Check if message has been entered
   if (!$_POST['message']) {
     $errMessage = 'Please enter your message';
   }
   //Check if simple anti-bot test is correct
   if ($human !== 5) {
     $errHuman = 'Your anti-spam is incorrect';
   }

 // If there are no errors, send the email
 if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
   if (mail ($to, $subject, $body, $from)) {
     $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
   } else {
     $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
   }
 }
   }
?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dalmatian Feeding Guide</title>
<style>
  .human {
    display: none;
  }

  main > .container {
    padding: 50px 15px 0;
  }
</style>

<head>
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script async defer data-domain="dalmatian-feeding-guide.org" src="https://plausible.joelduncan.io/js/plausible.js"></script>
	<link rel="stylesheet" type="text/css" href="//bootswatch.com/4/flatly/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-table.css"> </head>

<body>
	<?php include('navbar.php'); ?>
		<main role="main" class="flex-shrink-0">
			<div class="container">
				<div class="jumbotron">
					<h1>Contact Us</h1>
					<p>If you have any questions, advice or content you would like to add feel free to fill in the contact form below.</p>
					<p>We would love to hear from you!</p>
					<p><img src="img/paw-print.png" alt="paw print"></p>
				</div>
			</div>
		</main>
		<div class="container">
			<form id="fs-frm" name="simple-contact-form" accept-charset="utf-8" action="https://formspree.io/f/{form_id}" method="post">
			<fieldset id="fs-frm-inputs">
				<label for="full-name">Full Name</label>
				<input type="text" name="name" id="full-name" placeholder="First and Last" required="">
				<label for="email-address">Email Address</label>
				<input type="email" name="_replyto" id="email-address" placeholder="email@domain.tld" required="">
				<label for="message">Message</label>
				<textarea rows="5" name="message" id="message" placeholder="Your message." required=""></textarea>
				<input type="hidden" name="_subject" id="email-subject" value="Contact Form Submission">
			</fieldset>
			<input type="submit" value="Submit">
			</form><style>/* reset */
			#fs-frm input,
			#fs-frm select,
			#fs-frm textarea,
			#fs-frm fieldset,
			#fs-frm optgroup,
			#fs-frm label,
			#fs-frm #card-element:disabled {
			font-family: inherit;
			font-size: 100%;
			color: inherit;
			border: none;
			border-radius: 0;
			display: block;
			width: 100%;
			padding: 0;
			margin: 0;
			-webkit-appearance: none;
			-moz-appearance: none;
			}
			#fs-frm label,
			#fs-frm legend,
			#fs-frm ::placeholder {
			font-size: .825rem;
			margin-bottom: .5rem;
			padding-top: .2rem;
			display: flex;
			align-items: baseline;
			}

			/* border, padding, margin, width */
			#fs-frm input,
			#fs-frm select,
			#fs-frm textarea,
			#fs-frm #card-element {
			border: 1px solid rgba(0,0,0,0.2);
			background-color: rgba(255,255,255,0.9);
			padding: .75em 1rem;
			margin-bottom: 1.5rem;
			}
			#fs-frm input:focus,
			#fs-frm select:focus,
			#fs-frm textarea:focus {
			background-color: white;
			outline-style: solid;
			outline-width: thin;
			outline-color: gray;
			outline-offset: -1px;
			}
			#fs-frm [type="text"],
			#fs-frm [type="email"] {
			width: 100%;
			}
			#fs-frm [type="button"],
			#fs-frm [type="submit"],
			#fs-frm [type="reset"] {
			width: auto;
			cursor: pointer;
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;
			}
			#fs-frm [type="button"]:focus,
			#fs-frm [type="submit"]:focus,
			#fs-frm [type="reset"]:focus {
			outline: none;
			}
			#fs-frm [type="submit"],
			#fs-frm [type="reset"] {
			margin-bottom: 0;
			}
			#fs-frm select {
			text-transform: none;
			}

			#fs-frm [type="checkbox"] {
			-webkit-appearance: checkbox;
			-moz-appearance: checkbox;
			appearance: checkbox;
			display: inline-block;
			width: auto;
			margin: 0 .5em 0 0 !important;
			}

			#fs-frm [type="radio"] {
			-webkit-appearance: radio;
			-moz-appearance: radio;
			appearance: radio;
			}

			/* address, locale */
			#fs-frm fieldset.locale input[name="city"],
			#fs-frm fieldset.locale select[name="state"],
			#fs-frm fieldset.locale input[name="postal-code"] {
			display: inline;
			}
			#fs-frm fieldset.locale input[name="city"] {
			width: 52%;
			}
			#fs-frm fieldset.locale select[name="state"],
			#fs-frm fieldset.locale input[name="postal-code"] {
			width: 20%;
			}
			#fs-frm fieldset.locale input[name="city"],
			#fs-frm fieldset.locale select[name="state"] {
			margin-right: 3%;
			}
			</style>
		</div>
		</div>

<?php include('footer.php'); ?>

</body>
</html>