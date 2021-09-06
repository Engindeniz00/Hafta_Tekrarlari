<?php

function filterDatas($data){
    if(is_array($data)){
        return array_map('filterDatas',$data);
    }
    return htmlspecialchars(trim($data));
}

function WriteToTextFile($register_namesurname,$register_username,$register_mail,$register_password){
    $user_data = $register_namesurname.','.$register_username.','.$register_mail.','.$register_password;
    $file = fopen("db.txt","a");
    fwrite($file,$user_data."\n");

    fclose($file);
}

function CheckMatchingData($wanted_username,$wanted_password){
    $row = 1;
    if(($handle = fopen("db.txt","r"))!== FALSE){
        while(!feof($handle)){
            $key_array = array('r_namesurname','r_username','r_email','r_password'); // keyler için array
            $line = fgets($handle); // valuelar için array
            if(!empty($line)){
                $arr[] = array_combine($key_array,explode(',',$line)); // key ve value birleştirilmesi
            }
            $arr = array_map('filterDatas',$arr); // arrayin tüm elemanlarına trim atıyoruz
        }
        fclose($handle);
    }
    return executesOnArray($arr,$wanted_username,$wanted_password);
}

function executesOnArray($arr,$wanted_username,$wanted_password )
{
    $control = false;
    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                if ($value['r_username'] === $wanted_username && $value['r_password'] === $wanted_password) {
                    $control = true;
                }
            }
        }

        if ($control) {
            echo "GİRİŞ BAŞARILI <br> Kullanıcı adı: $wanted_username <br> Kullanıcı şifre : $wanted_password";
            return $control;
        } else {
            echo 'BAŞARISIZ';
            return $control;
        }
    }
}

function userNameExistence($username){
    $control = false;
    // dosya okuma
    if(($handle = fopen("db.txt","r"))!== FALSE){
        while(!feof($handle)){
            $key_array = array('r_namesurname','r_username','r_email','r_password'); // keyler için array
            $line = fgets($handle); // valuelar için array
            if(!empty($line)){
                $arr[] = array_combine($key_array,explode(',',$line)); // key ve value birleştirilmesi
            }
            $arr = array_map('filterDatas',$arr); // arrayin tüm elemanlarına trim atıyoruz
        }
        fclose($handle);
    }
    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                if ($value['r_username'] === $username) {
                    $control = true;
                }
            }
        }

        if ($control) {
            return $control;
        } else {
            return $control;
        }
    }
}






