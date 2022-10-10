<?php  

require('connection.php');
session_start();

require_once 'phpqrcode/qrlib.php';
$path='images/';

$qrcode=$path.time().".png";

QRcode::png("tech area ", $qrcode,'H',4,4);

echo "<img src='".$qrcode."'>";





?>