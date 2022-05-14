<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'getmymsn') {
        $userno = $_POST['userno'];
        // =====get all products's Name、Price、Description、Sales_volume、Inventory、ImageURL、Available、ID=====
        $result = $conn->query("SELECT * FROM `message` WHERE Sender='$userno' ORDER BY `Date` DESC");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("data" => $row));
            $conn->close();
        }
    }
    if ($req == 'getmsn') {
        $userno = $_POST['userno'];
        // =====get all products's Name、Price、Description、Sales_volume、Inventory、ImageURL、Available、ID=====
        $result = $conn->query("SELECT * FROM `message` WHERE Reciever='$userno' ORDER BY `Date` DESC");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            echo json_encode(array("data" => $row));
            $conn->close();
        }
    }
}
