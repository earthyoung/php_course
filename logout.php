<?php

include "util.php";

setcookie("id", "", time(), "/");
setcookie("name", "", time(), "/");
setcookie("type", "", time(), "/");

$form = "
<h2>You are logged out.</h2>
";

echo basis($form, "");

?>