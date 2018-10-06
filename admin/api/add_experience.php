<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$matricule = filter($_POST['matricule']);
$institution = filter($_POST['institution']);
$function = filter($_POST['function']);
$yearStart = filter($_POST['yearStart']);
$yearEnd = filter($_POST['yearEnd']);


$query = "INSERT INTO `work_experience`
        (`matricule`, `institution`, `function`, `year_start`, `year_end`)
        VALUES ('$matricule', '$institution', '$function', '$yearStart', '$yearEnd')
        ";
$result = mysqli_query($dbc, $query)
    or die("Error");
?>
