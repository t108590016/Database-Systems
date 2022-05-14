<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'checkOrderRecord') {
        $userno = $_POST['userno'];
        // ====================get all orders by buy buyer id=====================================================
        $orders = $conn->query("SELECT Orders.ID, Orders.Date, Orders.Price, Orders.Finished, Orders.SellerID FROM member JOIN Orders ON member.USER_ID=Orders.buyerID WHERE member.USER_ID='$userno'");
        // =======================================================================================================
        if ($orders->num_rows > 0) {
            while (($row_result = $orders->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("userID" => $userno, "data" => $row));
            $conn->close();
        }
    }
    if ($req == 'getOrderlist') {
        $orderId = $_POST['orderno'];
        // =======================================================================================================
        //$result = $conn->query("SELECT Products.Id, `Name`, Price, `Description`, ImageURL, order_list.Amount FROM order_list, Products WHERE order_list.OrderID='$orderId' AND order_list.ProductID=Products.id");
        $result = $conn->query("SELECT book.ISBN, book.name, sell.price, book.description, book.ImageURL FROM orders JOIN purchaseitem ON purchaseitem.OrderID = orders.ID JOIN sell ON sell.SellerID = orders.SellerID AND sell.ISBN = purchaseitem.ISBN JOIN book ON book.ISBN = sell.ISBN WHERE orders.ID = '$orderId'");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("orderID" => $orderId, "data" => $row));
            $conn->close();
        }
    }
}
