<?php
function postIndex($index, $value = "")
{
    if (!isset($_POST[$index])) return $value;
    return $_POST[$index];
}

if (isset($_POST['submit'])) {
    $username     = postIndex("username");
    $password     = postIndex("password");
    $confirmpass     = postIndex("confirmpass");
    $gt     = postIndex("gt");
    $st     = postIndex("st");
    $tinh     = postIndex("tinh");
    $arrImg = array("image/png", "image/jpeg", "image/bmp");

    $err = "";
    if ($username == "") $err .= "Phải nhập tên <br>";
    if ($gt == "") $err .= "Phải chọn giới tính <br>";
    if ($password != $confirmpass) $err .= "Mat khau nhap lai khong dung";

    $errFile = $_FILES["hinh"]["error"];
    if ($errFile > 0)
        $err .= "Lỗi file hình <br>";
    else {
        $type = $_FILES["hinh"]["type"];
        if (!in_array($type, $arrImg))
            $err .= "Không phải file hình <br>";
        else {
            $temp = $_FILES["hinh"]["tmp_name"];
            $name = $_FILES["hinh"]["name"];
            if (!move_uploaded_file($temp, "image/" . $name))
                $err .= "Không thể lưu file<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>

</head>

<body>
    <?php
    if (isset($err) && $err != "") {
        echo $err;
    } elseif (isset($username) && $username != "") {

        if ($gt == "1") {
            echo "Chào Anh: $username ";
        } else {
            echo "Chào Chị $username ";
        }

        echo "<hr>";
        if (isset($name)) {
            echo "<img src='image/{$name}' alt='Uploaded Image'>";
        }
    }
    //print_r($_POST);
    ?>
</body>

</html>