<?php
session_start();
session_destroy();
echo "Loggin Out...";
header('location:index.php');