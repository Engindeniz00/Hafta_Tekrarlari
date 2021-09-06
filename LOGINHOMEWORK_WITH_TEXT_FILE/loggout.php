<?php
session_start();
session_destroy();
header("Location:indexes.php");
header("Refresh:indexes.php");
?>
