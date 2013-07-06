<?php
class IndexController extends \Phalcon\Mvc\Controller {
    public function indexAction() {

        echo "<h1>Hello!</h1>";

        echo Phalcon\Tag::linkTo("signup", "Sign Up Here!");

        echo "<br>";

        echo Phalcon\Tag::linkTo("ebay", "Ebay");

    }
}