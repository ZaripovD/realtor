<!DOCTYPE html>

<?php 
include("includes/session.php");
  $data = $_POST;
  if ( isset($data['do_phone']) )
  {
    $user = R::findOne('user', 'phone = ?', array($data['phone']));
    if ( $user )
    {
      //логин существует
      if ( md5($data['password'], $user->password) )
      {
        //если пароль совпадает, то нужно авторизовать пользователя
        $_SESSION['logged_user'] = $user;
          header('location: persarea.php');
      }else
      {
        $errors[] = 'Неверно введен пароль!';
      }

    }else
    {
      $errors[] = 'Пользователь с таким номером телефона не найден!';
    }
    
    if ( ! empty($errors) )
    {
      //выводим ошибки авторизации
      echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
    }

  }

?>

  
<form action="signin.php" class="text-center" method="POST" id="reg">
  <div class="row">
    <h2>Авторизация</h2>
  </div>
  <div class="row">
    <div class="col-md-12">
        <input type="text" placeholder="Номер телефона" name="phone" value="<?php echo @$data['phone']; ?>">
      </div>
    <div class="col-md-12">
        <input type="password" placeholder="Пароль" name="password" value="<?php echo @$data['password']; ?>">
      </div>
     </div>
     <div class="row">
        <button type="submit" name="do_phone">Войти</button><br>
        <p class="link"><a href="registration.php">Нет аккаунта?</a></p>
     </div> 
</form>

  <?php include("includes/footer.php"); ?>