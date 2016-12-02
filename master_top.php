<!DOCTYPE html>
<html>
    <head>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="Styles/bootstrap.min.css">
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
          <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
         <link rel="stylesheet" href="Styles/masterStyles.css"/>
         <link rel="icon" type="image/png" href="Images/Index/faviconLogo.png" />
        <title>
            Web Apps Beer Tracker
        </title>
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-default navbar-custom">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="./index.php" class="navbar-brand"><img src="Images/Index/miniLogo.png"></a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li>
                      <a href="./breweries.php">Breweries</a>
                  </li>
                  <li>
                      <a href="./beers.php">Beers</a>
                  </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  
                    <?php session_start();?>
                  <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == '') { ?>
                      <li><a href="/sign_in.php" >Login</a></li>
                  <?php } else { 
                      echo "<li class='hidden-xs'>
                        <p class='navbar-text'>
                        <a href='./profile.php'>Hello, " . explode(' ',$_SESSION["name"])[0] . "</a></p></li>"?>
                      <li><a href="/Controllers/Users/logout.php" >Logout</a></li>
                  <?php } ?>
                  
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <!-- /navbar -->
        <div class="container">
            