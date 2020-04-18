<!DOCTYPE html>
<?php include("includes/session.php") ?>

<section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="img/main.jpg" alt="рис1">
        </div>
        <div class="col-md-7">
          <h3>Альметьевская риэлторская компания, которая не оставит ваш дом без хозяина.</h3>
        </div>
      </div>
    </div>
  </section>

  <section id="why">
    <div class="container">
      <div class="row">
        <div class="col-md-12 box">
          <h2>Кто мы?</h2>
          <ul>
            <li>Мы команда целеустремленных, динамичных, глубоких личностей.</li>
            <li>Мы развиваем молодую, интеллектуальную, чувствующую социум компанию.</li>
            <li>Мы уверенно принимаем ответственность за свои действия.</li>
            <li>Мы создаем свое будущее ярким и свободным.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="news">
    <div class="container">
      <div class="row">
        <h2>Почему с нами лучше?</h2>
        <div class="col-md-3 card">
          <img src="img/news/1.png" alt="1">
          <h3>У вас будет большой выбор</h3>
          <p>Тщательно отбираем базу объектов, проверяем документы на юридическую чистоту.</p>
        </div>
        <div class="col-md-3  card">
          <img src="img/news/2.png" alt="2">
          <h3>Сделка будет безопасной</h3>
          <p>Защитим вашу сделку своими средствами в случае потери права собственности.</p>
        </div>
        <div class="col-md-3  card">
          <img src="img/news/3.png" alt="3">
          <h3>Платите за результат</h3>
          <p>Все консультации и сервисы компании бесплатны. Вы платите только после сделки.</p>
        </div>
        <div class="col-md-3 card">
          <img src="img/news/4.png" alt="4">
          <h3>Всё будет готово для сделки</h3>
          <p>Экономим ваше время: берём всю рутину на себя, вам не нужно тратить время, чтобы разбираться.</p>
        </div>
        </div>
        
      </div>
    </div>
  </section>

<?php 

if (isset($_POST['sending'])) {

  if (!$_SESSION['logged_user']) {     
   echo "<div class='col-md-7 col-md-offset-3'><h2 style='background-color:red; color:white'>Отправка комментариев доступна только авторизованным пользователям!</h2></div>";
   }else 
   if ( strlen($_POST['comment']) < 10 || strlen($_POST['comment']) > 140) {
   echo "<div class='col-md-12'><h2 style='background-color:red; color:white'>Комментарий не может быть короче 10 символов и длиннее 140!</h2></div>";
  } else {

  $now = date("Y-m-d H:i:s");
  $idu = $_SESSION['logged_user']->id;
  $sql = mysqli_query($connection, "
    INSERT INTO comments (`id_user`, `text`, `date`)
    VALUES
    ('$idu', '{$_POST['comment']}', '$now')");
    if (!$sql) {
    echo mysqli_error($connection);
  }
  }

}
?>
<section id="comments">    
    <div class="container">
      <form action="index.php" method="post">
      <div class="row input">
        <h2>Комментарии</h2>        
        <div class="col-md-10 col-md-offset-1">
          <input name="comment" placeholder= "Введите комментарий">
        </div>
        <div class="col-md-11 sendcom">
          <button name="sending">
            Отправить
          </button>
        </div>        
      </div>
    </form>

    <?php
    $comm = mysqli_query($connection, "SELECT comments.text as 'text', user.name as 'name', user.family as 'fam', comments.date as 'when', profile_img.id_user as 'pict', extension, id_status, user.id as 'id'
      FROM comments
      LEFT JOIN user on comments.id_user = user.id
      LEFT JOIN profile_img on user.id = profile_img.id_user
      ORDER BY comments.id DESC
      LIMIT 3");

    

    while ($result = mysqli_fetch_array($comm)) {
      $ext = $result['extension'];
  
      echo "
      <div class='row output'>
      <div class='col-md-1 hidden-xs'>";
            if ($result['id_status'] == 8) {
              echo "<img id='profilePic'src='img/uploads/profile/profile".$result['id'].".".$ext."'>";
            } else {
              echo "<img id='profilePic' src='img/uploads/profile/profiledef.jpg'>";
            }echo"
        </div>
        <div class='col-md-7  com'>
          <h3>{$result['fam']} {$result['name']}</h3>
          <p>{$result['text']}</p>
        </div>
        <div class='col-md-2'>
          <h3></h3>
          <p>{$result['when']}</p>
        </div>
      </div><hr>
      ";
    }


    ?>

  </div>
</section>

<?php include("includes/footer.php") ?>