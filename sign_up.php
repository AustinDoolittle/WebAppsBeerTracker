<?php require_once("master_top.php"); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div id="splash">
            <?php if(isset($_GET["error"])) { 
                if($_GET["error"] == "alreadytaken") {
                    echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='alert alert-warning'><strong>Warning</strong> This email already has an account</div>";
                }
                else if($_GET["error"] == "unknown") {
                    echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='alert alert-warning'><strong>Warning</strong> An unknown error was encountered, please try again</div>";
                }
            } ?>
        </div>
        <h3>Sign Up</h3>
        <form action="../Controllers/Users/new.php" method="post" id="sign-up-form" onsubmit="return validate()">
            <div class="form-group">
                <label for="txtName">Name:</label>
                <input class="form-control" type="text" name="name" id="txtName"/>
            </div>
            <div class="form-group">
                <label for="txtEmail">Email:</label>
                <input class="form-control" type="email" name="email" id="txtEmail"/>
            </div>
            <div class="form-group row">
                <label for="ddlAge" class="col-sm-2 col-form-label">Age:</label>
                <div class="col-sm-4">
                    <select class="form-control " name="age" id="ddlAge"></select>
                </div>
            </div>
            <div class="form-group">
                <label for="txtPassword1">Password:</label>
                <input class="form-control" type="password" name="password" id="txtPassword1"/>
            </div>
            <div class="form-group">
                <label for="txtPassword2">Confirm Password:</label>
                <input class="form-control" type="password" id="txtPassword2"/>
            </div>
            <input type="submit" class="btn btn-primary"/>
        </form>
    </div>
</div>
<script>
    //populate dropdown on load
    $(function() {
        populateDropDown();
        //$('#sign-up-form').submit(submitForm);
    });
    
    var populateDropDown = function() {
        var ddl = $('#ddlAge');
        for(var i = 1; i <= 100; i++) {
            var opp = $('<option>');
            opp.val(i);
            opp.html(i);
            ddl.append(opp);
        }
    };
    
    var submitForm = function(event) {
        event.preventDefault();
        if(!validate()) {
            return false;
        }
        
        $.ajax({
            email: $('#txtEmail').val(),
            name: ''
        });
    }
    
    var validate = function() {
        var email, name, password1, password2, age, splash, retVal;
        splash = $('#splash').empty();
        email = $('#txtEmail');
        name = $('#txtName');
        password1 = $('#txtPassword1');
        password2 = $('#txtPassword2');
        age = $('#ddlAge');
        retVal = true;
        
        if(!validateEmail(email.val())) {
            splash.append($('<div>').addClass('alert alert-warning').html("<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning</strong> Invalid email address"));
            retVal = false;
        }
        
        if(name.val().trim() == '') {
            splash.append($('<div>').addClass('alert alert-warning').html("<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning</strong> Invalid name"));
            retVal = false;
        }
        
        if(password1.val().length < 8) {
            splash.append($('<div>').addClass('alert alert-warning').html("<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning</strong> Password must be at least 8 characters long"));
            retVal = false;
        }
        else if(password1.val() != password2.val()) {
            splash.append($('<div>').addClass('alert alert-warning').html("<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning</strong> Passwords do not match"));
            retVal = false;
        }
        
        if(age.val() < 21) {
            splash.append($('<div>').addClass('alert alert-warning').html("<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning</strong> You must be 21 or over to access this site"));
            retVal = false;
        }
        
        return retVal;
    };
    
    //email validation borrowed from http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
    var  validateEmail = function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
</script>
<?php require_once("master_bottom.php"); ?>