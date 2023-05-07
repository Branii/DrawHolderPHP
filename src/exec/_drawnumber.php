<?php
include "../class/DrawNumberClass.php";
$drawObj = new DrawNumberClass;
$drawTime = $_POST['drawTime'];
echo($drawObj->generateDrawNumber($drawTime));
