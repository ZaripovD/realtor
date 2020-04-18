<!DOCTYPE html>
<title>Личный кабинет</title>

<?php include("includes/sidebar.php");  ?>



      <section id="listing">
  <div class="container lists text-center">
          <div class="text-center">
            <h1>Мои апартаменты</h1>
            <div class="col-md-1 col-md-offset-11">
      </div> 

      <?php 

$sql = mysqli_query($connection, "SELECT apartments.id as 'id', apartments.floor as 'floor', apartments.rooms as 'rooms', apartments.square as 'square', apartments.price as 'price', apt_type.name as 'type', give_type.name as 'give_type', description, rent_type, status.name as 'status'
    FROM apartments
    LEFT JOIN status on apartments.id_status = status.id
    LEFT JOIN apt_type on apartments.type = apt_type.id
    LEFT JOIN give_type on apartments.give_type = give_type.id    
    WHERE id_user = '$sesid'");
  if (!$sql) {
  echo "raaaz". mysqli_error($connection);
}
    while ($result = mysqli_fetch_array($sql)) {

        if ($result['rent_type'] == 0) {
          $term = " ";
        }elseif ($result['rent_type'] == 1) {
          $term = "/сутки";
        }elseif ($result['rent_type'] == 2){
          $term = "/месяц";
        }
      

    $idAp = $result['id'];
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
               <div class='col-md-2'>
                 <h3>Статус</h3>
                  <h4>{$result['status']}</h4>
               </div>
             </div>
             <div class='row'>
                  <div class='col-md-12'>
                    <h2>Описание: </h2>
                    <h4>{$result['description']}</h4>
                  </div>          
                  <div class='col-md-12'>
                    <h2>Стоимость: {$result['price']} руб.{$term}</h2>
                  </div>
             </div>
           </div>
      </div>
    ";}
 ?>
        
    </div>
  </div>
 
    </section>

 <?php include("includes/footer.php"); ?>

