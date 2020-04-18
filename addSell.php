<!DOCTYPE html>

<?php include ("includes/session.php");?>

<?php

$add2 = mysqli_query($connection, "
                SELECT apartments.id as 'id', give_type.name as 'give_type', apt_type.name as 'apt'
                FROM apartments
                LEFT JOIN apt_type on apartments.type = apt_type.id
                LEFT JOIN give_type on apartments.give_type = give_type.id
                WHERE id_user = '$sesid'
                ORDER BY id DESC
                LIMIT 1");

while ($result = mysqli_fetch_array($add2)) {
$newid = $result['id'];
$give = $result['give_type'];
$apt = $result['apt'];
}


if (isset($_POST['add'])) {

    $errors = array();    

    $giverCheck = mysqli_query($connection, "
        SELECT `id`, `phone`, `id_role`, `family`, `name`, `father`, `password`, `mail` 
        FROM `giver` WHERE id = '$sesid'");
    if (mysqli_num_rows($giverCheck)==0) {

        $id = $_SESSION['logged_user']->id;
        $phone = $_SESSION['logged_user']->phone;
        $id_role = $_SESSION['logged_user']->id_role;
        $family = $_SESSION['logged_user']->family;
        $name = $_SESSION['logged_user']->name;
        $father = $_SESSION['logged_user']->father;
        $password = $_SESSION['logged_user']->password;
        $mail = $_SESSION['logged_user']->mail;

        $giverAdd = mysqli_query($connection,"
            INSERT INTO `giver`(`id`, `phone`, `id_role`, `family`, `name`, `father`, `password`, `mail`) VALUES ('$id', '$phone', '$id_role', '$family', '$name', '$father', '$password', '$mail')");
    }

    $adding = mysqli_query($connection, "
        UPDATE apartments 
        SET `floor` = '{$_POST['floor']}', `rooms` = '{$_POST['rooms']}', `square` = '{$_POST['square']}', `price` = '{$_POST['price']}', `description` = '{$_POST['description']}', `street` = '{$_POST['street']}', `house` = '{$_POST['house']}'
        WHERE id = '$newid'");

    header("Location: photoadd.php");
	
}


?>


<form method="POST" action="addSell.php" id="apartment-add">
	<div class="container admin">
		<div class="col-md-8">			

			    <h4><?php echo $give." ".$apt ?></h4>
				<h4>Этажность</h4>
				<input type="text" name="floor" size="3" required>
			
			
				<h4>Комнаты</h4>
				<input type="text" name="rooms" class="apartment-selection" required>				
			
			
				<h4>Площадь</h4>
				<input type="text" name="square" size="3" required>
						
			
                <h4>Улица</h4>
                <input type="text" name="street" size="3" required>

                <h4>Номер дома</h4>
                <input type="text" name="house" size="3" required>

				<h4>Стоимость</h4>
				<input type="text" name="price" size="3" required>
			
            
                <h4>Описание</h4>
                <textarea type="text" name="description" cols="101" rows="7" required> </textarea>
            
		</div>
		<div class="row ">
			<div class="col-md-10 click">
                <button id='addAP' name='add' value='Upload'>
                    Добавить
                </button>

			</div>
		</div>
	</div>
</form>

<?php include ("includes/footer.php") ?>

