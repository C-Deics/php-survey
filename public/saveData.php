
<?php

function save_data(){

$servername = getenv('servername');
$username = getenv('username');
$password = getenv('password');
$dbname = getenv('dbname');

$db_conn = new mysqli($servername,'$username','$password','$dbname');

if ($db_conn->connect_errno){
printf ("Could not connect to database server".$db_host."\n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
}
    $part_fullname = $db_conn->real_escape_string($_SESSION['fullName']);
    $part_age = $db_conn->real_escape_string($_SESSION['age']);
    $part_student = $db_conn->real_escape_string($_SESSION['studentType']);


// inserting into respective places from database and tables 
$qry = "INSERT INTO participants (part_fullname,part_age,part_student) VALUES ('".$part_fullname."','".$part_age."','".$part_student."');";
$db_conn->query($qry);

$part_ID = mysqli_insert_id($db_conn);
$howPurchased = $_SESSION['howPurchased'];
foreach($_SESSION['purchases'] as $purchase){



    $satisfaction = $purchase['satisfaction'];
    $recommend = $purchase['recommend'];
    $name = $purchase['name'];

        $qry ="INSERT INTO responses (resp_part_id,resp_product,resp_how_purchased,resp_satisfied,resp_recommend)
        VALUES ('".$part_ID."','".$name."','".$howPurchased."','".$satisfaction."','".$recommend."');";
        $db_conn->query($qry);
}






    $db_conn->close();



}
?>



















