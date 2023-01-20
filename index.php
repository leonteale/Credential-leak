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
 <script>
  function toggleSearch() {
    var searchBox = document.getElementById("domainSearch");
    if (searchBox.style.display === "none") {
      searchBox.style.display = "block";
    } else {
      searchBox.style.display = "none";
    }
  }
</script>
</head>

<body>
  <div class="container">
    <h1>Credential-Leak</h1>

<!-- this is the form for email search -->
	<?php include 'email-form.html';?>
	
<!-- this is the form for wildcard domain search -->
<?php include 'wildcard-domain-form.html';?>

 <!-- This is the PHP to check if there is an active wildcard search or not -->
	<?php include 'check-wildcard-process.php';?>

<!-- this is the table with quick links for previous wildcard searches -->
<?php include 'wildcard-table-quick-links.html';?>


 <!-- This is the PHP to process the submitted data for EMAIL -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the email address from the form submission
  $email = $_POST['email'];

  // Validate the email address using a regular expression
  $pattern = '/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/';
  if (preg_match($pattern, $email)) {
    // Escape special characters in the email address
    $escaped_email = escapeshellarg($email);

    // Build the h8mail command using the escaped email address
    $command = "/Wordlists/COMB/CompilationOfManyBreaches/query.sh $escaped_email";

    // Escape special characters in the command to prevent command injection
    $escaped_command = escapeshellcmd($command);

    // Run the h8mail command
    $output = shell_exec($escaped_command);

    // Save the email address to a text file
    file_put_contents('/var/www/html/leak/emails.txt', $escaped_email . PHP_EOL, FILE_APPEND);

    // Output the result of the h8mail command in a table format
    echo '<table>';
    echo '<tr>';
    echo '<th>Email Address</th>';
    echo '<th>Password</th>';
    echo '</tr>';
    $lines = explode("\n", $output);
    foreach ($lines as $line) {
      $columns = explode(":", $line);
      echo '<tr>';
      echo '<td>' . $columns[0] . '</td>';
      echo '<td>' . $columns[1] . '</td>';
      echo '</tr>';
    }
    echo '</table>';
  } else {
    // Input is not a valid email address
    echo '<p class="error">Error: Please enter a valid email address.</p>';
  }
}
?>


 <!-- This is the PHP to process the submitted data for DOMAIN -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the email address from the form submission
  $domain = $_POST['domain'];

  // Validate the email address using a regular expression
  $pattern = '/[^a-zA-Z0-9.-]/';
  if (preg_match($pattern, $domain)) {
    // Escape special characters in the email address
    $escaped_domain = escapeshellarg($domain);

    // Build the h8mail command using the escaped email address
    $command = "ls -la";

    // Escape special characters in the command to prevent command injection
    $escaped_command = escapeshellcmd($command);

    // Run the h8mail command
    $output = shell_exec($escaped_command);

    // Save the email address to a text file
    file_put_contents('/var/www/html/leak/wildcard.txt', $escaped_domain . PHP_EOL, FILE_APPEND);

    // Output the result of the h8mail command in a table format
    echo 'crunning search on ' + $escaped_domain;
  } else {
    // Input is not a valid email address
    echo '<p class="error">Error: Please enter a valid domain.</p>';
  }
}
?>

  </div>
</body>
</html>