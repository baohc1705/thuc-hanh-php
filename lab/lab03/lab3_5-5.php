<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <pre>
    Viết hàm tính tổng các số có trong một chuỗi
    Ví dụ có chuỗi ngay15thang7nam2015
     tổng các chữ số = 15+7+2015=2037
    </pre>
    <?php
    function tinhTongChuSo($str)
    {
        $tong = 0;
        $currentNumber = '';

       
        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];

            
            if (is_numeric($char)) {
                $currentNumber .= $char; 
            } else {
                
                if ($currentNumber !== '') {
                    $tong += (int)$currentNumber;
                    $currentNumber = ''; 
                }
            }
        }

       
        if ($currentNumber !== '') {
            $tong += (int)$currentNumber;
        }

        return $tong;
    }

    $chuoi = "ngay15thang7nam2015";
    echo "Tong cac so: " . tinhTongChuSo($chuoi);  
    ?>

</body>

</html>