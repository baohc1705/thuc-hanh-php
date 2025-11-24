<?php
    $a = array("Chi bao", 1, "k1" => 3, "abc");
    var_dump($a);
    function showArray($arr) {
        echo "<table border=1>";
        echo "<tr>";
            echo "<td>KEY</td>";
            echo "<td>VALUE</td>";
            echo "</tr>";
        foreach($arr as $k => $v) {
            echo "<tr>";
            echo "<td>$k</td>";
            echo "<td>$v</td>";
            echo "</tr>";
            
        }
        echo "</table>";
    }
    showArray($a);
?>