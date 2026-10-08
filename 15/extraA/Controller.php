<?php

require "Model.php";
require "View.php";

//! Q: Ik had het zo opgebouwd dat de Controller tussen Model en View zit. 
//! In de uitwerking zie ik meer een triade waarbij View en Controller hetzelfde Model gebruiken. 
//! Welke opbouw is gebruikelijker in de praktijk?

class Controller {

    private $model;
    private $view;

    public function __construct() {
        //model en view maken
        $this->model = new Model();
        $this->view = new View();
    }

    public function showUsers() {

        //users ophalen uit model
        $users = $this->model->getUsers();

        //users doorgeven aan view
        $this->view->showUsers($users);
    }
}

$controller = new Controller();
$controller->showUsers();