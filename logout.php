<?php
include "inc/main.php";

session_destroy();
header('location: login.php');
die;