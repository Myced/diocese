<?php
include_once '../../classes/class.dbc.php';
include_once '../../classes/functions.php';

$db  = new dbc();
$dbc  = $db->get_instance();

$output = '';
$count = 1;

$matricule = filter($_POST['matricule']);

$query = "SELECT * FROM `schools_attended` WHERE `matricule` = '$matricule' ";
$result = mysqli_query($dbc, $query)
    or die("Error");

$output .= '<table class="table table-bordered table-striped" >';
$output .= "<tr>";
$output .= '<th> S/N </th>';
$output .= '<th> School </th>';
$output .= '<th> Certificate </th>';
$output .= '<th> Year </th>';
$output .= '<th> Action </th>';
$output .= '<tr>';

while($row = mysqli_fetch_array($result))
{
    $output .= '<tr>';
    $output .= '<td> ' . $count++ . '</td>';
    $output .= '<td> ' . $row['school'] . '</td>';
    $output .= '<td> ' . $row['certificate'] . '</td>';
    $output .= '<td> ' . $row['year'] . '</td>';
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
