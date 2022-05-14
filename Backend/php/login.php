<?php
include("database.php");
include("headers.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // =======================================================================================================
        $result = $conn->query("SELECT * FROM member WHERE `USER_ID`='$email' AND `Password`='$password'");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            $msg = 'success';
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
            $_SESSION['userno'] = $row[0]["USER_ID"];
            // =======================================================================================================
            if ($conn->query("SELECT * FROM manager WHERE `USER_ID`='$email'")->num_rows > 0) {
            // =======================================================================================================
                $_SESSION['userrole'] = "manager";
            } else {
                $_SESSION['userrole'] = "buyer";
            }
        } else {
            $msg = 'failed';
            $result = null;
        }
        $conn->close();
        echo json_encode(array('msg' => $msg, 'userrole' => $_SESSION['userrole']));
    }
    if ($req == 'checkuserrole') {
        if (isset($_SESSION['userrole'])) {
            echo json_encode(array('userrole' => $_SESSION['userrole']));
        } else {
            echo json_encode(array('userrole' => 'unknown'));
        }
    }
    if ($req == 'logout') {
        if (isset($_SESSION['userrole'])) {
            unset($_SESSION['userrole']);
            unset($_SESSION['userno']);
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'failed'));
        }
    }
    if ($req == 'getuserno') {
        if (isset($_SESSION['userno'])) {
            echo json_encode(array('userno' => $_SESSION['userno']));
        }
    }

    if ($req == 'search') {
        $value = $_POST['text'];        
        $category = $_POST['category'];        

        //$split_value=preg_split('//', $value, -1, PREG_SPLIT_NO_EMPTY);
        //$split_value=str_split($value);
        $split_value=mb_split('//', $value);
        $query_value=implode("%", $split_value);
        $query_value='%'.$query_value.'%';
        if ($category == "all") {
            $result = $conn->query("SELECT ISBN, Category, `Description`, ImageURL, `Name` FROM book WHERE `Name` LIKE '$query_value'");
        }
        else{
            $result = $conn->query("SELECT ISBN, Category, `Description`, ImageURL, `Name` FROM book WHERE `Name` LIKE '$query_value' AND Category = '$category'");
        }
            //$result = $conn->query("SELECT * FROM products WHERE `Name`='$value'");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            $msg = 'success';
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
        }
        else{
            $msg = 'fail';
            $row = '';
        }
        $conn->close();
        echo json_encode(array('split_value' => $split_value, 'msg' => $msg, 'data' => $row));
    }

    if ($req == 'create'){
        $email = $_POST['studentNum'];
        $password = $_POST['password'];
        $checkPassword = $_POST['checkPassword'];
        $name = $_POST['name'];
        $phoneNum = $_POST['phoneNum'];
        $department = $_POST['department'];
        if ($password == $checkPassword){
            $result = $conn->query("SELECT * FROM member WHERE USER_ID='$email'");
            // =======================================================================================================
            if ($result->num_rows > 0) {
                $msg = 'failed';
            } else {
                $msg = 'success' ;
                $result = $conn->query("INSERT INTO member(USER_ID, `Name`, PhoneNum, Department, `password`) 
                VALUES ('$email', '$name', '$phoneNum', '$department', '$password')");
                $result = null;
            }
        }
        else{
            $msg = 'failed';
        }
        $conn->close();
        echo json_encode(array('msg' => $msg, 'userrole' => $_SESSION['userrole']));
    }

}
