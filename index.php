<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();
if (isset($_POST['submit']) === true){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['street'] = $_POST['street'];
    $_SESSION['streetnumber'] = $_POST['streetnumber'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['zipcode'] = $_POST['zipcode'];
}



function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
echo whatIsHappening();
//your products with their price.

if ((isset($_GET['food'])) && ($_GET['food']==0) ){

$products = [

    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
} else {
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]

];
}

vvvvvvvvvvvvvvvvv



$totalValue = 0;

$delivery_time = date("H:i:s", strtotime("+2 Hours"));
$deliveryMsg = "The delivery time is ";

if (isset($_POST["express_delivery"])){
    $totalValue += 5;
//    $deliveryMsg = "Delivery time is ";
    $delivery_time = date("H:i:s", strtotime("+45 Minutes"));

}

if (isset($_POST["products"])){
    foreach ($_POST["products"] AS $i => $price){
        $totalValue += $products[$i]["price"];
    }
}


require 'form-view.php';