<?php 
   $a = 17;
   $b = 5;
   
   $phan_nguyen = intdiv($a, $b);  
   $phan_du = $a % $b;            
   
   echo "phan nguyen $a / $b la: " . $phan_nguyen . "\n";
   echo "phan du $a / $b la: " . $phan_du . "\n";
?>