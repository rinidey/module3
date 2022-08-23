<?php
// $image = addslashesdd
require_once "config.php";
$sid = $_GET["id"];
$sql = "SELECT * FROM usertable WHERE id='" . $sid . "'";
$sql_run = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
    <?php
            if (isset($_POST['update'])){
                echo "suc";
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
                $img = $_POST['pic'];
                $query = "UPDATE `usertable` SET `name`='" . $nam . "',`email`='" . $e . "',`dob`='" . $d . "',`phone`='" . $p . "',`address`='" . $ad1 . "',`city`='" . $c . "',`country`='" . $co . "',`state`='" . $s . "',`pin`='" . $zip . "',`image`='" . $img . "' WHERE `id`='" . $sid . "'";
                $query_run = mysqli_query($conn, $query);
                echo $query;
                if ($query_run) {
                    header("Location: welcome.php"); 
                    echo "s";
                } else {
                    echo "fail";
                }
            }
    ?>
        <form method="POST">
            <?php
            while ($row = mysqli_fetch_assoc($sql_run)) {
            ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" name="name" id="inputName" value="<?php echo ($row["name"]); ?>" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo ($row["email"]); ?>" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="inputPhone" value="<?php echo ($row["phone"]); ?>" placeholder="Phone" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDOB">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="inputDOB" value="<?php echo ($row["dob"]); ?>" placeholder="DOB" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" name="address" id="inputAddress" value="<?php echo ($row["address"]); ?>" placeholder="1234 Main St" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputCountry">Country</label>
                        <select id="inputCountry" name="country" class="form-control">
                            <option selected value="<?php echo ($row["country"]); ?>"><?php echo ($row["country"]); ?></option>
                            <option value="India">India</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputState">State</label>
                        <select id="inputState" name="state" class="form-control">
                            <option selected value="<?php echo ($row["state"]); ?>"><?php echo ($row["state"]); ?></option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Odissa">Odissa</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCity">City</label>
                        <select id="inputCity" name="city" class="form-control">
                            <option selected value="<?php echo ($row["city"]); ?>"><?php echo ($row["city"]); ?></option>
                            <option value="Kolkata">Kolkata</option>
                            <option value="Burdwan">Burdwan</option>
                            <option value="Siliguri">Siliguri</option>
                            <option value="Puri">Puri</option>
                            <option value="Bhubaneswar">Bhubaneswar</option>
                            <option value="Cuttak">Cuttak</option>
                            <option value="Patna">Patna</option>
                            <option value="Muzaffarpur">Muzaffarpur</option>
                            <option value="Gaya">Gaya</option>
                            <option value="Kotwali">Kotwali</option>
                            <option value="Khalishpur">Khalishpur</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Sylhet">Sylhet</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" name="pin" id="inputZip" value="<?php echo ($row["pin"]); ?>" required onkeyup="myZipcode();">
                        <p id="pin-alert">&nbsp;</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPicture">Profile Picture</label>
                    <input type="file" class="form-control" id="inputPicture" value="<?php echo ($row["image"]); ?>" name="pic" required>
                </div>
            <?php
            }
            ?>
            <input type="submit" value="Edit" name="update" class="btn btn-primary">
        </form>
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
            var date = new Date();
            var tdate = date.getDate();
            var month = date.getMonth() + 1;
            if (tdate < 10) {
                tdate = '0' + tdate;
            }
            if (month < 10) {
                month = '0' + month;
            }
            var year = date.getUTCFullYear();
            var maxDate = year + "-" + month + "-" + tdate;
            document.getElementById("datepick").setAttribute('max', maxDate);
        </script>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>

