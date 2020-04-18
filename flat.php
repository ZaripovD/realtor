<?php include("includes/session.php");error_reporting(0);
echo "
	<section id='listing'>
	<div class='container lists'>";
$idi = $_POST['idi'];
$now = date("Y-m-d");
$dates = mysqli_query($connection,"
	SELECT * FROM dates WHERE user = $sesid ORDER BY id DESC LIMIT 1");
while ($stEn = mysqli_fetch_assoc($dates)) {
	$startDate = $stEn['start'];
	$endDate = $stEn['end'];
	$date = $stEn['summary'];
}

$sql = mysqli_query($connection, "
	SELECT apartments.id as 'id', apartments.floor as 'floor', apartments.rooms as 'rooms', apartments.square as 'square', apartments.price as 'price', apt_type.name as 'type', give_type.name as 'give_type', description, give_type.id as 'giveID', giver.id_user as 'id_user', street, house, giver.phone as 'phone', giver.mail as 'mail', id_status
		FROM apartments
		LEFT JOIN giver on apartments.id_user = giver.id_user
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN give_type on apartments.give_type = give_type.id		
		WHERE apartments.id = '{$_GET['id']}' or apartments.id = '$idi'");

echo mysqli_error($connection);

if (isset($_POST['mortgage'])) {
	
	$add = mysqli_query($connection, "
		INSERT INTO operations (`user`,`id_apartment`,`id_status`,`date_deal`, `buyer`)
		VALUES ('{$_POST['owner']}','$idi','1','$now','$sesid') ");
	if ($add) {
		echo "<div class='row card'>
		<div class='col-md-12'>
			<h1>Ваша заявка отправлена на рассмотрение, с вами свяжутся в скорейшем времени</h1>	
		</div></div>";
	}
}

if (isset($_POST['once'])) {
	
	$add = mysqli_query($connection, "
		INSERT INTO operations (`user`,`id_apartment`,`id_status`,`date_deal`, `buyer`)
		VALUES ('{$_POST['owner']}','$idi','1','$now','$sesid') ");
	
		if ($add) {
		echo "<div class='row card'>
		<div class='col-md-12'>
			<h1>Ваша заявка отправлена на рассмотрение, с вами свяжутся в скорейшем времени</h1>	
		</div></div>";
	}
}

	while ($result = mysqli_fetch_array($sql)) {		
		$idAp = $result['id'];

		if ($idAp == 2) {
			die("<h1>Квартира удалена</h1>");
		}
echo "
	<div class='row card'>

		<div class='col-md-2'>
			<h3>Площадь</h3>
			<h4>{$result['square']}</h4>			
		</div>

		<div class='col-md-2'>			
			<h3>Комнат</h3>
			<h4>{$result['rooms']}</h4>
		</div>

		<div class='col-md-2'>
			<h3>Этаж</h3>
			<h4>{$result['floor']}</h4>	
		</div>

		<div class='col-md-2'>
			<h3>Адрес</h3>
			<h4>{$result['street']}, д{$result['house']}</h4>			
		</div>

		<div class='col-md-4'>
			<h3>Связь с владельцем</h3>
			<h4><a href='tel:{$result['phone']}'>{$result['phone']}</a></h4>
			<h4><a href='mailto:{$result['mail']}'>{$result['mail']}</a></h4>
		</div>

		<div class='col-md-12'>
			<h2>Стоимость: {$result['price']} Руб</h2>
			
		</div>

	<div class='col-md-12'>
					<div class='fotorama'>";			
	  				$ph = mysqli_query($connection, "SELECT * FROM apt_img WHERE id_apt = '$idAp'");
					while ($row = mysqli_fetch_assoc($ph)) {
											
						$file = $row['file'];
						$extt = $row['extension'];
						echo "<img src='img/uploads/apartment/".$idAp."-".$file.".".$extt."' id='img_div'>";
					}
	  			echo "
					</div>
	</div>
	</div>

<form action='flat.php' method='post'>
	<div class='row method'>
	<input type='hidden' value='{$result['id']}' name='idi'>
	<input type='hidden' value='{$result['id_user']}' name='owner'>
	";
	if ($ses) {
		if ($result['id_status'] == 4) {
			if ($result['giveID'] == 2) {				
			$money = $date * $result['price'];
			echo "<div class='col-md-12 text-center'>
					<h3>Аренда с {$startDate} по {$endDate} составит {$money} руб</h3>
					<button name='once'>
						Арендовать
					</button>
				</div>";
			}else{
				echo "
				<div class='col-md-12 text-center'>
					<button name='mortgage'>
						Купить
					</button>
				</div>";
			}			
		}		
	}else{
		echo "
		<div class='col-md-12 text-center'>
				<h2>Для совершения операции необходимо <a href='signin.php'>авторизоваться</a></h2>
		</div>";
	}

echo "	

	</div>
</form>
	</div>
</section>";


}
?>

<?php include("includes/footer.php") ?>