<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'publish') {
        $ISBN = $_POST['ISBN'];
        $price = $_POST['price'];
        $userID = $_POST['userId'];
        // ===============insert a new date into Products 
        // (hint: use $price、'0'、$inventory、'$category'、'$name'、'$description'、'$link'、TRUE)===================================================
        if ($conn->query("INSERT INTO sell (`ISBN`, `price`, `sellerID`) VALUES ('$ISBN', '$price', '$userID')") === TRUE) {
        // ==========================================================================================================================================================================================
            $msg = 'success';
        } else {
            $msg = 'failed';
        }
        $conn->close();
        echo json_encode(array('msg' => $msg, 'ISBN' => $ISBN, 'price' => $price, 'userID' => $userID));
    }
    if ($req == 'publishBook') {
        $ISBN = $_POST['ISBN'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $imageLink = $_POST['imageLink'];
        // ===============insert a new date into Products 
        // (hint: use $price、'0'、$inventory、'$category'、'$name'、'$description'、'$link'、TRUE)===================================================
        if ($conn->query("INSERT INTO book (`ISBN`, `name`, `category`, `description`, `ImageURL`) VALUES ('$ISBN', '$name', '$category', '$description', '$imageLink')") === TRUE) {
        // ==========================================================================================================================================================================================
            $msg = 'success';
        } else {
            $msg = 'failed';
        }
        $conn->close();
        echo json_encode(array('msg' => $msg, 'ISBN' => $ISBN, 'name' => $name, 'category' => $category, 'description' => $description, 'imageLink' => $imageLink));
    }
}
