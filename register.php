<?php
// $image = addslashesdd
  require_once "config.php";
  if (isset($_POST['submit']) && isset($_FILES['pic'])) {

    $img_name = $_FILES['pic']['name'];
    $img_size = $_FILES['pic']['size'];
    $tmp_name = $_FILES['pic']['tmp_name'];
    $error = $_FILES['pic']['error'];
    if($error === 0){
      if($img_size > 125000){
        $em= "Sorry, your file is too large.";
        // header("Location: register.php?error=$em");
      }
      else{
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc= strtolower($img_ex);

        $allowed_exes = array("jpg","jpeg","png");

        if(in_array($img_ex_lc,$allowed_exes)){
          $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
          $img_upload_path ="assets/".$new_img_name;
          move_uploaded_file($tmp_name,$img_upload_path);
          $cd = date('y/m/d');
          $nam = $_POST['name'];
          $e = $_POST['email'];
          $p = $_POST['phone'];
          $d = $_POST['dob'];
          $ad1 = $_POST['address'];
          $co = $_POST['country'];
          $s = $_POST['state'];
          $c = $_POST['city'];
          $zip = $_POST['pin'];
          $pass =$_POST['pass'];
          $query = "INSERT INTO `usertable`(`id`, `name`, `email`, `dob`, `phone`, `address`, `city`, `country`, `state`,`pin`, `password`, `image`) VALUES (NULL,'".$nam."','".$e."','".$d."','".$p."','".$ad1."','".$c."','".$co."','".$s."','".$zip."','".$pass."','".$new_img_name."')";
          $query_run = mysqli_query($conn, $query);
          if ($query_run) {
            header("Location: login.php");
          } else {
            echo "fail";
          }
        } else{
            $em="You can't upload this type of file";
            // header("Location: register.php?error=$em");
        }
      }
    }else{
     $em="Unknown Error";
    //  header("Location: register.php?error=$em"); 
    }
  }

  $statement = "SELECT `id`, `country_name` FROM `country`";
  $dt = mysqli_query($conn, $statement);

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
        /* Style all input fields */
        input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        }

        /* Style the submit button */
        input[type=submit] {
        background-color: #04AA6D;
        color: white;
        }

        /* Style the container for inputs */
        .container {
        background-color: #f1f1f1;
        padding: 20px;
        }

        /* The message box is shown when the user clicks on the password field */
        #message {
        display:none;
        background: #f1f1f1;
        color: #000;
        position: relative;
        padding: 20px;
        margin-top: 10px;
        }

        #message p {
        padding: 10px 35px;
        font-size: 18px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
        color: green;
        }

        .valid:before {
        position: relative;
        left: -35px;
        content: "&#10004;";
        }

        /* Add a red text color and an "x" icon when the requirements are wrong */
        .invalid {
        color: red;
        }

        .invalid:before {
        position: relative;
        left: -35px;
        content: "&#10006;";
        }
  </style>
  <title>Register</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Register User</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <?php if(isset($_GET['error'])): ?>
      <p><?php echo $_GET['error']; ?></p>
    <?php endif ?>
    <form method="post" action="register.php" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputName">Name</label>
          <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputPhone">Phone</label>
          <input type="text" class="form-control" name="phone" id="inputPhone" placeholder="Phone" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputDOB">Date of Birth</label>
          <input type="date" class="form-control" name="dob" id="inputDOB" placeholder="DOB" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" name="address" id="inputAddress" placeholder="1234 Main St" required>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="inputCountry">Country</label>
          <select type ="text" id="country" name="country" class="form-control">
            <option selected>Select Country</option>
            <?php
            // while($result = mysqli_fetch_assoc($dt)){
            ?>
            
            <?php
            // }
            ?>
            <!-- <option value="India">India</option>
            <option value="Bangladesh">Bangladesh</option> -->
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="inputState">State</label>
          <select type ="text" id="state" name="state" class="form-control">
            <!-- <option selected>Choose...</option> -->
            <!-- <option value="Dhaka">Dhaka</option>
            <option value="West Bengal">West Bengal</option>
            <option value="Khulna">Khulna</option>
            <option value="Odissa">Odissa</option> -->
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="inputCity">City</label>
          <select type ="text" id="city" name="city" class="form-control">
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="inputZip">Zip</label>
          <input type="text" class="form-control" name="pin" id="inputZip" required onkeyup="myZipcode();">
          <p id="pin-alert">&nbsp;</p>
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" id="psw" name="pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
      </div>
      <div class="form-group">
        <label for="inputConPassword">Confirm Password</label>
        <input type="password" class="form-control" id="inputConPassword" name="confirmpass" required>
      </div>
      <div class="form-group">
        <label for="inputPicture">Profile Picture</label>
        <input type="file" class="form-control" id="inputPicture" name="pic" required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
    </form>
    <div id="message">
      <h3>Password must contain the following:</h3>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    function loadCountry(){
        jQuery.ajax({
          type:"POST",
          url:"ajax.php",
          data:"get=country"
        }).done(function(result){
          
          $(result).each(function(){
            $('#country').append($(result));
          })
        });
    }

    function loadState(countryId){
        $('#state').children().remove()
        jQuery.ajax({
          type:"POST",
          url:"ajax.php",
          data:"get=state&countryId=" + countryId
        }).done(function(result){
          
          $(result).each(function(){
            $('#state').append($(result));
          })
        });
    }

    function loadCity(stateId){
        $('#city').children().remove()
        jQuery.ajax({
          type:"POST",
          url:"ajax.php",
          data:"get=city&stateId=" + stateId
        }).done(function(result){
          
          $(result).each(function(){
            $('#city').append($(result));
          })
        });
    }
    jQuery(document).ready(function(){
      $('#country').change(function(){
        loadState($(this).find(':selected').val())
      })
      $('#state').change(function(){
        loadCity($(this).find(':selected').val())
      })
    });
    loadCountry();
  </script>
    <script type="text/javascript">
      function myZipcode() {
        var str = document.getElementById("inputZip").value;
        var zipcodeAlert = document.getElementById("pin-alert");
        if (!(/^[0-9]{6}$/.test(str))) {
          zipcodeAlert.style.display = "block";
          zipcodeAlert.innerHTML = "PIN code must be only 6 digits.";
          zipcodeFlag = false;
        } else {
          zipcodeAlert.style.display = "none";
          zipcodeFlag = true;
        }
      }
      
    </script>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script>
        var myInput = document.getElementById("psw");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
  </script>
  <!--  -->
  <script type="text/javascript">
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>


