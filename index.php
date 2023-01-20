<!DOCTYPE html>
<html>
<head>
<!-- This is the CSS -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

 <!-- This is where the scripts go -->
 
	<!-- This will show and hide the wildcardsearch form -->
	<?php include 'wild-card-form-show-hide.php';?>

</head>

<body>
  <div class="container">
    <h1>Credential-Leak v2</h1>

		<!-- this is the form for email search -->
		<?php include 'email-form.html';?>
			
		<!-- this is the form for wildcard domain search -->
		<?php include 'wildcard-domain-form.html';?>

		 <!-- This is the PHP to check if there is an active wildcard search or not -->
		<?php include 'check-wildcard-process.php';?>

		<!-- this is the table with quick links for previous wildcard searches -->
		<?php include 'wildcard-table-quick-links.html';?>

		<!-- This is the PHP to process the submitted data for EMAIL -->
		<?php include 'email-search.php';?>
		
		<!-- This is the PHP to process the submitted data for DOMAIN -->
		<?php include 'wildcard-domain-search.php';?>

  </div>
</body>
</html>