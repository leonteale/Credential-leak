<?php

//This is the session handling bit
session_start();
if(isset($_SESSION['session_id']) && $_SESSION['session_id'] == $_POST['session_id']){
    // process form data
    unset($_SESSION['session_id']);
} else {
    // display error message
    echo "Invalid session ID. Please try again.";
}


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