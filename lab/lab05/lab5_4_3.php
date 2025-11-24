<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <fieldset>
        <legend>Dang ky thanh vien</legend>
        <form action="lab5_4_3b.php" method="POST" enctype="multipart/form-data">
            Ten dang nhap: <input type="text" name="username"> <br>
            mat khau: <input type="password" name="password"> <br>
            nhap lai mat khau: <input type="password" name="confirmpass"> <br>
            gioi tinh: <input type="radio" name="gt" value="1"> Nam
            <input type="radio" name="gt" value="0"> Nu'
            <br>
            so thich: <input type="checkbox" name="st" value="dl"> du lich
            <input type="checkbox" name="st" value="nothing"> khong lam gi ca
            <br>
            <input type="file" name="hinh">
            <br>
            tinh:
            <select name="tinh">
                <option value="dt">Dong thap</option>
                <option value="la">Long an</option>
                <option value="tt">Su so than tien</option>
            </select>
            <br>
            <input type="submit" value="submit" name="submit">
            <input type="reset" value="reset" name="reset">
        </form>
    </fieldset>



</body>

</html>