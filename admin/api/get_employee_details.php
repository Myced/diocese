<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$output = [];
$count = 1;

function get_function($id)
{
    global $dbc;

    $query = "SELECT `function` FROM `functions` WHERE `id` = '$id' ";
    $result = mysqli_query($dbc, $query)
        or die("Error");

    list($function)  = mysqli_fetch_array($result);

    return $function;
}

$name = filter($_POST['name']);

$query = "SELECT * FROM `employees`
                    WHERE `fname` = '$name' LIMIT 1 ";
$result = mysqli_query($dbc, $query)
    or die("Error");

while($row = mysqli_fetch_array($result))
{
    array_push($output, $row['matricule']);
    array_push($output, get_function($row['position']));
}

echo json_encode($output);




?>
