<?php
//permet de voir les erreur de mysql
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Employe.php';
include 'Message.php';


//affichage information message1
$mess1 = new Message();
$mess1->getById(1);
var_dump($mess1);
$emp1 = new Employe();
$emp1->getById($mess1->getAuthor());
$lastName = $emp1->getLastName();
$firstName= $emp1->getFirstName();

var_dump("L'auteur est $lastName $firstName");


//je supprime le message2
$mess2 = new Message();
$mess2->getById(2);
$mess2->delete();

$mess1->setTitle("Un nouveau titre");
$mess1->update();
// le titre a changer