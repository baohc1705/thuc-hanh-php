<?php
$url = "http://thethao.vnexpress.net/";
$html = file_get_contents($url);
if ($html==false) {
    echo "khong the tai noi dung trang $url";
} else {
    $pattern = '/<h3 class="title-news">.*<\/h3>/imsU';
    preg_match_all($pattern, $html, $arr);
    print_r($arr);
}
?>