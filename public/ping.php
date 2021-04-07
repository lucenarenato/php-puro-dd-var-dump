<html>
<head>
<title>ping host</title>
</head>
<body>
<form method="GET" action="">
  <input type="text" name="host" />
  <input type="submit" value="ping host" />
</form>
<?php
if(isset($_GET['host'])) {
  $output = shell_exec("ping -c1 ".$_GET['host']);
  echo "<pre>$output</pre>";
}
?>
</body>
</html>
