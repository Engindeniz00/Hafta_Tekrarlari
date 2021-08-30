<?php

$arr = [ // array değerleri
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


$kont = true; // key'in array içersinde olup olmadığını kontrol ediyor

function GetThat($arr,$key){
    global $kont;
    if(is_array($arr)){ // array olup olmadığı kontrolü
        foreach($arr as $key_gen => $value){ // key ve value değerlerinin array içersinde almamızı sağlar
            if(is_array($value)){ // değerin array olup olmadığı kontrolü
                if($key_gen === $key){ // array ise key olup olmadığı
                    $kont = false;
                    print_r($value); // değeri yazdır
                }
                else
                {
                    GetThat($value,$key); // array ise ama key değil ise GetThat fonksiyonu geri çağırır
                }
            }
            else{
                if($key_gen === $key){ // değer array değilse ve key doğru ise değeri echo ile yazdır
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
