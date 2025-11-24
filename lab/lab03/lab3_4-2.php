<?php
$i = 1;
$n = 0;
$tong = 0;
do {
    $tong += $i;
    ++$i;
    ++$n;
} while ($tong < 1000);
echo "N nho nhat de tong 1+2+3+...+n > 1000: $n";
