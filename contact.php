<?php
header("Content-Type: text/html; charset=utf-8");
include("includes/session.php");?>

    <form action='contact.php' class='text-center' method='POST' id='reg'>
      <div class='row'>
        <h2>Обратная связь</h2>
      </div>
<?php

if (isset($data['send'])) {
  $errors = array();

  if ($ses) {
    if (strlen($data['message'])< 15  || strlen($data['message'])> 280 ) {
      $errors[] = "Пожалуйста, введите сообщение от 15 до 280 символов";
    }
  }
  else{
    if ($data['name'] == "") {
      $errors[] = "Введите имя";
    }

    if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $data['mail'] == "") {
      $errors[] = "Введите адрес электронной почты";
    }

    if (strlen($data['message'])< 15  || strlen($data['message'])> 280 ) {
      $errors[] = "Введите сообщение от 15 до 280 символов";
    }
  }

  if (!empty($errors)) {
     echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">' .array_shift($errors). '</div><hr>';
  } else {

    $what=$_POST['message'];
    $name = $data['name'];
    $phone = $data['phone'];
    $mail = $data['mail'];

    $to = "GonZall00@yandex.ru";
    //тема и сообщение
    $subject = "Заявка с сайта недвижимости";
    $message = "Письмо отправлено из контактной формы. 
    Пользователь пишет: ".htmlspecialchars($what)."
    Имя: ".htmlspecialchars($name)."
    Телефон: ".htmlspecialchars($phone);
    $headers  = "Content-type: text/html; charset=UTF-8 \r\n";
    $headers .= "From: {$mail} <{$mail}>\r\n";
    mail ($to, $subject, $message, $headers);

    echo '<div class="row text-center" id="errors" style="color:black; padding-top: 50px; ">
    Письмо отправлено</div><hr>';
  }
}

if ($ses) {  
    $user=$_SESSION['logged_user']->name . ' ' . $_SESSION['logged_user']->father;
    $phon=$_SESSION['logged_user']->phone;
    $mal = $_SESSION['logged_user']->mail;

  echo "
      <div class='row'>
      <input name='name' value='$user' type='hidden'>
      <input name='mail' value='$mal' type='hidden'>
      <input name='phone' value='$phon' type='hidden'>
        <div class='col-md-12'>
            <textarea name='message' cols='80' rows='10'></textarea>
         </div>
      </div>
        <div class='row'>
            <button type='submit' name='send'>Отправить</button><br>
        </div>
  ";
}else {
    echo "
      <div class='row'>
        <div class='col-md-12'>
            <h4>Как к вам обращаться?</h4>
            <input name='name' placeholder='ФИО'>
        </div>
        <div class='col-md-12'>
            <h4>Электронная почта</h4>
            <input name='mail' placeholder='ex@ex.ru'>
        </div>
        <div class='col-md-12'>
            <h4>Телефон</h4>
            <input name='phone' placeholder='+79999999999'>
        </div>
        <div class='col-md-12'>
           <textarea name='message' cols='80' rows='10'></textarea>
        </div>
      </div>
      <div class='row'>
        <button type='submit' name='send'>Отправить</button><br>
      </div>  
  ";
}
?>
</form>



  <?php include("includes/footer.php"); ?> 