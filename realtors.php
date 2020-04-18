
<!DOCTYPE html>
<?php include ("includes/sideadmin.php");

if (isset($_GET['del_id'])) { //проверяем, есть ли переменная

  $oper = mysqli_query($connection, "UPDATE `operations` SET realtor = 2 WHERE realtor = {$_GET['del_id']} ");  
  $delu = mysqli_query($connection, "DELETE FROM `user` WHERE `id` = {$_GET['del_id']}");     
    if ($delu) {
      header('location:ADMINusers.php'); 
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($connection) . '</p>';

  }
  }

$sql = mysqli_query($connection, "SELECT id, mail, family, name, father, phone FROM user WHERE id_role = 3 and id >2");

if (!$sql) {
  echo mysqli_error($connection);
}
echo "<section id='apartment-story'>
  <div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {
echo "
    <div class='row'>
      <div class='col-md-2'>
        <h4>Почта</h4>
        <p>{$result['mail']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Фамилия</h4>
        <p>{$result['family']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Имя</h4>
        <p>{$result['name']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Отчество</h4>
        <p>{$result['father']}</p>
      </div>    
      <div class='col-md-2'>
        <h4>Телефон</h4>
        <p>{$result['phone']}</p>
      </div>
      <div class='col-md-2'>
        <h1></h1>
        <a href='?del_id={$result['id']}' class='btn btn-danger'>
          Удалить
        </a>
      </div>
    </div>
    <hr>";
}
echo "</div>
</section>";
?>

<?php include ("includes/footer.php") ?>