<?php
//permet de voir les erreur de mysql
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Employe.php';
include 'Message.php';

$emp1 = new Employe();
$emp1->getById(1);
var_dump($emp1);


$mess1 = new Message();
$mess1->setText("Bonjour à tout le monde");
$mess1->setTitle("Coucou");
$mess1->setAuthor('1');
$mess1->save();


$mess2 = new Message();
$mess2->setText("J'ai pas tout compris");
$mess2->setTitle("chais pas");
$mess2->setAuthor('3');
$mess2->save();