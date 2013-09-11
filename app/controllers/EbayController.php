<?php
class EbayController extends \Phalcon\Mvc\Controller {
    public $settings;

    public function initialize() {
        $this->settings = array(
            "appId" => "StephanM-fe23-4360-85db-9b6e5124a4fe",
            "terapeakId" => "ea2jq98a2awcjb8pb7ekr64a",
            "query" => urlencode($this->request->getPost("query"))
        );
    }

    public function indexAction() {

    }

    public function searchAction() {
        $results = $this->getJson("http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=".$this->settings["appId"]."&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&keywords=".$this->settings["query"]);

        $content = $results["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"];

        $this->view->setVar("results",$content);

        $this->view->setVar(
            "toolbar",
            array(
                array(
                    "class" => "only-bids",
                    "text" => "Bids"
                ),
                array(
                    "class" => "selected-count",
                    "text" => "Selected:"
                ),
            )
        );
    }

    public function shoppingAction() {

        $results = $this->getJson("http://open.api.ebay.com/shopping?appid=".$this->settings["appId"]."&version=517&siteid=0&callname=FindPopularItems&QueryKeywords=".$this->settings["query"]."&responseencoding=JSON&callback=false", false);

        $content = $results[0]['ItemArray']['Item'];

        $this->view->setVar("results",$content);

        $this->view->setVar(
            "toolbar",
            array(
                array(
                    "class" => "selected-count",
                    "text" => ""
                ),
            )
        );

    }

    public function tradingAction(){

    }

    public function merchAction(){

    }

    public function researchAction(){

    }

    private function getJson($url, $format=true){
        if(!function_exists("curl_init")) die("cURL extension is not installed");

        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r=curl_exec($ch);
        curl_close($ch);
        if($format == true){
            return json_decode($r, true);
        }
        return json_decode('['.$r.']', true);
    }
}