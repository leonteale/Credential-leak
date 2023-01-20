  <?php
if(isset($_POST['domain'])) {
  $domain = $_POST['domain'];
  $output = exec("dig $domain");
  echo "<pre>$output</pre>";
}
?>