<?php
session_start();
require "connection.php";
session_destroy();
header("location: login.html");
?>