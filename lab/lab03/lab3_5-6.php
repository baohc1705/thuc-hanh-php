<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    Viết hàm loại bỏ các khoảng trắng dư thừa trong một chuỗi.
    </pre>
    <?php
        function loaiBoKhoangTrang($str) {
            
            $str = trim($str);

           
            while (strpos($str, '  ') !== false) {
                $str = str_replace('  ', ' ', $str);
            }

            return $str;
        }
        ?>

    <pre>
        <?php
         $input = "   Day la      mot chuoi  co nhieu    khoan   trang     ";
         $output = loaiBoKhoangTrang($input);
         echo "'$input'sau khi loai bo khoang trang: '$output'";  
        ?>
    </pre>
</body>
</html>