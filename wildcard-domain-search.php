<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the email address from the form submission
  $domain = $_POST['domain'];

  // Validate the email address using a regular expression
  $pattern = '/[^a-zA-Z0-9.-]/';
  if (preg_match($pattern, $domain)) {
    // Escape special characters in the domain
    $escaped_domain = escapeshellarg($domain);

    // Build the h8mail command using the escaped email address
    $command = "ls";

    // Escape special characters in the command to prevent command injection
    $escaped_command = escapeshellcmd($command);

    // Run the h8mail command
    $output = shell_exec($escaped_command);

    // Output the result of the h8mail command in a table format
    echo 'crunning search on ' + $escaped_domain;
	echo $output
  } else {
    // Input is not a valid email address
    echo '<p class="error">Error: Please enter a valid domain.</p>';
  }
}
?>