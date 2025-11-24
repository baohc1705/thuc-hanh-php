<?php
$arr = array();
$r = array("id" => "sp1", "name" => "Sản phẩm 1 ");
$arr[] = $r;
$r = array("id" => "sp2", "name" => "Sản phẩm 2 ");
$arr[] = $r;
$r = array("id" => "sp3", "name" => "Sản phẩm 3 ");
$arr[] = $r;
var_dump($arr);

function showArray($arr)
{
    echo "<table border=1>";
    echo "<tr>";
    echo "<td>STT</td>";
    echo "<td>MA SAN PHAM</td>";
    echo "<td>TEN SAN PHAM</td>";
    echo "</tr>";
    $stt = 1;    
    foreach ($arr as $k => $v) {
        echo "<tr>";
        echo "<td>".$stt++."</td>";
        echo "<td>".$v['id']."</td>";
        echo "<td>".$v['name']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}

showArray($arr);