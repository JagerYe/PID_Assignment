<?php
class Member
{
    private $_userID;
    private $_userPassword;
    private $_userName;
    private $_userEmail;
    private $_userPhone;

    public function Member($userID="",$userPassword="",$userName="",$userEmail="",$userPhone=""){
        $this->_userID=$userID;
        $this->_userPassword=$userPassword;
        $this->_userName=$userName;
        $this->_userEmail=$userEmail;
        $this->_userPhone=$userPhone;
    }

    public function getUserID()
    {
        return $this->_userID;
    }
    public function setUserID($userID)
    {
        if ($userID == null || $userID == "") {
            return false;
        }
        $this->_userID = $userID;
        return true;
    }

    public function getUserPassword()
    {
        return $this->_userPassword;
    }
    public function setUserPassword($userPassword)
    {
        if ($userPassword == null || $userPassword == "") {
            return false;
        }
        $this->_userPassword = $userPassword;
        return true;
    }

    public function getUserName()
    {
        return $this->_userName;
    }
    public function setUserName($userName)
    {
        if ($userName == null || $userName == "") {
            return false;
        }
        $this->_userName = $userName;
        return true;
    }

    public function getUserEmail()
    {
        return $this->_userEmail;
    }
    public function setUserEmail($userEmail)
    {
        if ($userEmail == null || $userEmail == "") {
            return false;
        }
        $this->_userEmail = $userEmail;
        return true;
    }

    public function getUserPhone()
    {
        return $this->_userPhone;
    }
    public function setUserPhone($userPhone)
    {
        if ($userPhone == null || $userPhone == "") {
            return false;
        }
        $this->_userPhone = $userPhone;
        return true;
    }
}
