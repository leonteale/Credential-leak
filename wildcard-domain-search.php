<?php
$_SESSION['form_data'] = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the domain from the form submission
  $domain = $_POST['domain'];
// Build the h8mail command using the escaped domain
    $command = "echo $domain";
	$escaped_command = escapeshellcmd($command);
	$output = shell_exec($escaped_command);
  echo "<pre>$output</pre>";
}
?>