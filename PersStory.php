<!DOCTYPE html>
<title>Личный кабинет</title>
<?php include("includes/sidebar.php");  ?>

<section id='apartment-story'>
  <div class='container admin'>
<?php
  $sql = mysqli_query($connection,  
    "SELECT operations.id as 'ID', giver.family as 'fam', giver.name as 'name', apartments.id as 'number', summary, status.name as 'status', date_deal, apartments.id_status as 'ids', user.family as 'family', user.name 'namee', give_type.name as 'giving', apt_type.name as 'apt', price,  buyer, giver.id as 'id'
    FROM operations
    LEFT JOIN apartments on operations.id_apartment = apartments.id
    LEFT JOIN apt_type on apartments.type = apt_type.id
    LEFT JOIN user on operations.buyer = user.id
    LEFT JOIN giver on operations.user = giver.id_user
    LEFT JOIN give_type on apartments.type = give_type.id
    LEFT JOIN status on operations.id_status = status.id
    WHERE operations.user = $sesid and operations.id_status <> 7");

  $buys = mysqli_query($connection,  
    "SELECT operations.id as 'ID', giver.family as 'fam', giver.name as 'name', apartments.id as 'number', summary, status.name as 'status', date_deal, apartments.id_status as 'ids', user.family as 'family', user.name 'namee', give_type.name as 'giving', apt_type.name as 'apt', giver.id as 'id', buyer
    FROM operations
    LEFT JOIN apartments on operations.id_apartment = apartments.id
    LEFT JOIN apt_type on apartments.type = apt_type.id
    LEFT JOIN user on operations.buyer = user.id
    LEFT JOIN giver on operations.user = giver.id_user
    LEFT JOIN give_type on apartments.type = give_type.id
    LEFT JOIN status on operations.id_status = status.id
    WHERE operations.buyer = $sesid");


if (mysqli_num_rows($buys) > 0) {
    echo "<h2>Покупки и съём</h2>";
    while ($bu = mysqli_fetch_array($buys)) {
      
    echo "
      <div class='row story'>
          <div class='col-md-2'>
            <h4>Владелец</h4>
            <p><a href='profile.php?giver={$bu['id']}'>{$bu['fam']} {$bu['name']}</a></p>
          </div>
          <div class='col-md-2'>
            <h4>Номер квартиры</h4>
            <p>{$bu['number']}</p>
          </div>
          <div class='col-md-2'>
            <h4>Сумма</h4>
            <p>{$bu['summary']}</p>
          </div>
          <div class='col-md-2'>
            <h4>Реципиент</h4>
            <p><a href='profile.php?profile={$sesid}'>{$bu['family']} {$bu['namee']}</a></p>
          </div>    
          <div class='col-md-2'>
            <h4>Статус</h4>
            <p>{$bu['status']}</p>
          </div>
          <div class='col-md-2'>
            <h4>Запрос отправлен</h4>
            <p>{$bu['date_deal']}</p>
          </div>
      </div>";
      }
}

if (mysqli_num_rows($sql) > 0) {
  echo "<h2>Продажи и сдачи в аренду</h2>";
while ($result = mysqli_fetch_array($sql)) {
  
echo "
  <div class='row story'>
      <div class='col-md-2'>
        <h4>Владелец</h4>
        <p><a href='profile.php?giver={$sesid}'>{$result['fam']} {$result['name']}</a></p>
      </div>
      <div class='col-md-2'>
        <h4>Номер квартиры</h4>
        <p>{$result['number']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Стоимость</h4>
        <p>{$result['price']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Реципиент</h4>
        <p><a href='profile.php?profile={$result['id']}'>{$result['family']} {$result['namee']}</a></p>
      </div>    
      <div class='col-md-2'>
        <h4>Статус</h4>
        <p>{$result['status']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Запрос получен</h4>
        <p>{$result['date_deal']}</p>
      </div>
  </div>";
  } 
}

if (mysqli_num_rows($sql) == 0 && mysqli_num_rows($buys) == 0) {
  echo "<h2>Вы не совершали никаких операций</h2>";
}

 ?>
</div>
</section>

<?php include ("includes/footer.php") ?>