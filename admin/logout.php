<?php
session_start();
unset($_SESSION['userName']);
unset($_SESSION['username']);
unset($_SESSION['userlname']);
unset($_SESSION['token']);
unset($token);
header("Location: /index.php");
