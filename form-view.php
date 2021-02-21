<?php

// form handler
function validateFeedbackForm($arr)
{
    extract($arr);

    if(!isset( $email, $street, $streetnumber, $city, $zipcode)) return;


    if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
        return "Please enter a valid Email address";
    }
    if(!$street) {
        return "Please enter your Street";
    }
    if(!is_numeric($streetnumber)) {
        return "Fill only numbers in your street number";
    }
    //if(!$subject) {
    //  $subject = "Contact from website";}
    if(!$city) {
        return "Please enter your City";
    }

    if(!is_numeric($zipcode)) {
        return "We need only Numbers as zip code";
    }


    $aProduct = $_POST['products'];
    if(empty($aProduct)) // better use isset
    {
        return("You didn't select any product.");
    }
    else
    {
        $N = count($products);

        echo("You selected $N product(s): ");
        for($i=0; $i < $N; $i++)  // here you have to use AS but for foreach
        {
            //echo($aProduct[$i] . " "); //use key because products are array
        }
    }

//    if(!$message) {
//        return "Please enter your comment in the Message box";
//    }

    // send email and redirect
//    $to = "oscar@pandime.com";
//    $headers = "From: form@becodelocal.com" . "\r\n";
//    mail($to, $street, $streetnumber, $city, $zipcode);
    //header("Location: http://www.example.com/thankyou.html");
//    header("Location: http://becode.local/index.php");
//    exit;
}

// execution starts here
if(isset($_POST['submit'])) {
    // call form handler
    $errorMsg = validateFeedbackForm($_POST);
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

<div class="alert alert-primary align-text-middle" role="alert" >
    <?php
//    if (isset($submit)) {
//        if (isset($errorMsg)){
//            echo $errorMsg;
//        }
//    }
    if(isset($errorMsg) && $errorMsg) {
        echo "<p class='error'>* ",htmlspecialchars($errorMsg),"</p>\n\n";
    }
    ?>
</div>

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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" accept-charset="UTF-8">

        <?PHP
        if(isset($errorMsg) && $errorMsg) {
            echo "<p class='error'>* ",htmlspecialchars($errorMsg),"</p>\n\n";
        }
        ?>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="email">E-mail:*</label>

                 <input type="email" name="email" value="<?PHP  echo isset($_SESSION['email'])?$_SESSION['email']:""; ?>" id="email"  class="form-control"/>

            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:*</label>


                    <input type="text" value="<?PHP  echo isset($_SESSION['street'])?$_SESSION['street']:""; ?>" name="street" id="street" class="form-control">



                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>


                    <input type="text" name="streetnumber" value="<?PHP echo isset($_SESSION['streetnumber'])?$_SESSION['streetnumber']:""; ?>" id="streetnumber"  class="form-control">


                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>


                     <input type="text" value="<?PHP echo isset($_SESSION['city'])?$_SESSION['city']:""; ?>" id="city" name="city" class="form-control">


                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>

                     <input type="text" value="<?PHP echo isset($_SESSION['zipcode'])?$_SESSION['zipcode']:""; ?>" id="zipcode" name="zipcode" class="form-control">


                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> - <!-- this are the keys -->
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>

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


//echo htmlspecialchars($_POST['street']);
//echo "<br>";
//echo htmlspecialchars($_POST['streetnumber']);
//echo "<br>";
//echo htmlspecialchars($_POST['city']);
//echo "<br>";
//echo htmlspecialchars($_POST['zipcode']);
//echo "<br>";
//echo ($_POST[$aProduct]);
//echo ($products['products']);
var_dump($_POST['products']);


//echo ($aProduct);
//
?>

</body>
</html>