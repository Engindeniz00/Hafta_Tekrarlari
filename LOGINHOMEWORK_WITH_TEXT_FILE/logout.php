<?php
session_start();
session_destroy();
header("Location:index.php");
header("Refresh:index.php");
?>
