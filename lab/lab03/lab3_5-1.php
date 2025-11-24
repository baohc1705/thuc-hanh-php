<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Xuat n so nguyen to dau tien</p>
    <?php

        function kiemTraSoNguyenTo($n) {
            if ($n < 2) 
                return false;
            for ($i = 2; $i <= sqrt($n); $i++) {
                if ($n % $i == 0)
                    return false;
            }

            return true;
        }

        function xuatNSoNguyenTo($n) {
            $dem = 0;
            $i = 1;
            while ($dem != $n) {
                if (kiemTraSoNguyenTo($i)) {
                    echo "$i";
                    echo "<br>";
                    $dem++;
                }
                
                $i++;
            }
        }
        echo "10 so nguyen to dau tien: ";
        echo "<br>";
        xuatNSoNguyenTo(10);
    ?>
</body>
</html>