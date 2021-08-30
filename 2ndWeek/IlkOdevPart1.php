<?php

$arr = [
    'name' => 'gokhan',
    'surname' => 'yener',
    'sports' => [
        'swimming' => 'yes',
        'running' => 'no',
        'defence_sports' => [
            'judo' => 'yes',
            'boxing' => 'no'
        ]
      ]
    ];

$kont = true;

function GetThat($arr,$key){
    global $kont;
    if(is_array($arr)){
        foreach($arr as $key_gen => $value){
            if(is_array($value)){
                if($key_gen === $key){
                    $kont = false;
                    print_r($value);
                }
                else
                {
                    GetThat($value,$key);
                }
            }
            else{
                if($key_gen === $key){
                    $kont = false;
                    echo $value;
                }
            }
        }
    }
}

if($kont){
    echo 'yazdığınız değer bulunamadı';
}

GetThat($arr,'ahmet');

?>
