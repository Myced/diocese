<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$output = '';
$count = 1;

$matricule = filter($_POST['matricule']);

$query = "SELECT * FROM `work_experience` WHERE `matricule` = '$matricule' ";
$result = mysqli_query($dbc, $query)
    or die("Error");

$output .= '<table class="table table-bordered " >';
$output .= "<tr>";
$output .= '<th> S/N </th>';
$output .= '<th> Institution </th>';
$output .= '<th> Function </th>';
$output .= '<th> Year Started </th>';
$output .= '<th> Year Ended </th>';
$output .= '<th> Action </th>';
$output .= '<tr>';

while($row = mysqli_fetch_array($result))
{
    $output .= '<tr>';
    $output .= '<td> ' . $count++ . '</td>';
    $output .= '<td> ' . $row['institution'] . '</td>';
    $output .= '<td> ' . $row['function'] . '</td>';
    $output .= '<td> ' . $row['year_start'] . '</td>';
    $output .= '<td> ' . $row['year_end'] . '</td>';
    $output .= '<td> ';
    $output .= '<a href="#"  data-id1="' . $row['id'] .  '"
                class="btn btn-danger btn-xs delete">
                <i class="fa fa-trash"></i>
                Del
                </a>
                 ';
    $output .= '</td>';
    $output .= '<tr>';
}

$output .= '</table>';

echo $output;




?>
