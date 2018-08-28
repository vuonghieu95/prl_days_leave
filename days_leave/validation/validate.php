<?php

class Validate
{
    protected $_errorMessages = [];

    /**
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->_errorMessages;
    }

    /**
     * @param $field
     * @param $errorMessages
     */
    public function setErrorMessages($field, $errorMessages)
    {
        $this->_errorMessages[$field] = $errorMessages;
    }

    public function validateName($name)
    {
        if (empty($name)) {
            $this->setErrorMessages('name', "Name is required");
            return false;
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $this->setErrorMessages('name', "Only letters and white space allowed");
            return false;
        }
        return true;
    }

    public function validatePhone($phone)
    {
        if (empty($phone)) {
            $this->setErrorMessages('phone', 'Phone is required');
            return false;
        }
        if (!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{9})$/', $phone)) {
        $this->setErrorMessages('phone','Please enter a valid phone number');
        return false;
    }
        return true;
    }

    public function validateEmail($email)
    {
        if (empty($email)) {
            $this->setErrorMessages('email', 'Email is required');
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->setErrorMessages('email',"Invalid email format");
            return false;
        }
    }

}
