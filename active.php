<?php include ("includes/sideadmin.php");?>
<section id='apartment-story'>
	<div class='container admin'>
		<form action="active.php" method="post" id="done">
<?php
$now = date("Y-m-d");
	$sql = mysqli_query($connection,  
		"SELECT operations.id as 'ID', giver.family as 'fam', giver.name as 'name', apartments.id as 'number', summary, status.name as 'status', date_deal, apartments.id_status as 'ids', user.family as 'family', user.name 'namee', give_type.id as 'givingID', give_type.name as 'giving', apt_type.name as 'apt'
		FROM operations
		LEFT JOIN apartments on operations.id_apartment = apartments.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN user on operations.buyer = user.id
		LEFT JOIN giver on operations.user = giver.id_user
		LEFT JOIN give_type on apartments.type = give_type.id
		LEFT JOIN status on operations.id_status = status.id
		WHERE operations.id_status = 5");
	echo mysqli_error($connection);


if (isset($_POST['accept_id'])) {

		if ($_POST['sum'] == "" || $_POST['sum'] < 5000 || $_POST['sum'] > 10000000000) {
			echo "<div class='row text-center'>
				<h2>Введите корректную сумму</h2>
			</div>";
		}else{
			$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 6, summary = {$_POST['sum']}, date_end = '$now' WHERE operations.id = {$_POST['id']}");
			if ($_POST['givingID'] == 1) {
				$sold = mysqli_query($connection, "UPDATE apartments SET id_status = 2 WHERE apartments.id = {$_POST['number']}");
			}
			echo mysqli_error($connection);
		}
	}

while ($result = mysqli_fetch_array($sql)) {

	$stat = $result['ids'];
echo "
	<div class='row story'>
      <input type='hidden' name='number' value='{$result['number']}'>
      <input type='hidden' name='id' value='{$result['ID']}'>
      <input type='hidden' name='givingID' value='{$result['givingID']}'>
			<div class='col-md-2'>
				<h4>Владелец</h4>
				<p><a href=''>{$result['fam']} {$result['name']}</a></p>
			</div>
			<div class='col-md-2'>
				<h4>ID апартаментов</h4>
				<p><a href='flat.php?id={$result['number']}'>{$result['number']}</a></p>
			</div>
			<div class='col-md-2'>
				<h4>Реципиент</h4>
				<p><a href=''>{$result['family']} {$result['namee']}</a></p>
			</div>
			<div class='col-md-1'>
				<h4>{$result['apt']}</h4>
				<p>{$result['giving']}</p>
			</div>		
			<div class='col-md-2'>
				<h4>Заявка подана</h4>
				<p>{$result['date_deal']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Итоговая сумма</h4>
				<input name='sum' placeholder='Итог по операции'>
			</div>
			<div class='col-md-1'>
				<h4>  </h4>
				<button class='btn btn-success' name='accept_id'>Закрыть</button>
			</div>
	</div>";
}	

 ?>
</form></div></section>

<?php include ("includes/footer.php") ?>