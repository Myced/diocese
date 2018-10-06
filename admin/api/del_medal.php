<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$id = $_POST['id'];

$query = "DELETE FROM `medals` WHERE `id` = '$id' ";
$result = mysqli_query($dbc, $query)
    or die("Error");

?>
