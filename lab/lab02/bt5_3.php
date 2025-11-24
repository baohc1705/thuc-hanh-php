<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        function giaiPhuongTrinhBac2($a, $b, $c) {
            echo "phuong trinh {$a}x^2 + {$b}x + {$c} = 0";
            echo "<br>";
            $x1 = 0;
            $x2 = 0;
            
            if ($a == 0) {
                if ($b == 0) {
                    if ($c == 0) {
                        echo "Phuong trinh vo so nghiem";
                    }
                    else {
                        echo "phuong trinh vo nghiem";
                    }
                }
                else {
                    $x1 = -$b / $c;
                }
            }
            else {
                $delta = $b*$b - 4*$a*$c;
                if ($delta < 0) {
                    echo "Phuong trinh vo nghiem";
                }
                elseif ($delta == 0) {
                    $kep = -$b / 2*$a;
                    echo "phuong trinh co nghiem kep: $kep";
                }
                else {
                    echo "Phuong trinh co 2 nghiem phan biet:";
                    $x1 = (-$b + sqrt($delta)) / (2 * $a);
                    $x2 = (-$b - sqrt($delta))/ (2 * $a);
                    echo "<br>";
                    echo "x1 = $x1, x2=$x2";
                }
                
            }
        }
        giaiPhuongTrinhBac2(1, -6, 9); // nghiem kep
        echo "<br>";
        giaiPhuongTrinhBac2(0, 0, 9); // vo nghiem
        echo "<br>";
        giaiPhuongTrinhBac2(0, 0, 0); // vo so nghiem
        echo "<br>";
        giaiPhuongTrinhBac2(1, 1, 1); // vo nghiem
        echo "<br>";
        giaiPhuongTrinhBac2(2, 3, 1); // co nghiem phan biet

       
    ?>
</body>
</html>