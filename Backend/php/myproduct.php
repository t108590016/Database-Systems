<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'getmyproduct') {
        $userno = $_POST['userno'];
        // =====get all products's Name、Price、Description、Sales_volume、Inventory、ImageURL、Available、ID=====
        $result = $conn->query("SELECT book.ISBN, Category, `Description`, ImageURL, `Name`, price, sellerID FROM book JOIN sell ON book.ISBN = sell.ISBN WHERE sellerID='$userno'");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("data" => $row));
            $conn->close();
        }
    }
    if ($req == 'getsellingbook') {
        $ISBN = $_POST['ISBN'];
        // =====get all products's Name、Price、Description、Sales_volume、Inventory、ImageURL、Available、ID=====
        //$result = $conn->query("SELECT book.ISBN, ImageURL, `Name`, price, sellerID FROM book JOIN sell ON book.ISBN = sell.ISBN WHERE sell.ISBN='$ISBN'");
        $result = $conn->query("SELECT book.ISBN, book.ImageURL, `Name`, price, sellerID FROM sell join book on sell.ISBN = book.ISBN WHERE sell.ISBN = '$ISBN' and not EXISTS ( select * from Orders, purchaseitem, book where purchaseitem.OrderID = Orders.ID and purchaseitem.ISBN = '$ISBN' and book.ISBN = '$ISBN')");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("data" => $row));
            $conn->close();
        }
    }
    if ($req == 'offproduct') {
        $userID = $_POST['userID'];
        $productISBN = $_POST['productISBN'];
        // ==========close product by product id (hint: update available to True or False) =======================
        //$conn->query("UPDATE products SET Available=0");
        $conn->query("DELETE FROM sell WHERE sellerID='$userID' AND ISBN='$productISBN'");
        // =======================================================================================================
    }
}
