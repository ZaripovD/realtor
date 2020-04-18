<?php include ("includes/sideadmin.php");?>

<section id='apartment-story'>
	<div class='container admin'>

<?php
$now = date("Y-m-d");
	$sql = mysqli_query($connection,  
		"SELECT operations.id as 'ID', giver.family as 'fam', giver.name as 'name', apartments.id as 'number', summary, status.name as 'status', date_deal, apartments.id_status as 'ids', user.family as 'family', user.name 'namee', give_type.name as 'giving', apt_type.name as 'apt'
		FROM operations
		LEFT JOIN apartments on operations.id_apartment = apartments.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN user on operations.buyer = user.id
		LEFT JOIN giver on operations.user = giver.id_user
		LEFT JOIN give_type on apartments.type = give_type.id
		LEFT JOIN status on operations.id_status = status.id
		WHERE operations.id_status = 1
		ORDER BY operations.id DESC");
	echo mysqli_error($connection);

if (isset($_POST['accept_id'])) {

		if ($_POST['worker'] == 1) {
				echo "<div class='row text-center'>
			<div class='col-md-12'>
				<h3>Назначьте риэлтора</h3>
			</div></div>";
			}else{

				$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 5, realtor = '{$_POST['worker']}' WHERE operations.id = {$_POST['id']}");
				if (!$update) {
					echo mysqli_error($connection);
				}else{
					echo "<div class='row text-center'>
			<div class='col-md-12'>
				<h3>Запрос одобрен, риэлтор {$_POST['worker']} назначен</h3>
			</div></div>";
				}
				
			}
}

if (isset($_POST['reject_id'])) {
	$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 10, `date_end` = '$now' WHERE operations.id = {$_POST['id']}");
	echo "<div class='row text-center'>
			<div class='col-md-12'>
				<h3>Заявка отклонена</h3>
			</div></div>";
}

while ($result = mysqli_fetch_array($sql)) {

echo "<form action='waiting.php' method='post'>
      <input type='hidden' name='id' value='{$result['ID']}'>
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
			<div class='col-md-1'>
				<h4>{$result['apt']}</h4>
				<p>{$result['giving']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Заявка подана</h4>
				<p>{$result['date_deal']}</p>
			</div>";
			echo "<div class='col-md-2'>
			<h4>Риэлтор</h4>
			<select name='worker'>";
           $worker = mysqli_query($connection, "SELECT id, family, name FROM user WHERE id_role = 3");
            if($worker)          
              {
                $workerrows = mysqli_num_rows($worker); // количество полученных строк     

               for ($i = 0 ; $i < $workerrows ; ++$i)
                {
                  $workerrow = mysqli_fetch_row($worker);
                  echo " <option>$workerrow[0] $workerrow[1] $workerrow[2] </option>";
                }
              }
          echo "</select></div>			
	<div class='row deal_buttons'>
  <div class='col-md-10'>
 		<button name='reject_id' class='btn btn-danger'>Отказать</button>
 	</div>
 	<div class='col-md-1'>
 		<button class='btn btn-success' name='accept_id'>Одобрить</button>
 	</div>
  </div>
	</div></form>";
}	

 ?>

</div></section> 
<?php include ("includes/footer.php") ?>