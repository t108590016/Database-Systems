<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == "purchaseshoppingcart") {
        $userno = $_POST['userno'];
        $total = $_POST['total'];
        $row = json_decode($_POST['productIDs'], true); // 購物車資料由前端傳入
        date_default_timezone_set('Asia/Taipei');
        $date = daytime();
        $seller_array = array();
        $query_result = array();
        //$price_array = array();
        //$insert_value = "";
        for ($i = 0; $i < count($row); $i++) {
            if (!in_array($row[$i]['sellerID'], $seller_array))
                array_push($seller_array, $row[$i]['sellerID']);
        }
        for ($i = 0; $i < count($seller_array); $i++) {
            $price = 0;
            for ($j = 0; $j < count($row); $j++){
                if ($row[$j]['sellerID'] == $seller_array[$i]){
                    $price += ((int)$row[$j]['price'] * (int)$row[$j]['quantity']);
                }
            }
            $sellerID = $seller_array[$i];
            //array_push($price_array, $price);
            array_push($query_result, $conn->query("INSERT INTO Orders (BuyerID, `Date`, Price, SellerID) VALUES ('$userno', '$date', '$price', '$sellerID')"));
            // 找出 Orders 中最大的 ID ===========
            $orderno = $conn->insert_id;
            for ($j = 0; $j < count($row); $j++) {
                $productID = $row[$j]['ISBN'];// 購物車資料由前端傳入quantity
                // ======================insert a new record into order_list (hint: use $orderno、$productID、$quantity)=================================================================================
                if ($row[$j]['sellerID'] === $seller_array[$i])
                    $rowitem = $conn->query("INSERT INTO purchaseItem (OrderID, ISBN) VALUES ('$orderno', '$productID')");
                    //$conn->query("DELETE FROM sell WHERE sellerID='$sellerID' AND ISBN='$productID'");
                // =======================================================================================================
            }
        }
        echo json_encode(array("result" => $query_result, "row" => $row));
        $conn->close();
    }
}
//格式化時間為年月日時分秒
function daytime($time = '') {
    global $webdb;
    if (!$time) {
        $time = time();
    }
    return date("Y/m/d H:i:s",$time+$webdb['correctiontime']);
}