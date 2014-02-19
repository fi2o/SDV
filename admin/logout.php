<?php
require '../config.php';

session_unset();
session_destroy();

goto2('admin/login.php');
?>
