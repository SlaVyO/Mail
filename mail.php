<?php
require_once './vendor/autoload.php';
require_once 'function.php';

//$dotenv = Dotenv\Dotenv::create(__DIR__, 'setting_1.env');
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();


require_once 'config.php';
$error = [];
//var_dump($options);
    

if (isset($_POST['dopost'])){
    if (!isset($_POST['image'])){
        $error[] = "Не выбрана картинка";
    }else {
        $image = "./images/thumbnail/image_".$_POST['image'].".jpg";
    }
    if ($_POST['subject'] == ''){
        $error[] = "Не указана тема";
    }else {
        $subject = $_POST['subject'];
    }
    if ($_POST['maintext'] == ''){
        $error[] = "Не указан текс письма";
    }else {
        $sendtext = $_POST['maintext'];
    }


    if ($_POST['sendto'] == ''){
        $error[] = "Не указан получатель";
    } else {
        $pre_sendto = trim($_POST['sendto']);
        //$sendto = explode(", ", $_POST['sendto']);
         //print_r($sendto);
         //var_dump($sendto);
        if (substr_count($pre_sendto, '@') == 1 ){
        	$sendto = $pre_sendto;
        }else {
	        if (stripos($pre_sendto, ",")){
	            $split = ",";
	        }else if (stripos($pre_sendto, ";")){
	            $split = ";";
	        }else if (stripos($pre_sendto, " ")){
	            $split = " ";
	        }else {
	        	$error[] = "Адрес получателя указан с ошибкой";
	        }
	        
	        if (isset($split)){
	            $sendto = explode($split, $pre_sendto);
	            //print_r($sendto);
              $sendto = array_map( 'trim', $sendto );
	        }
	    }
    }



    if (empty($error)){
        if (!sendMail($options, $sendto, $subject, $sendtext, $image)){
            $error[] = 'Ошибка отправки почты';
        }else{
        	$error[] = 'Письмо отправленно';
        	unset($_POST);
        }
    }

}


?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>Телеграф "ПочтоШлюн"</title>
   <style>
   article, aside, details, figcaption, figure, footer,header,
   hgroup, menu, nav, section { display: block; }
   .error {color: red;}
  </style>
 </head>
 <body>
  <p>Будем слать Телеграммы!</p>
  <p class = "error"><?= $error[0] ?? "" ?></p>
  <form method="POST">
  <p><input type="text" name="sendto" placeholder="Адреса получателей" value="<?= $_POST['sendto'] ?? "" ?>"></p>
  <p><input type="text" name="subject" placeholder="Тема" value="<?= $_POST['subject'] ?? "" ?>"></p>
  <p><textarea rows="4" cols="35" name="maintext" placeholder="Текст поздравления" ><?= $_POST['maintext'] ?? "" ?></textarea></p>
  <p><b>Выберети картинку</b></p>
  <p><input type="radio" name="image" value="1"><img src="./images/thumbnail/image_1.jpg">&nbsp
  <input type="radio" name="image" value="2"><img src="./images/thumbnail/image_2.jpg">&nbsp
  <input type="radio" name="image" value="3"><img src="./images/thumbnail/image_3.jpg">&nbsp</p>
  <p><input type="radio" name="image" value="4"><img src="./images/thumbnail/image_4.jpg">&nbsp
  <input type="radio" name="image" value="5"><img src="./images/thumbnail/image_5.jpg">&nbsp
  <input type="radio" name="image" value="6"><img src="./images/thumbnail/image_6.jpg"></p>
  <p><input type="radio" name="image" value="7"><img src="./images/thumbnail/image_7.jpg">

  <p><input type="submit" name="dopost" value="Отправить"></p>
 </form>


 </body>
</html>
