<?php
session_start();
unset($_SESSION['userName']);
unset($_SESSION['token']);
unset($token);
header("Location: /index.php");
