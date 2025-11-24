<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Viết hàm kiểm tra một chuỗi có đối xứng không</p>
    <br>
    <?php
        function kiemTraDoiXung($chuoi) {
            $dodai = strlen($chuoi);

            for ($i = 0; $i < $dodai / 2; $i++) {
                if ($chuoi[$i] != $chuoi[$dodai - $i -1])
                    return false;
            }
            return true;
        }
        $chuoiInput = "abcbza";
        echo "Chuoi: $chuoiInput";
        echo "<br>";
        if (kiemTraDoiXung($chuoiInput)) {
            echo "Chuoi doi xung";
        }
        else 
            echo "Chuoi khong doi xung";
    ?>
</body>
</html>