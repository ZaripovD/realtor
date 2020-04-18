<!DOCTYPE html>
<title>Личный кабинет</title>

<?php include("includes/sidebar.php"); 

if (isset($data['change'])) { 
  $sql = mysqli_query($connection, "UPDATE user SET name = '{$data['name']}', family = '{$data['family']}', father = '{$data['father']}', phone = '{$data['phone']}', mail = '{$data['email']}' WHERE id = '{$_SESSION['logged_user']->id}'");
  $sql1 = mysqli_query($connection, "UPDATE giver SET name = '{$data['name']}', family = '{$data['family']}', father = '{$data['father']}', phone = '{$data['phone']}', mail = '{$data['email']}' WHERE id = '{$_SESSION['logged_user']->id}'");
  if ($sql){
    echo "<div class='row text-center'><h4>Изменения войдут в силу после перезахода в аккаунт</h4></div>";
  }
  else{
    echo mysqli_error($connection);
  }
}

 ?>

<div class="container-fluid" >
      

     <section id="description">
      <div class="container">

      <form id="editInfo" action="PersEdit.php" method="POST" class="n"> </form>  
      <form id="editPic" action="upload.php" method="post" enctype="multipart/form-data">  </form>  

        <div class="text-center">
            <h1>Личная карточка</h1>
          <div class="col-md-1 col-md-offset-11">
            <a href="PersArea.php"  class="btn btn-primary stretched-link" style="background-color: grey">Назад</a>
          </div>
        </div>

        <div class="row" id="scooter">
          <div class="col-md-2 col-md-offset-1">
            <h3>Обновить фотографию</h3>
            <input type="file" name="file" form="editPic"><br>
            <button id="reload" type="submit" name="newPhoto" form="editPic">
              Загрузить
            </button>

      </div>
          <div class="col-md-3 col-md-offset-1">
            <h3>Фамилия:</h3>
            <input form="editInfo" type="text" value="<?php echo $_SESSION['logged_user']->family; ?>" name="family">
            <h3>Имя:</h3>
            <input form="editInfo" type="text" value="<?php echo $_SESSION['logged_user']->name; ?>" name="name">
            <h3>Отчество:</h3>
            <input form="editInfo" type="text" value="<?php echo $_SESSION['logged_user']->father; ?>" name="father">
            </p><br>
          </div>
          <div class="col-md-3 col-md-offset-1">            
            <h3>Номер телефона:</h3>
            <input form="editInfo" type="" value="<?php echo $_SESSION['logged_user']->phone; ?>" name="phone">           
          </div>
          <div class="col-md-3 col-md-offset-1">
            <h3>Электронная почта:</h3>
            <input form="editInfo" type="text" value="<?php echo $_SESSION['logged_user']->mail; ?>" name="email">            
          </div>
          <div class="col-md-3 col-md-offset-1"><br>
            <button form="editInfo" type="submit" name="change">Изменить</button>
          </div>       
    </div>
 
    </section>
</div>

 <?php include("includes/footer.php"); ?>