<?php
$bet = [[1,2,3,5,7],[1,3,4,5,6],[1,3,2,6,7],[3,4,4,5,6]];
$win = [1,3,4,5,6];
sort($win);
foreach ($bet as $key) {
    # code...
    echo "<pre>";
    sort($key);
    print_r($win);
    // if($win === $key){
    //     echo "Bet won";
    // }else{
    //     echo "Bet lost";
    // }
}


