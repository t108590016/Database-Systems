<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'getorderno') {
        $userId = $_POST['userId'];
        // =====================select Orders.Finished, order_list.OrderID and the result will be group by order_list.OrderID===
        $result = $conn->query("SELECT Orders.Finished, purchaseitem.OrderID FROM Orders JOIN purchaseitem ON Orders.ID = purchaseitem.OrderID WHERE Orders.SellerID='$userId' GROUP BY purchaseitem.OrderID");
        // =====================================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("userId" => $userId, "data" => $row));
            $conn->close();
        }
    }
    if ($req == 'processfinishorder') {
        $orderId = $_POST['orderno'];
        // ===================get Orders by order id==============================================================
        $result = $conn->query("SELECT * FROM Orders WHERE ID='$orderId'");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("data" => $row));
            $conn->close();
        }
    }
    if ($req == 'processorder') {
        $orderno = $_POST['orderno'];
        // =======================================================================================================
        //$result = $conn->query("SELECT Orders.Date as `Date`, Orders.Price as Order_Price, purchaseitem.ISBN, book.Name, book.Description, book.ImageURL, book.Price FROM Orders, purchaseitem, book WHERE purchaseitem.OrderID='$orderno' AND Orders.ID=purchaseitem.OrderID AND purchaseitem.ISBN=book.ISBN GROUP by purchaseitem.ISBN");
        $result = $conn->query("SELECT Orders.ID, Orders.Date as `Date`, Orders.Price as Order_Price, Orders.BuyerID FROM Orders WHERE Orders.ID='$orderno'");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("data" => $row));
            $conn->close();
        }
    }
    if ($req == 'updateorder') {
        $orderId = $_POST['orderno'];
        // ===========update Orders's Finished to True by order id================================================
        $conn->query("UPDATE Orders Set Finished=1 WHERE ID='$orderId'");
        // =======================================================================================================
    }

}
