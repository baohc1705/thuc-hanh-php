<?php
function postIndex($index, $value = "")
{
    if (!isset($_POST[$index])) return $value;
    return trim($_POST[$index]);
}

function checkUserName($string)
{
    if (preg_match("/^[a-zA-Z0-9._-]*$/", $string))
        return true;
    return false;
}

function checkEmail($string)
{
    if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $string))
        return true;
    return false;
}

function checkPassword($string)
{
    return preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/", $string);
}

function checkPhone($string)
{
    return preg_match("/^[0-9]+$/", $string);
}

function checkDateVN($string)
{
    return preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\/-](0?[1-9]|1[0-2])[\/-]\d{4}$/", $string);
}


$sm       = postIndex("submit");
$username = postIndex("username");
$email    = postIndex("email");
$password = postIndex("password");
$date     = postIndex("date");
$phone    = postIndex("phone");

?>
<!DOCTYPE html PUBLIC "-//W3CC//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta charset="utf-8" />
<title>Lab6_3</title>
<style>
fieldset { width:50%; margin:100px auto; }
.info    { width:600px; color:#006; background:#6FC; margin:0 auto; padding:10px; }
#frm1 input { width:300px; }
</style>
</head>

<body>

<fieldset>
<legend style="margin:0 auto">Đăng ký thông tin</legend>

<form action="lab06_3.php" method="post" id='frm1'>
<table align="center">

    <tr>
        <td>UserName</td>
        <td><input type="text" name="username" value="<?php echo $username; ?>" />*</td>
    </tr>

    <tr>
        <td>Mật khẩu</td>
        <td><input type="text" name="password" />*</td>
    </tr>

    <tr>
        <td>Email</td>
        <td><input type="text" name="email" value="<?php echo $email; ?>" />*</td>
    </tr>

    <tr>
        <td>Ngày sinh</td>
        <td><input type="text" name="date" placeholder="dd/mm/yyyy" /></td>
    </tr>

    <tr>
        <td>Điện thoại</td>
        <td><input type="text" name="phone" /></td>
    </tr>

    <tr>
        <td colspan="2" align="center"><input type="submit" value="submit" name="submit"></td>
    </tr>

</table>
</form>
</fieldset>

<?php
if ($sm != "")
{
?>
    <div class="info">Lỗi:<br>
    <?php
        if (!checkUserName($username))
            echo "Username chỉ được chứa a-z, A-Z, 0-9, ., _ và - <br>";

        if (!checkPassword($password))
            echo "Mật khẩu phải ≥ 8 ký tự, chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 số.<br>";

        if (!checkEmail($email))
            echo "Email sai định dạng!<br>";

        if (!checkDateVN($date))
            echo "Ngày sinh sai định dạng (dd/mm/yyyy hoặc dd-mm-yyyy).<br>";

        if (!checkPhone($phone))
            echo "Điện thoại chỉ được chứa ký tự số!<br>";
    ?>
    </div>
<?php
}
?>

</body>
</html>
