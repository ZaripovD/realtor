<!DOCTYPE html>
<title>Личный кабинет</title>

<?php
include("includes/sidebar.php"); ?>

<div class="container-fluid" >
  <section id="description">
      <div class="container">
        <div class="text-center">
            <h1>Личная карточка</h1>
            <div class="col-md-1 col-md-offset-9">
          <a href="PersEdit.php" class="btn btn-primary stretched-link" style="background-color: grey">Обновить информацию</a>
      </div>
          </div>
        <div class="row">
          <div class="row">
          <div class="col-md-3 col-md-offset-1">
            <h3></h3>
            <?php               
              $resultImg = mysqli_query($connection, "
                SELECT * FROM profile_img 
                WHERE id_user = '$sesid' ");
              while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                $ext = $rowImg['extension'];
                if ($rowImg['id_status'] == 8) {
                  echo "<img id='profilePic'src='img/uploads/profile/profile".$sesid.".".$ext."'>";
                } else {
                  echo "<img id='profilePic' src='img/uploads/profile/profiledef.jpg'>";
                }
              }
            ?>
            <br>
          </div>
          <div class="col-md-3 col-md-offset-1">
            <h3>Фамилия:</h3>
            <p><?php echo $_SESSION['logged_user']->family;?></p>
            <h3>Имя:</h3>
            <p><?php echo $_SESSION['logged_user']->name; ?></p>
            <h3>Отчество:</h3>
            <p><?php echo $_SESSION['logged_user']->father; ?></p>
            <br>
          </div>
          <div class="col-md-3 col-md-offset-1">
            <h3>Номер телефона:</h3>
            <p><?php echo $_SESSION['logged_user']->phone; ?></p>            
            <h3>Электронная почта:</h3>
            <p><?php echo $_SESSION['logged_user']->mail; ?></p>            
          </div>        
        </div>
      </div>
    </div>
  </section>
</div>
 <?php include("includes/footer.php"); ?>