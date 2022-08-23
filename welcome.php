<?php
    session_start();
    require_once "config.php";
    $query = "SELECT * FROM usertable";
    $query_run= mysqli_query($conn,$query);
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Home</title>
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
            <?php
            if (!(isset($_SESSION['IS_LOGIN']))) {
                echo "success";
            ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button class="btn btn-sm align-middle btn-outline-secondary" type="button" onclick="location.href='login.php'">Login</button>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <button class="btn btn-sm align-middle btn-outline-secondary" type="button" onclick="location.href='register.php'">Register</button>
                    </li>
                </ul>
            <?php
            } else {
            ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Welcome, <?php echo $_SESSION['name']; ?>
                        </a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <button class="btn btn-sm align-middle btn-outline-secondary" type="button" onclick="location.href='logout.php'">Logout</button>
                    </li>
                </ul>
        </div>
        </div>
    </nav>
    <table class="table">
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <th>Address</th>
        <th>Country</th>
        <th>City</th>
        <th>State</th>
        <th>PIN</th>
        <th>Profile Picture</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row = mysqli_fetch_assoc($query_run)){
        ?>
        <tr>
        <th><?php echo($row["id"]) ?></th>
        <td><?php echo($row["name"]) ?></td>
        <td><?php echo($row["phone"]) ?></td>
        <td><?php echo($row["email"]) ?></td>
        <td><?php echo($row["dob"]) ?></td>
        <td><?php echo($row["address"]) ?></td>
        <td><?php echo($row["country"]) ?></td>
        <td><?php echo($row["city"]) ?></td>
        <td><?php echo($row["state"]) ?></td>
        <td><?php echo($row["pin"]) ?></td>
        <td><?php echo($row["image"]) ?></td>
        <td><a href='editUser.php?id=<?php echo $row["id"];?>'>Edit</a></td>
        <td><a href='deleteUser.php?id=<?php echo $row["id"];?>'>Delete</a></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
    </table>
    <?php
        }
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>