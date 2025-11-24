<?php
$tracNghiem = [
    [
        "cauhoi" => "1 + 1 = ?",
        "traloi" => [
            "a" => 2,
            "b" => 3,
            "c" => 4
        ],
        "dung" => "a"
    ],
    [
        "cauhoi" => "3 + 2 = ?",
        "traloi" => [
            "a" => 5,
            "b" => 3,
            "c" => 2
        ],
        "dung" => "a"
    ],
    [
        "cauhoi" => "5 + 1 = ?",
        "traloi" => [
            "a" => 5,
            "b" => 3,
            "c" => 6
        ],
        "dung" => "c"
    ],
    [
        "cauhoi" => "6 + 6 = ?",
        "traloi" => [
            "a" => 3,
            "b" => 12,
            "c" => 4
        ],
        "dung" => "b"
    ],
    [
        "cauhoi" => "7 + 4 = ?",
        "traloi" => [
            "a" => 11,
            "b" => 3,
            "c" => 4
        ],
        "dung" => "a"
    ]
];
$soluong = 4;
$randArr = array_rand($tracNghiem, $soluong);
$mangNgaunhien=[];
foreach($randArr as $key) {
    //var_dump($tracNghiem[$key]);
    $mangNgaunhien[] = $tracNghiem[$key];
    // echo "Cau hoi: ".$v["cauhoi"]."<br/>";
    // foreach($v["traloi"] as $k => $tl) {
    //     echo $k.":".$tl;
    //     if($k == $v["dung"]) {
    //         echo " -> Cau dung";
    //     }
    //     echo "<br/>";
    // }
}

foreach($mangNgaunhien as $v) {
     echo "Cau hoi: ".$v["cauhoi"]."<br/>";
    foreach($v["traloi"] as $k => $tl) {
        echo $k.":".$tl;
        if($k == $v["dung"]) {
            echo " -> Cau dung";
        }
        echo "<br/>";
    }
}

// $m=3;
// $c = array_rand($b, $m);
// echo "<br> Danh sách $m phần tử ngẫu nhiên được lấy ra từ b:";
// foreach($c as $k)
// {
// 	echo "(key=$k -	value={$b[$k]})";
// }