<?php

class Employe {

    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $pass;

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getPass() {
        return $this->pass;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    //connection a la base de donné
    public function getBdd() {
        $bdd = new PDO('mysql:host=localhost;dbname=canal0;charset=utf8', 'root', '');
        return $bdd;
    }

    //CETTE FONCTION ME RENVOI les info de l'employé qui possede cette id
    public function getById($id) {
        $bdd = $this->getBdd();
        $employe = $bdd->prepare('select * from Employe where id=?');
        $employe->execute(array($id));
        $employe1= $employe->fetch();
               
        $this->setId($id);
        $this->setFirstName($employe1['firstName']);
        $this->setLastName($employe1['lastName']);
        $this->setEmail($employe1['email']);
        $this->setPhone($employe1['phone']);
        $this->setPass($employe1['pass']);
    }

}
