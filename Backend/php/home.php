<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'getproductdata') {
        $category = $_POST['category'];
        if ($category == "all") {
            // =============================select all product and it is available ===================================
            //$result = $conn->query("SELECT ISBN, Category, `Description`, ImageURL, `Name` FROM book");
            $result = $conn->query("SELECT book.ISBN, Category, `Description`, ImageURL, `Name`, price, sellerID FROM book JOIN sell ON book.ISBN = sell.ISBN"); //SELECT * FROM sell JOIN book ON sell.Book = book.ISBN
            // =======================================================================================================
        } else {
            // =============================select products by category and it is available========================
            $result = $conn->query("SELECT ISBN, Category, `Description`, ImageURL, `Name` FROM book WHERE book.category = '$category'");
            // =======================================================================================================
        }
        if ($result->num_rows > 0) {
            $msg = 'success';
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
        }
        $conn->close();
        echo json_encode(array('msg' => $msg, 'data' => $row));
    }
    if ($req == 'getbookdata') {
        $category = $_POST['category'];
        if ($category == "all") {
            // =============================select all product and it is available ===================================
            $result = $conn->query("SELECT ISBN, Category, `Description`, ImageURL, `Name` FROM book");
            //$result = $conn->query("SELECT book.ISBN, Category, `Description`, ImageURL, `Name`, price, sellerID FROM book JOIN sell ON book.ISBN = sell.ISBN"); //SELECT * FROM sell JOIN book ON sell.Book = book.ISBN
            // =======================================================================================================
        } else {
            // =============================select products by category and it is available========================
            $result = $conn->query("SELECT ISBN, Category, `Description`, ImageURL, `Name` FROM book WHERE book.category = '$category'");
            // =======================================================================================================
        }
        if ($result->num_rows > 0) {
            $msg = 'success';
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result;
            }
        }
        $conn->close();
        echo json_encode(array('msg' => $msg, 'data' => $row));
    }
}
else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $req = $_GET['request'];
    if ($req == 'getproductcategories') {
        // =================================get categories (hint: group by products.Category)=====================
        $result = $conn->query("SELECT book.Category FROM book GROUP BY book.Category");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            $msg = 'success';
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result['Category'];
            }
        }
        echo json_encode(array('msg' => 'success', 'categories' => $row));
    }
    if ($req == 'getbookISBN') {
        // =================================get categories (hint: group by products.Category)=====================
        $result = $conn->query("SELECT book.ISBN FROM book GROUP BY book.ISBN");
        // =======================================================================================================
        if ($result->num_rows > 0) {
            $msg = 'success';
            while (($row_result = $result->fetch_assoc()) !== null) {
                $row[] = $row_result['ISBN'];
            }
        }
        echo json_encode(array('msg' => 'success', 'ISBN' => $row));
    }
}
