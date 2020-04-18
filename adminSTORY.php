<?php include ("includes/sideadmin.php");?>
<?php
	$sql = mysqli_query($connection,  
		"SELECT operations.id as 'ID', giver.family as 'fam', giver.name as 'name', apartments.id as 'number', summary, status.name as 'status', date_deal, apartments.id_status as 'ids', user.family as 'family', user.name 'namee', give_type.name as 'giving', apt_type.name as 'apt'
		FROM operations
		LEFT JOIN apartments on operations.id_apartment = apartments.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN user on operations.buyer = user.id
		LEFT JOIN giver on operations.user = giver.id_user
		LEFT JOIN give_type on apartments.type = give_type.id
		LEFT JOIN status on operations.id_status = status.id");
	echo mysqli_error($connection);

if (isset($_GET['accept_id'])) {
	$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 2 WHERE operations.id = {$_GET['accept_id']}");
	header("location: adminstory.php");
}

if (isset($_GET['reject_id'])) {
	$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 3 WHERE operations.id = {$_GET['reject_id']}");
	header("location: adminstory.php");
}

echo "<section id='apartment-story'>
	<div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {

	
echo "
	<div class='row story'>
			<div class='col-md-2'>
				<h4>Владелец</h4>
				<p><a href=''>{$result['fam']} {$result['name']}</a></p>
			</div>
			<div class='col-md-2'>
				<h4>Номер квартиры</h4>
				<p>{$result['number']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Сумма</h4>
				<p>{$result['summary']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Реципиент</h4>
				<p><a href=''>{$result['family']} {$result['namee']}</a></p>
			</div>		
			<div class='col-md-2'>
				<h4>Статус</h4>
				<p>{$result['status']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Дата сделки</h4>
				<p>{$result['date_deal']}</p>
			</div>";
	$stat = $result['ids'];		
	if ($stat == 5) {
		echo "</div>";
	} else {
		echo "
<div class='row deal_buttons'>
  <div class='col-md-10'>
 		<a href='?reject_id={$result['ID']}' class='btn btn-danger'>Отказать</a>
 	</div>
 	<div class='col-md-1'>
 		<a href='?accept_id={$result['ID']}' class='btn btn-success'>Одобрить</a>
 	</div>
  </div>
 </div>";
	}

	
}	

 ?>


<?php include ("includes/footer.php") ?>