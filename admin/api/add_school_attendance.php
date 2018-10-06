<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$matricule = filter($_POST['matricule']);
$school = filter($_POST['school']);
$certificate = filter($_POST['certificate']);
$year = filter($_POST['year']);


$query = "INSERT INTO `schools_attended`
        (`matricule`, `school`, `certificate`, `year`)
        VALUES ('$matricule', '$school', '$certificate', '$year')
        ";
$result = mysqli_query($dbc, $query)
    or die("Error");
?>
