<?php

/* je crée la class message */
class Message {

    private $id;
    private $title;
    private $text;
    private $author;
    private $date;
    private $messageParent;

    public function __construct() {
        $this->date = date('Y-m-d H:i:s');// quand tu va me construire un objet  tu lui met la date et lheure du jour
    }
/* je crée mes guetters */

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getText() {
        return $this->text;
    }

    function getAuthor() {
        return $this->author;
    }

    function getDate() {
        return $this->date;
    }

    function getMessageParent() {
        return $this->messageParent;
    }
/* je crée mes setters */

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setMessageParent($messageParent) {
        $this->messageParent = $messageParent;
    }

    ////--fonction qui enregistre le message en base de donné
    public function save() {
        $bdd = $this->getBdd();

        $messageInsert = $bdd->prepare('INSERT INTO Message (title, text,author_id,date) VALUES (:title,:text,:author,:date)');


        //je rempli mes variables
        $titre = $this->getTitle();
        $text = $this->getText();
        $author = $this->getAuthor();
        $date = $this->getDate();

        $messageInsert->bindParam(':title', $titre, PDO::PARAM_STR);
        $messageInsert->bindParam(':text', $text, PDO::PARAM_STR);
        $messageInsert->bindParam(':author', $author, PDO::PARAM_INT);
        $messageInsert->bindParam(':date', $date, PDO::PARAM_STR);
        if (!$messageInsert->execute()) {
            var_dump($messageInsert->errorInfo());
        }
        ELSE {

            var_dump('Insertion du message!');
        }

        return 'ok';
    }

    public function delete() {
        $bdd = $this->getBdd();

        $messageDelete = $bdd->prepare('delete from Message where id =?');//je supprime le message 
       
        if (! $messageDelete->execute(array($this->getId()))) {
            var_dump($messageDelete->errorInfo());
        }
        ELSE {

            var_dump('Suppresion du message!');
        }

        return 'ok';
    }

    public function update() {
        $bdd = $this->getBdd();
        
         $messageUpdate = $bdd->prepare('update Message set title=? where id =?');
       
        if (!$messageUpdate->execute(array($this->getTitle(),$this->getId()))) {
            var_dump($messageUpdate->errorInfo());
        }
        ELSE {

            var_dump('modification du titre!');
        }

        return 'ok';
        
    }
//connexion a la base de donnée 
    public function getBdd() {
        $bdd = new PDO('mysql:host=localhost;dbname=canal0;charset=utf8', 'root', '');
        return $bdd;
    }
    
    //CETTE FONCTION ME RENVOI les info du message qui possede cette id
    public function getById($id) {
        $bdd = $this->getBdd();
        $message = $bdd->prepare('select * from message where id=?');
        $message->execute(array($id));
        $message= $message->fetch();
               
        $this->setId($id);
        $this->setTitle($message['title']);
        $this->setText($message['text']);
        $this->setAuthor($message['author_id']);
        $this->setDate($message['date']);
        $this->setMessageParent($message['messageParent']);
    }

}
