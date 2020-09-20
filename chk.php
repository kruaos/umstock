<?php 
$servername = "localhost";
$username ="root";
$password ="";
$dbname ="umcity_umstock";	

$conn = new mysqli($servername, $username, $password, $dbname);
echo "<form action='chk.php'><input type='text'name='id'></form>";

if(empty($id)){
    echo "show";
}else{
    echo "not show";
}
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfullys";

$ID=$_GET['id'];

$sql1="SELECT * from tb_order where orderIdReport=$ID";
$result = $conn->query($sql1);
// echo "<br>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "<pre>";
        print_r($row);
        // echo "</pre>";
        $orderNum= $row['orderNum'];
        $orderID= $row['orderID'];
    }
} else {
    echo "0 results";
}

echo "<hr>";

$sql2="SELECT * from tb_orderdetail where orderID=$orderNum";
$result2 = $conn->query($sql2);
// echo "<br>";

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
        // echo "<pre>";
        print_r($row2);
        // echo "</pre>";
        // $orderID= $row['orderID'];
        echo "<br>";
    }
} else {
    echo "0 results";
}
echo "<hr>";
$sql3="SELECT * from tb_orderfile where orderID=$orderID";
$result3 = $conn->query($sql3);
// echo "<br>";

if ($result3->num_rows > 0) {
    // output data of each row
    while($row3 = $result3->fetch_assoc()) {
        // echo "<pre>";
        print_r($row3);
        // echo "</pre>";
        // $orderID= $row['orderID'];
        echo "<br>";
    }
} else {
    echo "0 results";
}
?> 