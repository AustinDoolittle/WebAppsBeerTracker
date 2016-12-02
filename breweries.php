<?php require_once("master_top.php");
include 'db_connect.php';

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

$query = $conn->prepare("SELECT ID, Name, Address, Description, WebsiteUrl, ImagePath FROM Breweries");

$query->execute();

$query->bind_result($id, $name, $address, $desc, $url, $img);
?>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <?php if(isset($_GET["success"]) && $_GET["success"]) {
            ?><div class="alert alert-success"><strong>Success!</strong> You added a new brewery</div><br/><?php
        } 
        
        if ($_SESSION["logged_in"]) {?>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#new_brewery">
          New Brewery
        </button>
        <?php } ?>
    </div>
</div>


<div class="container">
  <?php
        while($query->fetch()) {
    ?>
        <div class="row row-eq-height">
            <div class="col-md-2 flex-center">
                 <h3><?php echo $name ?></h3>
                        <?php if($img != '' && $img != null) {
                            ?><img src="/Images/Breweries/<?php echo $img?>" width="100px"/><?php
                        }?>
            </div>
            
            <div class="col-md-2 flex-center">
             <?php echo $address ?>
            </div>
            
             <div class="col-md-3 flex-center">
             <?php echo $desc ?>
            </div>
            
            <div class="col-md-3 flex-center">
             <?php echo $url ?>
            </div>
            
             <div class="col-md-2 flex-center">
            <a class="btn btn-default btn-md" href="./brewery.php?id=<?php echo $id?>">View</a>
            </div>

        </div>
    <?php
        }
        $query->close();
        $conn->close();
    ?>
</div>




<?php 
if($_SESSION["logged_in"]) {
    require_once("./Partials/new_brewery.php");
    
}
    require_once("master_bottom.php"); ?>
