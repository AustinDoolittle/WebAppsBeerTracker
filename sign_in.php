<?php require_once("master_top.php"); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="splash">
                <?php if(isset($_GET["error"])) { 
                if($_GET["error"] == "unknown") {
                    echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='alert alert-warning'><strong>Warning</strong> An unknown error was encountered, please try again</div>";
                }
                else if($_GET["error"] == "incorrect") {  
                    echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='alert alert-danger'><strong>Warning</strong> Incorrect login information</div>";
                }
            } ?>
            </div>
            <h3>Login</h3>
            <form action="Controllers/Users/login.php" method="post">
                <div class="form-group">
                    <label for="txtEmail">Email:</label>
                    <input type="text" id="txtEmail" name="email" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtPassword">Password:</label>
                    <input type="password" id="txtPassword" name="name" class="form-control"/>
                </div>
                <input type="submit" text="Login" class="btn btn-primary" />
            </form>
            <a href="./sign_up.php">Sign Up</a>
        </div>
    </div>
<?php require_once("master_top.php"); ?>