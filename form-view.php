<?php

$emailError = $streetErr = $streetnumberError = $cityError = $zipcodeError = "";
$email = $street = $streetnumber = $city = $zipcode = "";

//function validEmail(){
//    if (isset($_POST['submit'])){
//        $email = $_POST['email'];
//        $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/';
//
//        if (preg_match($regex, $email)){
//            echo "valid email";
//        } else{
//            echo "invalid email";
//        }
//    }
//}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /// email //

    if (!empty($correo)) {
        $correo = $_POST["email"];
        $emailError = "Email is required arriba";
        echo "invalido";



        } else{
        $correo = $_POST["email"];
        $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/';

        if (preg_match($regex, $correo)){
            $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/';
            $email = test_input($_POST["email"]);
            echo "valid email";
        } else {
            $emailError = "Email is required";
            echo "here is an invalid email";
        }

        }






//        $emailErr = "Email is required";
//    } else {
//        $email = test_input($_POST["email"]);
//    }

    ///// email   ////

    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
    } else {
        $street = test_input($_POST["street"]);
    }


    if (empty($calle)) {
        $calle = ($_POST["streetnumber"]);

        if (is_numeric($calle)){
            $streetnumber = test_input($_POST["streetnumber"]);
        } else{
            $streetnumberError = "Street Number must be a number";
        }

    }

    if (empty($_POST["city"])) {
        $cityError = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }


    if (empty($postal)) {
        $postal = ($_POST["zipcode"]);

        if (is_numeric($postal)){
            $zipcode = test_input($_POST["zipcode"]);
        } else{
            $zipcodeError = "Zipcode  must be a number";
        }

    }




    ////////////////
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <style>
        body{background-color: black;
        color:#F5F5F5;}
        .error {color: #FF0000;}
    </style>
    <title>Order food & drinks</title>
</head>
<body>
<!--  alert after -->



<?php if (isset($_POST['form_submitted'])): ?>

    <h2>Thank You! Order on the way</h2>
    <p>Go <a href="/index.php">back</a> to the form</p>

<?php else: ?>





<!--  alert after -->





<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>

                <span class="error">* <?php echo $emailError;?></span>

                <?php
                echo '<input type="text" value="'. $email .'" id="email" name="email" class="form-control"/>';
                ?>

            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>

                    <span class="error">* <?php echo $streetErr;?></span>
                    <?php
                        echo '<input type="text" value="'.$street.'" name="street" id="street" class="form-control">';
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>

                    <span class="error">* <?php echo $streetnumberError;?></span>
                    <?php
                    echo '<input type="text" value="'.$streetnumber.'" id="streetnumber" name="streetnumber" class="form-control">';
                    ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>

                    <span class="error">* <?php echo $cityError;?></span>
                    <?php
                    echo '<input type="text" value="'.$city.'" id="city" name="city" class="form-control">';
                    ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>

                    <span class="error">* <?php echo $zipcodeError;?></span>
                    <?php
                        echo '<input type="text" value="'.$zipcode.'" id="zipcode" name="zipcode" class="form-control">';
                    ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
        <input type="hidden" name="form_submitted" value="1" />
        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>

<?php
echo "<h2>Your Input:</h2>";

echo $email;
echo "<br>";
echo $street;
echo "<br>";
echo $streetnumber;
echo "<br>";
echo $city;
echo "<br>";
echo $zipcode;
?>
<?php endif; ?>
</body>
</html>