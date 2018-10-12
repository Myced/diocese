<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$output = [];
$count = 1;

$key = filter($_POST['key']);

$query = "SELECT * FROM `employees`
                    WHERE `fname` LIKE '%$key%' LIMIT 15 ";
$result = mysqli_query($dbc, $query)
    or die("Error");

while($row = mysqli_fetch_array($result))
{
    array_push($output, $row['fname']);
}

echo json_encode($output);




?>
