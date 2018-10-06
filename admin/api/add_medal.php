<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$matricule = filter($_POST['matricule']);
$medal = filter($_POST['medal']);
$year = filter($_POST['year']);


$query = "INSERT INTO `medals`
        (`matricule`, `medal`, `date_issued`)
        VALUES ('$matricule', '$medal', '$year')
        ";
$result = mysqli_query($dbc, $query)
    or die("Error");
?>
