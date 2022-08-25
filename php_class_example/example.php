<?php
class People {
    public $lastName;
    public $firstName;
    public $gender;

    public function __construct($firstName, $lastName, $gender){
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->gender = $gender;

    }
}
$tom = new People('Peace', 'Ariyo', 'Female');
echo $tom->firstName;
echo "<br>";
echo $tom->lastName.'<br>';
echo $tom->gender;