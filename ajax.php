<?php
    include('config.php');
    $countryId = isset($_POST['countryId']) ? $_POST['countryId'] : 0;
    $stateId = isset($_POST['stateId']) ? $_POST['stateId'] : 0;
    $command= isset($_POST['get']) ? $_POST['get'] : "";
    switch($command){
        case "country":
            $statement = "SELECT `id`, `country_name` FROM `country`";
            $dt = mysqli_query($conn, $statement);
            while($result = mysqli_fetch_assoc($dt)){
                $result1 = "<option value=". $result['id'] . ">" . $result['country_name'] . "</option>";
                echo $result1;
            }
            
            break;
        case "state":
            $result1 = "<option>Select State</option>";
            $statement = "SELECT `id`, `states_name` FROM `states` WHERE `country_id` =" . $countryId;
            $dt = mysqli_query($conn, $statement);
            while($result = mysqli_fetch_assoc($dt)){
                echo $result1 = "<option value=". $result['id'] . ">" . $result['states_name'] . "</option>";
            }
            break;
        
        case "city":
            $result1 = "<option>Select City</option>";
            $statement = "SELECT `id`, `city_name` FROM `cities` WHERE `state_id` =" . $stateId;
            $dt = mysqli_query($conn, $statement);
            while($result = mysqli_fetch_array($dt)){
                echo $result1 = "<option value=". $result['id'] . ">" . $result['city_name'] . "</option>";
            }

            break;
    }
?>