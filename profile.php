<?php    
include ('includes/session.php');?>
<?php
if (isset($_GET['profile'])) {
  $profile = mysqli_query($connection, "SELECT id, mail, family, name, father, phone FROM user WHERE id = '{$_GET['profile']}'");
  
}else if (isset($_GET['giver'])){
  $profile = mysqli_query($connection, "SELECT user.id as 'id', user.family as 'family', user.name as 'name', user.father as 'father', user.phone as 'phone'
    FROM giver
    LEFT JOIN user on giver.id_user = user.id 
    WHERE giver.id = '{$_GET['giver']}'");
}
  echo mysqli_error($connection);
  $result = mysqli_fetch_assoc($profile);
?>
<div class='container-fluid' >  
     <section id='description'>
        <div class='row'>
          <div class='row'>
          <div class='col-md-3 col-md-offset-1'>
            <h3></h3>
            <?php               
              $resultImg = mysqli_query($connection, "
                SELECT * FROM profile_img 
                WHERE id_user = '{$result['id']}' ");
              while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                $ext = $rowImg['extension'];
                if ($rowImg['id_status'] == 8) {
                  echo "<img id='profilePic'src='img/uploads/profile/profile".$result['id'].".".$ext."'>";
                } else {
                  echo "<img id='profilePic' src='img/uploads/profile/profiledef.jpg'>";
                }
              }
            ?>
            <br>
          </div>
          <div class='col-md-3 col-md-offset-1'>
            <h3>Фамилия:</h3>
            <p><?php echo $result['family'] ?></p>
            <h3>Имя:</h3>
            <p><?php echo $result['name'] ?></p>
            <h3>Отчество:</h3>
            <p><?php echo $result['father'] ?></p>
            <br>
          </div>
          <div class='col-md-3 col-md-offset-1'>
            <h3>Номер телефона:</h3>
            <p><?php echo $result['phone'] ?></p>
            <br>
          </div>       
        </div>
      </div>
</section>
</div>





 <?php include("includes/footer.php"); ?>