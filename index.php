<!-- HTML document with a black background, green text, and a Bootstrap CSS file linked from a CDN -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!-- CSS styles to apply to the body, container, headings, table, form, and input elements -->
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
  <!-- Container element with a white background and rounded corners -->
  <div class="container">
<!-- Page heading -->
<h1>Credential-Leak</h1>

<!-- Form with an input field for an email address and a submit button -->
<form method="post">
  Email address: <input type="text" name="email"><br>
  <input type="submit" value="Submit">
</form> 

<!-- Table with a caption, headings, and table rows for each file in the '../wildcard' directory -->
<table>
  <caption>Quick Links - These are pre-searched wildcards on their respective domains</caption>
  <tr>
    <th>Link</th>
    <th>Description</th>
  </tr>
  
  <!-- PHP script that checks for processes running for '/home/leon/.local/bin/h8mail' and prints a message accordingly -->
  <?php
    $command = "ps aux | grep '/home/leon/.local/bin/h8mail' | grep -v grep";
    $output = shell_exec($command);

    if (trim($output) != "") {
        preg_match('/-t ([^\s]+)/', $output, $matches);
        $domain = $matches[1];
        echo "Search currently in progress for $domain";
    } else {
        echo "Program free to search";
    }
  ?>

  <!-- PHP script that generates a table row for each file in the '../wildcard' directory -->
  <?php
    $dir = '../wildcard';
    $files = scandir($dir);
    foreach($files as $file) {
      if($file !== '.' && $file !== '..') {
        // generate a table row for each file
        echo '<tr>';
        echo '<td><a href="../wildcard/' . $file . '">' . $file . '</a></td>';
        echo '<td>' . file_get_contents($dir . '/' . $file) . '</td>';
        echo '</tr>';
      }
    }
  ?>
</table>

<!-- Footer with a link to a GitHub repository -->
<p><a href="https://github.com/Leon-nn/Credential-Leak">GitHub</a></p>
  </div>
</body>
</html>
