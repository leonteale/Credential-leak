<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style>
    body {
      background-color: black;
      color: green;
      font-family: Arial, sans-serif;
      text-align: center;
    }
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
      margin: 20px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    td, th {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
    }
    th {
      background-color: #4caf50;
      color: white;
    }
    form {
      width: 100%;
      text-align: left;
    }
    input[type="text"] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #4caf50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    .error {
      color: red;
    }
    @media (max-width: 600px) {
      table, form {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Credential-Leak</h1>
    <form method="post">
      Email address: <input type="text" name="email"><br>
      <input type="submit" value="Submit">
    </form> 
	
<!-- this will submit the wildcard search -->
	<div id="domainSearch" style="display:none;">
  <form method="post">
    Domain: <input type="text" id="domainInput" name="domain"><br>
    <input type="submit" value="Submit" onclick="submitDomain()">
  </form>
  </div>

<table>
  <caption>Quick Links - These are pre-searched wildcards on their respective domains</caption>
  <tr>
    <th>Link</th>
    <th>Description</th>
  </tr>
 
<!-- this will show and hide the wildcardsearch form -->
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

<?php

$command = "ps aux | grep '/home/leon/.local/bin/h8mail' | grep -v grep";
$output = shell_exec($command);

if (trim($output) != "") {
    preg_match('/-t ([^\s]+)/', $output, $matches);
    $domain = $matches[1];
    echo "Search currently in progress for $domain";
} else {
    echo "Program free for wildcard search. Search <a href='javascript:void(0);' onclick='toggleSearch()'>here</a>";
}

?>

<?php
  $dir = '../wildcard';
  $files = scandir($dir);
  foreach($files as $file) {
    if($file !== '.' && $file !== '..') {
      // Remove the '.txt' extension from the file name
      $link = str_replace('.txt', '', $file);
      // Generate a table row for each file
      echo '<tr>';
      echo '<td><a href="/leak/wildcard/' . $file . '">' . $link . '</a></td>';
      echo '<td>A listing of all emails associated with this domain</td>';
      echo '</tr>';
    }
  }
?>

  
</table>
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

  </div>
</body>
</html>