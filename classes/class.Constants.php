<?php
/**
 *
 */
class Constants
{
    const ROOT = '/diocese/';
    const DEFAULT_SCHOOL_LOGO = self::ROOT . 'assets/images/school.png';
    const SCHOOL_LOGO_PATH = 'uploads/schools/logos/';
    const DEFAULT_AVATAR = 'assets/images/avatar.png';

    public function getAcademicYear($dbc)
    {
        $query = "SELECT `year` FROM `academic_year` WHERE `id` = '1' ";
        $result = mysqli_query($dbc, $query)
            or die("Error");

        list($year) = mysqli_fetch_array($result);

        return $year;
    }

    public function setAcademicYear($dbc, $year)
    {
        $query = "UPDATE `academic_year` SET `year` = '$year'
            WHERE `id` = '1' ";
        $result = mysqli_query($dbc, $query)
            or die("Error");
    }
}

 ?>
