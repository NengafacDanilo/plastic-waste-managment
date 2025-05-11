<?php
session_start();
unset($firstName);
unset($id);
session_destroy();

header("Location: login.php");

?>