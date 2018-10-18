<?php
/**
 *
 */
class UserLevel
{

    const PERSONNEL_ADMINISTRATOR = 1;
    const SCHOOL_ACCOUNTANT = 2;
    const SCHOOL_PRINCIPAL = 3;
    const FINANCE_CONTROLLER = 4;
    const BISHOP = 10;

    public static function getUserLevel($level)
    {
        $output = '';
        if($level == SELF::PERSONNEL_ADMINISTRATOR)
        {
            $output = "Personnel Administrator";
        }
        elseif($level == SELF::SCHOOL_ACCOUNTANT)
        {
            $output = "School Accountant";
        }
        elseif($level == SELF::SCHOOL_PRINCIPAL)
        {
            $output = "School Principal";
        }
        elseif ($level == SELF::FINANCE_CONTROLLER)
        {
            $output = 'Finance Controller';
        }
        elseif($level == SELF::BISHOP)
        {
            $output = "Bishop";
        }
        else {
            $output = "Unknown Level";
        }

        return $output;
    }
}

 ?>
