   <?php include("includes/session.php");

   $sql = mysqli_query($connection, "
   SELECT * FROM giver WHERE id_user = '$sesid'");

   $num = mysqli_num_rows($sql); ?>
<section>
  <div class="container">
     <aside style="width: 10%">             
        <ul class="nav bd-sidenav">
          <li>
            <a href="PersArea.php">
              Персональная информация
            </a>
          </li>
          <li>
            <a href="PersStory.php">
              История операций
            </a>
          </li>
          <?php if ($num > 0) {
            echo "
          <li>
            <a href='Persgives.php'>
              Мои предложения
            </a>
          </li>";
          } ?>
        </ul>
      </aside>   
  </div> 
</section>
