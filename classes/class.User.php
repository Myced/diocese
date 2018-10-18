<?php
/**
 *
 */
class User
{

    private $dbc;
    private $user_id;

    public $name;
    public $position;
    public $tel;
    public $email;

    public $username;

    public $avatar;
    public $photo;

    public $school;
    public $level;
    public $levelName;

    function __construct($user_id)
    {
        $this->user_id = $user_id;

        $db = new dbc();
        $dbc = $db->get_instance();

        $this->dbc = $dbc;

        $this->init();
    }

    private function init()
    {
        $query  = "SELECT * FROM `users` WHERE `user_id` = '$this->user_id' ";
        $result = $this->dbc->query($query);

        while($row = $result->fetch_object())
        {
            $this->name = $row->full_name;
            $this->position = $row->position;
            $this->email = $row->email;
            $this->tel  = $row->tel;

            $this->username = $row->username;
            $this->level = $row->level;
            $this->levelName = UserLevel::getUserLevel($row->level);
            $this->school = $row->school;

            $this->setAvatar($row->avatar);
        }
    }

    private function setAvatar($avatar)
    {
        if(!empty($avatar))
        {
            if(file_exists('../' . $avatar))
            {
                $this->avatar = '../' .  $avatar;
                $this->photo = $avatar;
            }
            else {
                $this->avatar = '../' . Constants::DEFAULT_AVATAR;
                $this->photo = Constants::DEFAULT_AVATAR;
            }
        }
        else {
            $this->avatar = '../' . Constants::DEFAULT_AVATAR;
            $this->photo = Constants::DEFAULT_AVATAR;
        }
    }
}

 ?>
