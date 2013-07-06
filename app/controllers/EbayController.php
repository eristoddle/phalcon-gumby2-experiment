<?php
class EbayController extends \Phalcon\Mvc\Controller {
    public $settings;

    public function initialize() {
        $this->settings = array(
            "appId" => "StephanM-fe23-4360-85db-9b6e5124a4fe",
            "query" => urlencode($this->request->getPost("query"))
        );
    }

    public function indexAction() {

    }

    public function searchAction() {

        $url = "http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=".$this->settings["appId"]."&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords=".$this->settings["query"];

        $content = $this->getJson($url);

        echo "<pre>";
        var_dump($content["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"]);
        echo "</pre>";

    }

    public function shoppingAction() {

        $url = "http://open.api.ebay.com/shopping?appid=".$this->settings["appId"]."&version=517&siteid=0&callname=FindItems&QueryKeywords=".$this->settings["query"]."&responseencoding=JSON&callback=true";

    }

    public function tradingAction(){

    }

    public function merchAction(){

    }

    public function researchAction(){

    }

    private function getJson($url){
        if(!function_exists("curl_init")) die("cURL extension is not installed");

        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r=curl_exec($ch);
        curl_close($ch);

        return json_decode($r, true);
    }
}