<?php
$dsn = "mysql:host=localhost;dbname=tour";
$user = "root";
$pass = "";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",

);
try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
// في حال ما اتصل بنعمل كاتش  للايرور 
catch (PDOException $e) {
    echo "failed to connect" . $e->getMessage();
}

// الانكلود تبعو بتلاقيه بالانتشايلاز
