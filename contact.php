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
			<form class="form-horizontal" role="form" method="post" action="contact.php">
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input name="firstname" type="text" id="firstname" class="human" value="<?php echo htmlspecialchars($_POST['name']); ?>">
						<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['firstname']); ?>">
						<?php echo "<p class='text-danger'>$errName</p>";?>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
						<?php echo "<p class='text-danger'>$errEmail</p>";?>
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="col-sm-2 control-label">Message</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="4" name="message">
							<?php echo htmlspecialchars($_POST['message']);?>
						</textarea>
						<?php echo "<p class='text-danger'>$errMessage</p>";?>
					</div>
				</div>
				<div class="form-group">
					<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
						<?php echo "<p class='text-danger'>$errHuman</p>";?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary"> </div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo $result; ?>
					</div>
				</div>
			</form>
		</div>
		</div>

<?php include('footer.php'); ?>

</body>
</html>