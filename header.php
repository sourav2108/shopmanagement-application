<?php
session_start();
session_regenerate_id(true);
if(!isset($_SESSION['uid']))
{
    header("location: login.html");
}
?>