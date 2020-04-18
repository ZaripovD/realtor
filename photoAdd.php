<?php include ("includes/session.php");

$getId = mysqli_query($connection, "SELECT * FROM apartments WHERE id_user = '$sesid' ORDER BY id DESC LIMIT 1");
  while ($res = mysqli_fetch_array($getId)) {
  	$idAp = $res['id'];
  }


?>

<section id="photoAdd">
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<h1>Для дальнейшей регистрации апартаментов добавьте не менее четырех фото</h1>
			</div>
			<form action="photoAdd.php" method="post" enctype="multipart/form-data">	
				<div class="col-md-4">
					<input type="file" name="file">
				</div>	
				<div class="col-md-4">
					<button type="submit" name="upload">
						Загрузить
					</button>
				</div>
			</form>
			<?php if (isset($_POST['upload'])) {

	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$letters = substr("$fileName", 0, 10);

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 6000000) {
				$fileNameNew = $idAp."-".$letters.".".$fileActualExt;
				$fileDestination = 'img/uploads/apartment/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$update = mysqli_query($connection, "
					INSERT INTO  `apt_img` (`id_apt`,`file`, `extension`)
					VALUES ('$idAp','$letters', '$fileActualExt')");
				
					echo "<div class='col-md-12'><a href='added.php'  class='btn btn-primary stretched-link' style='background-color: grey'>Закончить</a></div>";
				
					
			} else {
				echo "Размер файла слишком большой!";
			}
		} else {
			echo "Произошла ошибка при загрузке файла.";
		}
	} else {
		echo "Этот тип файлов запрещен для загрузки!";
	}
} ?>
		</div>
		<div class="row ">			
				<?php

	  				$result = mysqli_query($connection, "SELECT * FROM apt_img WHERE id_apt = '$idAp'");
					while ($row = mysqli_fetch_assoc($result)) {						
						$extt = $row['extension'];
						$file = $row['file'];
						echo "<div class='col-md-4'>";
						echo "<img src='img/uploads/apartment/".$idAp."-".$file.".".$extt."'class='img_div'>
						</div>";
					}
	  			?>
		</div>
	</div>
</section>

<?php include ("includes/footer.php") ?>