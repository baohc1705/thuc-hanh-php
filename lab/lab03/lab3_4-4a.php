<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Hàm bảng cửu chương (BCC): sẽ nhận các tham số $n, $colorHead,
        $color1, $color2: $colorHead: màu nền của dòng đầu tiên, $color1:
        màu nền dòng lẻ, $color2: màu nền các dòng chẵn. Các màu này đều có
        giá trị mặc định</p>
    <br>

    <?php
    function BCC($n, $color1 = "green", $color2 = "red", $colorHead = "yellow")
    {
    ?>
        <table bgcolor="gray">
            <tr>
                <td colspan="3">Bảng cửu chương <?php echo $n; ?></td>
            </tr>
            <?php
            for ($i = 1; $i <= 10; $i++) {
            ?>
                <tr <?php
                    if ($i == 1) {
                        echo "bgcolor=$colorHead";
                    } else {
                        if ($i % 2 == 0) {
                            echo "bgcolor=$color2";
                        } else
                            echo  "bgcolor=$color1";
                    }
                    ?>>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $n * $i; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    }

    BCC(6);
    ?>
</body>

</html>