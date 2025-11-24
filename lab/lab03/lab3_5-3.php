<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
        Viết hàm tính tổng các chữ số có trong một chuỗi
        Ví dụ có chuỗi ngay15thang7nam2015
        => tổng các chữ số = 1+5+7+2+0+1+5=21
    </pre>

    <?php
        function tinhTongChuSoTrongChuoi($chuoi) {
            $dodai = strlen($chuoi);
            $tong = 0;
            for ($i = 0; $i < $dodai; $i++) {
                if (is_numeric($chuoi[$i])) {
                    $tong += (int)$chuoi[$i];
                }
            }

            echo "Tong cac chu so trong chuoi: $chuoi => $tong";
        }

        tinhTongChuSoTrongChuoi("ngay15thang7nam2015");
    ?>
</body>
</html>