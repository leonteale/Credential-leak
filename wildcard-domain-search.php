<?php
//This is the session handling bit
if(isset($_SESSION['session_id']) && $_SESSION['session_id'] == $_POST['session_id']){
    // process form data
    unset($_SESSION['session_id']);
} else {
    // display error message
    echo "Invalid session ID. Please try again.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the domain from the form submission
  $domain = $_POST['domain'];
// Build the h8mail command using the escaped email address
    $command = "ls";
	$escaped_command = escapeshellcmd($command);
	$output = shell_exec($escaped_command);
  echo "<pre>$output</pre>";
}
?>