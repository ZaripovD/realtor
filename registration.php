<!DOCTYPE html>
<?php include("includes/session.php"); ?>
<?php 

  $data = $_POST;


  //если кликнули на button
  if ( isset($data['do_signup']) )
  {
    // проверка формы на пустоту полей
    $errors = array();

    if (strlen($data['password']) < 7 || strlen($data['password']) > 15) 
    {
      $errors[] = 'Укажите пароль от 7 до 15 символов!';
    }

    if ( $data['passwordcheck'] != $data['password'] )
    {
      $errors[] = 'Повторный пароль введен не верно!';
    }    

    if ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) )
    {
      $errors[] = 'Введите корректный Email';
    } 

    if ( trim($data['phone']) == '')
    {
      $errors[] = 'Введите номер телефона';
    }
    
    //проверка на существование одинакового логина
    
    //проверка на существование одинакового email
    if ( R::count('user', "email = ?", array($data['email'])) > 0)
    {
      $errors[] = 'Пользователь с таким Email уже существует!';
    }

    //проверка на существование одинакового телефона
    if ( R::count('user', "phone = ?", array($data['phone'])) > 0)
    {
      $errors[] = 'Номер телефона уже зарегистрирован в системе!';
    }





    if ( empty($errors) )
    {
      //ошибок нет, теперь регистрируем
      $user = R::dispense('user');
      $user->family = $data['family'];
      $user->name = $data['name'];
      $user->father = $data['father'];      
      $user->password = MD5($data['password']); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
      $user->phone = $data['phone'];
      $user->mail = $data['email'];
      R::store($user);

      $add2 = mysqli_query($connection, "
        SELECT id 
        FROM user
        ORDER BY id DESC
        LIMIT 1");

      while ($result = mysqli_fetch_array($add2)) {
        $ava = mysqli_query($connection, "
        INSERT INTO profile_img (`id_user`) VALUES 
        ('{$result['id']}')"); 
      }

      $_SESSION['logged_user'] = $user;
      header("location:persarea.php");

           
      
      echo '<div class="row text-center" id="success" style="color:green; padding-top: 50px;;">Вы успешно зарегистрированы!</div><hr>';
    }else
    {
      echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">' .array_shift($errors). '</div><hr>';
    }

  }

?>

<form action="registration.php" method="post" class="text-center" id="reg">
  <div class="container text-center">
  <div class="row">
    <h2>Регистрация</h2>
  </div>
  <div class="row">
    <div class="col-md-12">
      
        <input type="text" name="family" placeholder="Фамилия" value="<?php echo @$data['family']; ?>">
          
        
    </div>
    <div class="col-md-12">
      
        <input type="text" name="name" placeholder="Имя" value="<?php echo @$data['name']; ?>">
          
        
    </div>
    <div class="col-md-12">
      
        <input type="text" name="father" placeholder="Отчество" value="<?php echo @$data['father']; ?>">
        
      
  </div>

    <div class="col-md-12">
      
        <input type="password" name="password" placeholder="Пароль">
          
      </div>
      <div class="col-md-12">
      
        <input type="password" name="passwordcheck" placeholder="Подтвердите пароль">
          
      </div>
      <div class="col-md-12">
      
        <input type="tel" name="phone" placeholder="Номер телефона" value="<?php echo @$data['phone']; ?>">
          
      </div>
    
    <div class="col-md-12">
      
        <input type="email" name="email" placeholder="Email" value="<?php echo @$data['email']; ?>">
          
      </div>

     </div>
     <div class="col-md-12">
      
        <h4><input type="checkbox" class="check"><a data-toggle="modal" href="#policy_modal">Я согласен на обработку персональных данных и принимаю условия договора</a></h4>
          
      </div>
     <div class="row">
      <button name="do_signup" type="submit">Продолжить</button><br>
      <p class="link"><a href="signin.php" >Уже есть аккаунт?</a></p>
     </div> 
     </div>
</form>

<?php include("includes/footer.php"); ?>