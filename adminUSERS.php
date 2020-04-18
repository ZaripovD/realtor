
<!DOCTYPE html>
<?php include ("includes/sideadmin.php");

if (isset($_GET['del_id'])) { //проверяем, есть ли переменная

  $oper1 = mysqli_query($connection, "UPDATE `operations` SET id_apartment = 2 WHERE user = {$_GET['del_id']}");
  $oper2 = mysqli_query($connection, "UPDATE `operations` SET user = 2 WHERE user = {$_GET['del_id']}");
  $oper = mysqli_query($connection, "UPDATE `operations` SET buyer = 2 WHERE buyer = {$_GET['del_id']} ");
  $apt = mysqli_query($connection, "DELETE FROM  `apartments` WHERE id_user = {$_GET['del_id']}");  
  $delu = mysqli_query($connection, "DELETE FROM `user` WHERE `id` = {$_GET['del_id']}");    
    if (!$delu) {
      echo "Произошла ошибка". mysqli_error($connection); 
    } 
  }

$sql = mysqli_query($connection, "SELECT id, mail, family, name, father, phone FROM user WHERE id > 2");

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
				<a href='mailto:{$result['mail']}'><p>{$result['mail']}</p></a>
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