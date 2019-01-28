<?php
session_start();
unset($_SESSION['userName']);
header("Location: /admin/register.php");
