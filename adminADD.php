<!DOCTYPE html>

<?php include ("includes/session.php");
include ("includes/sideadmin.php");

if (isset($_POST['add'])) {

	// проверка формы на пустоту полей
    $errors = array();

    //проверка на существование вводимого номера квартиры
    

     if (empty($errors)) {
    $adding = mysqli_query($connection, "
        INSERT INTO apartments (`floor`, `rooms`, `square`, `price`, `id_status`, `type`, `give_type`, `price`, `description`)
        VALUES 
        ('{$_POST['floor']}', '{$_POST['rooms']}', '{$_POST['square']}', '{$_POST['price']}', '1', '{$_POST['type']}', '{$_POST['give_type']}', '{$_POST['price']}', '{$_POST['description']}')");
    echo "Квартира добавлена!";
  }else{
    echo array_shift($errors);
  }	
}


?>


<form method="POST" action="adminADD.php" id="apartment-add">
	<div class="container admin">
        <div class="col-md-4">
            <div class="col-md-10">
                
            <img src="#" class="big-img" alt="Большое фото">
            </div>
            <div class="row little-imgs">
                <img src="#" class="little-img" alt="маленькое фото">
                <img src="#" class="little-img" alt="маленькое фото">
                <img src="#" class="little-img" alt="маленькое фото">
                <img src="#" class="little-img" alt="маленькое фото">
            </div>
            <div class="row">
                <button class="btn-danger photo">
                    Загрузить фото
                </button>
            </div>
        </div>
		<div class="col-md-8">			
			
				<h4>Этажность</h4>
				<input type="text" name="floor" size="3">
			
			
				<h4>Комнаты</h4>
				<input type="text" name="rooms" class="apartment-selection">				
			
			
				<h4>Площадь</h4>
				<input type="text" name="square" size="3">
						
			
				<h4>Категория</h4>
                <select name="type" id="zzz">
        <?php
    $query ="SELECT * FROM apt_type where id <> 0";
    $mark = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection));
    if($mark)

    {
    $markrows = mysqli_num_rows($mark); // количество полученных строк

    for ($i = 0 ; $i < $markrows ; ++$i)
    {
        $markrow = mysqli_fetch_row($mark);
        echo " <option>$markrow[0] $markrow[1] </option>";
    }
    }
     ?>
      </select>
			
			
				<h4>Стоимость</h4>
				<input type="text" name="price" size="3">
			
            
                <h4>Описание</h4>
                <textarea type="text" name="price" cols="101" rows="7"> </textarea>
            
		</div>
		<div class="row ">
			<div class="col-md-10 click">
				<button id="addAP" name="add">
					Добавить
				</button>
			</div>
		</div>
	</div>
</form>

<?php include ("includes/footer.php") ?>

