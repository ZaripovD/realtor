<!DOCTYPE html>

<?php include ("includes/sideadmin.php");

echo "<section id='apartment-list'>
	<div class='container admin'>";

	$sql = mysqli_query($connection, "SELECT apartments.id, floor, rooms, square, price, status.name as 'status', apt_type.name as 'apt_type', give_type.name as 'give_type', apartments.id_status 'statt'
	FROM apartments
	LEFT JOIN status on apartments.id_status = status.id
	LEFT JOIN apt_type on apartments.type = apt_type.id
	LEFT JOIN give_type on apartments.give_type = give_type.id
	WHERE apartments.id <> 2 
	ORDER BY apartments.id DESC");
echo mysqli_error($connection);
if (isset($_GET['del_id'])) { //проверяем, есть ли переменная  

  $del = mysqli_query($connection, "UPDATE `operations` SET `id_apartment` = 2 WHERE `id_apartment` = {$_GET['del_id']}");

  $delu = mysqli_query($connection, "DELETE FROM `apartments` WHERE `id` = {$_GET['del_id']}");

  	echo "<div class='row' text-center' style='color:white; text-align:center; background-color:red;font-size:25px;'>Апартаменты удалены</div>";
  	echo mysqli_error($connection);  
  }

  
if (isset($_GET['suc_id'])) {
	$upd = mysqli_query($connection,"
		UPDATE apartments SET id_status = 4 WHERE ID = {$_GET['suc_id']}");
	echo "<div class='row' text-center' style='color:white; text-align:center; background-color:green;font-size:25px;'>Апартаменты внесены</div>";
}



while ($result = mysqli_fetch_array($sql)) {
echo "
	<div class='row'>
		<div class='col-md-1'>
			<h4>ID</h4>
			<p><a href='flat.php?id={$result['id']}'>{$result['id']}</a></p>
		</div>
		<div class='col-md-2'>
			<h4>Этажность</h4>
			<p>{$result['floor']}</p>
		</div>
		<div class='col-md-2'>
			<h4>Комнат</h4>
			<p>{$result['rooms']}</p>
		</div>
		<div class='col-md-1'>
			<h4>Площадь</h4>
			<p>{$result['square']}</p>
		</div>
		<div class='col-md-2'>
			<h4>{$result['give_type']}</h4>
			<p>{$result['apt_type']}</p>
		</div>
		<div class='col-md-2'>
			<h4>Стоимость</h4>
			<p>{$result['price']}</p>
		</div>		
		<div class='col-md-2'>
			<h4>Статус</h4>
			<p>{$result['status']}</p>
		</div>
	</div>
	<div class='row text-right'>
		<div class='col-md-11'>			
				<a href='?del_id={$result['id']}' class='btn btn-danger'>УДАЛИТЬ</a>			
		</div>";
	if ($result['statt'] == 1) {
		echo "<div class='col-md-1'>			
				<a href='?suc_id={$result['id']}' class='btn btn-success'>ДОБАВИТЬ</a>			
		</div>
		</div>
		<hr>";
	} else{
		echo "</div>
	<hr>";
	}
}

echo "</div>
</section>";

?>
<?php include ("includes/footer.php") ?>