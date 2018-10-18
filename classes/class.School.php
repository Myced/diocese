<?php
/**
 *
 */
class School
{
    public $school_id;
    public $school_name;
    public $tel;
    public $email;
    public $address;
    public $website;
    public $abbreviation;
    public $logo;
    public $pure_logo;
    private $dbc;

    function __construct($school_id)
    {
        $db = new dbc();
        $dbc = $db->get_instance();

        $this->dbc = $dbc;
        $this->school_id = $school_id;

        //get the school Details
        $query = "SELECT * FROM `schools` WHERE `id` = '$school_id'";
        $result = mysqli_query($dbc, $query)
            or die("Could not get the school detials");

        while($row = mysqli_fetch_array($result))
        {
            $this->school_name = $row['name'];
            $this->address = $row['address'];
            $this->abbreviation = $row['abbreviation'];
            $this->tel = $row['tel'];
            $this->email = $row['email'];
            $this->website = $row['website'];
            $this->pure_logo = $row['logo'];
            $logos = $row['logo'];

            if(!empty($logos))
            {
                $logo = '../' . $logos;
                if(file_exists($logo))
                {

                }
                else {
                    $logo = '../' . Constants::DEFAULT_SCHOOL_LOGO;
                }

            }
            else {
                $logo = '../' . Constants::DEFAULT_SCHOOL_LOGO;
            }
            //set the logo
            $this->logo = $logo;

        }
    }

    function update()
    {
        $query = "UPDATE `schools` SET
            `name` = '$this->school_name', `abbreviation` = '$this->abbreviation',
            `address` = '$this->address', `tel` = '$this->tel',
            `email` = '$this->email', `website` = '$this->website', `logo` = '$this->pure_logo'
            WHERE
            `id` = '$this->school_id'
        ";

        $this->dbc->query($query);
    }
}

 ?>
