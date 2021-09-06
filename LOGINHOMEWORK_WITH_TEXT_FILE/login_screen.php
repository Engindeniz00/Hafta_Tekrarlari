<?php
include("dbFunctions.php");
$errors = '';
function filter($post){
    if(is_array($post)){
        return array_map('filter',$post);
    }
    return htmlspecialchars(trim($post));
}

function isValid(){
    $errors=true;
    foreach($_POST as $key => $value){
        if(empty($key)){
            $errors=false;
        }
        if($key === 'register_email'){
            if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                // checks if there is an invalid emailadress
                $errors=false;
            }
        }
    }
    return $errors;
}


$_POST = array_map('filter',$_POST);

function post($name){
    if(isset($_POST[$name])){
        return $_POST[$name];
    }
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!$username || !$password){
        $errors= 'Lütfen kullanıcı adını ve şifreyi giriniz';
    }elseif(!CheckMatchingData($username,$password)){
        $errors= '<br>'.'Kullanıcı adı ve şifre hatalı';
    }else{
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        // burada index'in bulunduğu konuma yönlendiriyoruz
        header('Location:indexes.php');
        echo 'Lütfen bekleyin yönlendiriliyorsunuz';
        // burada ise yönlendirdiğimiz sayfayı yeniliyoruz
        header("Refresh:4;url=indexes.php");   }

}elseif (isset($_POST['register_submit'])){
    $nameSurname = $_POST['register_namesurname'];
    $username = $_POST['register_username'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];
    $confirm_password = $_POST['register_confirm_password'];

    if(!$nameSurname && !$username && !$email && !$password && !$confirm_password){
        echo 'Lütfen bilgileri eksiksiz bir şekilde doldurunuz';
    }elseif($password!==$confirm_password){
        echo 'Lütfen şifreleri kontrol ediniz';
    }elseif(userNameExistence($username)) {
        echo 'Zaten böyle bir kullanıcı var';
    }elseif(!isValid()){
        echo 'Lütfen geçerli bir email adresi giriniz';
    }else{
        WriteToTextFile($nameSurname,$username,$email,$password);
        echo 'Kullanıcı başarılı bir şekilde eklendi';
    }




}
echo $errors;
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="margin-left: 150px;width: 900px">
    <div style="width: 400px;float: left">
        <h2>LOGIN</h2>
        <form action="" method="post">
            Username: <input type="text" name="username" placeholder="username" value="<?php echo post('username')?>">
            <br>
            Password: <input style="margin-left: 3px" type="password" name="password">
            <br>
            <input type="hidden" name="submit" value="1">
            <button type="submit">Login</button>
        </form>
    </div>
</div>
<div style="width: 400px;float: left">
    <h2>REGISTER</h2>
    <form action="" method="post">
        Ad Soyad: <input type="text" name="register_namesurname" value="<?php echo post('nameSurname')?>">
        <br>
        Kullanıcı Adı: <input type="text" name="register_username" value="<?php echo post('register_username')?>">
        <br>
        Email Adress: <input type="text" name="register_email" value="<?php echo post('register_email')?>">
        <br>
        Password: <input type="password" name="register_password">
        <br>
        Confirm Password: <input type="password" name="register_confirm_password">
        <br>
        <input type="hidden" name="register_submit" value="2">
        <button type="submit">KAYIT OL</button>
    </form>

</div>






</body>
</html>