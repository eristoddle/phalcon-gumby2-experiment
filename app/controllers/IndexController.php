<?php
class IndexController extends \Phalcon\Mvc\Controller {
    public function indexAction() {
        echo '<div class="home">';
        echo '<div class="directory">';
        echo '<div class="large primary btn">'.Phalcon\Tag::linkTo('signup', 'Sign Up').'</div>';
        echo '<div class="large primary btn">'.Phalcon\Tag::linkTo("ebay", "Ebay Tools").'</div>';
        echo '</div></div>';
    }
}