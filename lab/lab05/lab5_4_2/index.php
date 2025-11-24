<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET['submit'])) {
        echo 'Ten san pham:' . $_GET['sp'] . '<br>';
        echo 'cach tim kiem:' . $_GET['pt'] . '<br>';
        echo 'loai san pham:';
        var_dump($_GET['lsp']);
        echo '<br>';
    }

    ?>
    <fieldset>
        <legend>Form 1</legend>
        <form action="index.php" method="get">
            Ten san pham: <input type="text" name="sp"> <br>
            <input type="radio" name="pt" value="0"> Gan dung
            <input type="radio" name="pt" value="1"> Chinh xac <br>
            loai san pham: <br>
            <select name="lsp">
                <option value="all">Tat ca</option>
                <option value="1">loai 1</option>
                <option value="2">loai 2</option>
                <option value="3">loai 3</option>
            </select>
            <input type="submit" value="submit" name="submit">
        </form>
    </fieldset>
</body>

</html>