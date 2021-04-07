<?php

  $output = shell_exec("ifconfig");
  echo "<pre>$output</pre>";

?>
