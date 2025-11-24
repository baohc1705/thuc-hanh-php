<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <pre>
    Viết hàm xuất ra hình chữ nhật rỗng có chiều dài là d và chiều rộng là r
    Ví dụ d=6, r=4 có kết quả như sau:
    * * * * * *
    *         *
    *         *
    * * * * * *
    </pre>

    <?php
    function inHCN($chieuDai, $chieuRong)
    {
        for ($i = 0; $i < $chieuDai; $i++) {
            for ($j = 0; $j < $chieuRong; $j++) {
                if (($i == 0 || $i == $chieuDai - 1) ||
                    ($j == 0 || $j == $chieuRong - 1)
                ) {
                    echo "*&nbsp;";  
                } else {
                    echo "&nbsp;&nbsp;&nbsp;";
                }
            }
            echo "<br>";
        }
    }

    inHCN(4, 6);
    ?>

</body>

</html>