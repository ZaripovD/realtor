<!DOCTYPE html>

<?php include("includes/session.php")?>

<h4> </h4>
<div class="container filter">

<p><span class="col-md-6">
	<button  type="button" data-toggle="collapse" data-target="#2" aria-expanded="false" aria-controls="2">
    Купить
  </button>
</span>
  <span class="col-md-6">
	<button  type="button" data-toggle="collapse" data-target="#1" aria-expanded="false" aria-controls="1">
    Арендовать
  </button>
</span>
</p>
<hr><br>


<div class="collapse" id="2">
  <div class="row">
	<form action="list.php" method="post">
		<div class="row text-center">				
			<div class="col-md-6">
				<select name="apt_type">
				<?php

		$query ="SELECT * FROM apt_type ";
    $status = mysqli_query($connection, $query) or die(mysqli_error($connection));
    if($status)

    {
    $statusrows = mysqli_num_rows($status); // количество полученных строк

    for ($i = 0 ; $i < $statusrows ; ++$i)
    {
        $statusrow = mysqli_fetch_row($status);
        echo " <option>$statusrow[0] $statusrow[1] </option>";
    }
    }
     ?>
			</select>
		</div>

			<div class="col-md-5">
				<button type="submit" name="sort">Показать</button>
			</div>	
		</div>
	</form>  
  </div>
</div>


<div class="collapse" id="1">
  <div class="row">
		<form action='list.php' method='post'>
		<div class='row text-center'>
			<div class="col-md-2"><h3></h3>
			<select name="apt_type">
			<?php
			$query ="SELECT * FROM apt_type ";
    		$status = mysqli_query($connection, $query) or die(mysqli_error($connection));
    		if($status)
    		{
    		$statusrows = mysqli_num_rows($status); // количество полученных строк
	   	 	for ($i = 0 ; $i < $statusrows ; ++$i)
	    	{
	        $statusrow = mysqli_fetch_row($status);
	        echo " <option>$statusrow[0] $statusrow[1] </option>";
	   		}
	    	}
	     	?>
			</select>
		</div>
		<div class='col-md-3'><h3></h3>
		<select name='rent_type'>
			<?php  
			$query ='SELECT * FROM rent_type ';
		    $rentie = mysqli_query($connection, $query) or die(mysqli_error($connection));
		    if($rentie)
		    {
		    $rentierows = mysqli_num_rows($rentie); // количество полученных строк
		    for ($i = 0 ; $i < $rentierows ; ++$i)
		    {
		        $rentierow = mysqli_fetch_row($rentie);
		        echo "<option>$rentierow[0] $rentierow[1] </option>";
		    }
		    }?>
		</select>
		</div>
			<div class='col-md-2'>
		  		Желаемый въезд: <input class='form-control' type='date' name='income'>
			</div>

			<div class='col-md-2'>
			    Желаемый выезд: <input class='form-control' type='date' name='outcome'>
			</div>

			<div class='col-md-3'><h3></h3>
			<button class='btn btn-outline-success' type='submit' name='find'>
			    Найти
			</button>
			</div>

 			</div>
	    </form>
  </div>
</div>	


</div>

<script>

	function reload(){
		window.location = 'list.php'
	}

</script>

<section id="listing">
	<div class="container lists text-center">

<?php 

	if (isset($_POST['sort'])) {
		$sql = mysqli_query($connection, "
		SELECT apartments.id as 'id', apartments.floor as 'floor', apartments.rooms as 'rooms', apartments.square as 'square', apartments.price as 'price', apt_type.name as 'type', give_type.name as 'give_type', description, rent_type, street, house
		FROM apartments
		LEFT JOIN rent_type on apartments.rent_type = rent_type.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN give_type on apartments.give_type = give_type.id		
		WHERE id_status = '4' and type = '{$_POST['apt_type']}' and give_type = '1' and id_user <> '$sesid'");	
	}

	if (isset($_POST['find'])) {

		$errors = array();
		$dateStart = strtotime($_POST['income']);
		$dateEnd = strtotime($_POST['outcome']);

		if ($_POST['income'] == '' || $_POST['outcome'] == '') {
				$errors[] = "Введите корректные даты";
			}

		if ($_POST['rent_type'] == '1 На сутки') {

			$summary = ($dateEnd - $dateStart) / (60 * 60 * 24);
			if ($dateEnd <= $dateStart) {
				$errors[] = "Можно снять минимум на ночь";
			} 
		} 

		if ($_POST['rent_type'] == '2 На длительный срок') {
			$summary = ceil(($dateEnd - $dateStart) / (60 * 60 * 24 * 30));

			if ($summary < 1) {
				$errors[] = "Можно арендовать минимум на месяц";
			}
		}

		if (empty($errors)) {
			if ($_POST['rent_type'] == '2 На длительный срок') {
				echo "Месяцы: ".$summary."<br>";
			}
			
			$dates = mysqli_query($connection,"
				INSERT INTO dates (`start`,`end`,`user`, `summary`)
				VALUES ('{$_POST['income']}','{$_POST['outcome']}','$sesid', '$summary')");

		
			$sql = mysqli_query($connection, "
		SELECT DISTINCT apartments.id as 'id', apartments.floor as 'floor', apartments.rooms as 'rooms', apartments.square as 'square', apartments.price as 'price', apt_type.name as 'type', give_type.name as 'give_type', description, rent_type, street, house
		FROM operations
		LEFT JOIN apartments on operations.id_apartment = apartments.id
		LEFT JOIN rent_type on apartments.rent_type = rent_type.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN give_type on apartments.give_type = give_type.id		
		WHERE apartments.id_status = '4' and give_type = '2' and type = '{$_POST['apt_type']}' and date_end < '{$_POST['income']}' and rent_type = '{$_POST['rent_type']}' and id_user <> '$sesid'");
			echo mysqli_error($connection);
		}
		else {
			echo "<script>setTimeout(reload, 1500)</script>";
			die(array_shift($errors));
		}
		
	}
	if (!isset($_POST['sort']) && !isset($_POST['find'])) {

		$sql = mysqli_query($connection, "
		SELECT apartments.id as 'id', apartments.floor as 'floor', apartments.rooms as 'rooms', apartments.square as 'square', apartments.price as 'price', apt_type.name as 'type', give_type.name as 'give_type', description, rent_type, street, house
		FROM apartments
		LEFT JOIN rent_type on apartments.rent_type = rent_type.id
		LEFT JOIN apt_type on apartments.type = apt_type.id
		LEFT JOIN give_type on apartments.give_type = give_type.id		
		WHERE id_status = '4' and give_type = '1'");
	}
		if (mysqli_num_rows($sql)==0) {
			echo "К сожалению, результатов по вашим параметрам не найдено";
		}else {
			while ($result = mysqli_fetch_array($sql) ) {
		$idAp = $result['id'];

		if ($result['rent_type'] == 0) {
          $term = " ";
        }elseif ($result['rent_type'] == 1) {
          $term = "/сутки";
        }elseif ($result['rent_type'] == 2){
          $term = "/месяц";
        }

		echo "
			<div class='row card'>
			<div class='col-md-12'>
				<h2>{$result['give_type']} {$result['type']}</h2>
			</div>
				<div class='col-md-4'>
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

			<div class='col-md-8'>
	             <div class='row'>
	               <div class='col-md-2'>
	                 <h3>Площадь</h3>
	                  <h4>{$result['square']}</h4>
	               </div>
	               <div class='col-md-2'>
	                 <h3>Этаж</h3>
	                  <h4>{$result['floor']}</h4>
	               </div>
	               <div class='col-md-2'>
	                 <h3>Комнат</h3>
	                  <h4>{$result['rooms']}</h4>
	               </div>
	               <div class='col-md-3'>
	                 <h3>Адрес</h3>
	                  <h4>{$result['street']}, {$result['house']}</h4>
	               </div>
	             </div>
	             <div class='row'>
	                  <div class='col-md-12'>
	                    <h2>Описание: </h2>
	                    <h4>{$result['description']}</h4>
	                  </div>          
	                  <div class='col-md-12'>
	                    <h2>Стоимость: {$result['price']} руб.{$term}</h2>
					<a href='flat.php?id={$result['id']}' class='btn btn-primary'>
						Посмотреть
					</a>
	                  </div>
	             </div>
	        </div>
				<div class='col-md-12 text-center'>
				</div>
			</div>
		";}
		}
		

?>
		
	</div>
</section>



 <?php include("includes/footer.php") ?>