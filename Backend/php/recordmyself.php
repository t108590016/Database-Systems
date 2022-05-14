<?php
include("database.php");
include("headers.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $req = $_POST['request'];
    if ($req == 'recordmyself') {
        $reciever = $_POST['reciever'];
        $sender = $_POST['sender'];
        $topic = $_POST['topic'];
        $content = $_POST['content'];
        date_default_timezone_set('Asia/Taipei');
        $date = daytime();
        if ($conn->query("INSERT INTO `message`(`Reciever`,`Sender`,`Topic`,`Content`,`Date`) VALUES ('$reciever','$sender', '$topic', '$content','$date')") === TRUE) {
        // ==========================================================================================================================================================================================
            $msg = 'success';
        } else {
            $msg = 'failed';
        }
        $conn->close();
        echo json_encode(array('msg' => $msg));
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
