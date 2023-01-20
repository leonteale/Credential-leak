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
  <script>
    function toggleSearch() {
      var searchBox = document.getElementById("domainSearch");
      if (searchBox.style.display === "none") {
        searchBox.style.display = "block";
      } else {
        searchBox.style.display = "none";
      }
    }
    function submitDomain() {
      var domain = document.getElementById("domainInput").value;
      domain = domain.replace(/[^a-zA-Z0-9.-]/g, '');
      var command = "/home/leon/.local/bin/h8mail -t " + domain + " -sk -lb /Wordlists/COMB/CompilationOfManyBreaches/ --loose > /tmp/" + domain + " &";
      var output = shell_exec(command);
      console.log(output);
    }
  </script>
  <script>
  function submitEmail() {
    var email = document.getElementById("emailInput").value;
    // Sanitize the input
    email = email.replace(/[^a-zA-Z0-9@.-]/g, '');
    // Use the email address to retrieve the results
    // Example: 
    // var results = retrieveResults(email);
    //console.log(results);
  }
</script>
</head>
<body>
  <div class="container">
    <h1>Credential-Leak</h1>
    <form method="post">
      Email address: <input type="text" id="emailInput" name="email">
<br>
      <input type="submit" value="Submit" onclick="submitEmail()">
    </form> 
    <table>
      <caption>Quick Links - These are pre-searched wildcards on their respective domains</caption>
      <tr>
        <th>Link</th>
        <th>Description</th>
      </tr>
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
            $link = str_replace('.txt', '', $file);
            echo "<tr><td><a href='$link'>$link</a></td><td>Description for $link</td></tr>";
          }
        }
      ?>
    </table>
    <div id="domainSearch" style="display:none;">
      <form method="post">
        Domain: <input type="text" id="domainInput" name="domain"><br>
        <input type="button" value="Submit" onclick="submitDomain()">
      </form>
    </div>
  </div>
</body>
</html>
