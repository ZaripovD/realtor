<?php 
include 'includes/session.php';
if (isset($_POST['newPhoto'])) {
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 6000000) {
				$fileNameNew = "profile".$sesid.".".$fileActualExt;
				$fileDestination = 'img/uploads/profile/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);

				header("Location: persarea.php");
				$update = mysqli_query($connection, "
					UPDATE profile_img 
					SET id_status = 8, extension = '$fileActualExt' ");
			} else {
				echo "Размер файла слишком большой!";
			}
		} else {
			echo "Произошла ошибка при загрузке файла.";
		}
	} else {
		echo "Этот тип файлов запрещен для загрузки!";
	}
}

 ?>