<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Новострой</title>
    <link rel="shortcut icon" href="img/logo.png" />

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>    
    <header class="hidden-xs">
      <div class="container">
        <div class="row">
          <div class="col-md-2"><img src="img/logo.png" alt="Лого">
          </div>
          <div class="col-md-6 ">
            <nav>
              <ul class="list-inline">
                <li><a href="index.php">Главная</a></li>
                <li><a href="list.php">Предложения</a></li>
                <li><a href="#contacts">Контакты</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-md-3 login">
            <a href="adminlist.php">Админ панель</a> /
            <a href="php/logout.php">Выход</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php echo ('<div class="col-md-4 col-md-offset-8">Вы администратор '.$_SESSION['logged_user']->family.' '.$_SESSION['logged_user']->name.'</div>');  ?>
          </div>
        </div>
      </div>  
    </header>

  <header class="visible-xs">
    <ul class="list-inline adaptHead">
        <li><a href="index.php"><img src="img/logo.png" alt="логотип"></a></li>
        <li>
    <nav><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-bars"></i>
          </a>
        
        <ul class="dropdown-menu">
            <li><a href="index.php">Главная</a></li>
            <li><a href="list.php">Предложения </a></li>
            <li><a href="#contacts">Контакты</a></li>
            <li><a href="adminlist.php">Админ панель</a></li>
            <li><a href="php/logout.php">Выход</a></li>
          </ul>
    </nav>
          </li>
      </ul>
  </header>