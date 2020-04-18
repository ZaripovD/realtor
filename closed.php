<?php include ("includes/sideadmin.php");?>
<section id='apartment-story'>
	<div class='container admin'>
<?php
	$sql = mysqli_query($connection,  
		"SELECT operations.id as 'ID', giver.family as 'fam', giver.name as 'name', apartments.id as 'number', summary, status.name as 'status', date_deal,date_end, apartments.id_status as 'ids', user.family as 'family', user.name 'namee', give_type.name as 'giving', apt_type.name as 'apt'
		FROM operations
		LEFT JOIN apartments on operations.id_apartment = apartments.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN user on operations.buyer = user.id
		LEFT JOIN giver on operations.user = giver.id_user
		LEFT JOIN give_type on apartments.type = give_type.id
		LEFT JOIN status on operations.id_status = status.id
		WHERE operations.id_status = 6");
	echo mysqli_error($connection);


while ($result = mysqli_fetch_array($sql)) {

	$stat = $result['ids'];
echo "
	<div class='row story'>
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
			<div class='col-md-2'>
				<h4>Сумма</h4>
				<p>{$result['summary']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Заявка подана</h4>
				<p>{$result['date_deal']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Заявка закрыта</h4>
				<p>{$result['date_end']}</p>
			</div>
	</div>";
}	

 ?>

</div></section>
<?php include ("includes/footer.php") ?>