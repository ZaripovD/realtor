<!DOCTYPE html>

<?php include ("includes/session.php");?>

<form method="POST" action="createapartment.php" id="apartment-add">
    <div class="container admin">
        <div class="col-md-8">          
        <h4>Выставляется </h4>

            <select name="give_type" id="zzz">
            <?php
             $query ="SELECT * FROM give_type where id <> 0";
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
        </div>
<div class="row"><div class="col-md-12"><h1></h1></div></div>
        <div class="col-md-8"> 
            <select name="apt_type" id="zzz">
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
        </div>

        <div class="row ">
            <div class="col-md-10 click">
                <button id='addAP' name='create' value='create'>
                    Добавить
                </button>

            </div>
        </div>
    </div>
</form>

<?php

if (isset($_POST['create'])) {
    
    $sql = mysqli_query($connection, "
        INSERT INTO apartments (`type`,`give_type`,`id_user`)
        VALUES ('{$_POST['apt_type']}', '{$_POST['give_type']}', '$sesid')");

    if ($_POST['give_type'] == '1 Продается') {
        echo "<script>window.location = 'addSell.php'</script>";        
    } else {
        echo "<script>window.location = 'addRent.php'</script>";
    }

}
?>

<?php include ("includes/footer.php") ?>

