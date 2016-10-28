<?php
/**
 * Created by PhpStorm.
 * User: msajadi832
 * Date: 8/24/14
 * Time: 8:29 PM
 */

namespace Pouyasazan\ExamplesBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainApi {

    const RES_FALSE = "false";
    const RES_TRUE = "true";
    const RES_NOT_AUTH = "not_auth";
    const DONE = "done";

    const ID = "id";
    const NAME = "nam";
    const AGE  = "age";
    const WEIGHT  = "weit";
    const GENDER = "gen";
    const GRADE = "grad";
    const PEOPLE = "peopl";


    const PAGE = "page";
    const RESULTS = "res";
    const TOTAL_RESULTS = "totRes";
    const TOTAL_PAGES = "totPag";

    const NOT_EXIST_CONTENT = "0";
    const EXIST_CONTENT = "1";

    public static function start(Controller $controller){ //, $isGuest = false
        $request = $controller->get('request');
        $apiData = new ApiData($request->request->all(), $request->files->all());

        //check Auth
//        if(!$isGuest) {
//            $res = MainApi::checkParams($apiData, array(MainApi::$CODE));
//            /** @var User $user */
//            $user = $controller->get('doctrine')->getRepository("PouyasazanTrainingBundle:User")->findOneBy(array("code" => $res['code']));
//            if ($user == null || !$user->hasRole("ROLE_USER"))
//                die(MainApi::$RES_NOT_AUTH);
//            $apiData->setUser($user);
//            $apiData->removeKeyFromRequest(MainApi::$CODE);
//        }

        return $apiData;
    }

    public static function checkParams(apiData $apiData, array $params){
//        dump($params);
        $childs = $apiData->getRequest();
        $keys = array_keys($childs);
        if(count(array_intersect($keys, $params)) < count($params))
            die(MainApi::RES_FALSE);

        return $childs;
    }

    public static function checkFiles(apiData $apiData, array $files){
        $childs = $apiData->getFiles();
        $keys = array_keys($childs);
        if(count(array_intersect($keys, $files)) < count($files))
            die(MainApi::RES_FALSE);

        return $childs;
    }

    public static function dateToStr(\DateTime $date){
        return $date->format('Y-m-d H:i:s');
    }

    public static function strToDate($strDate){
        return \DateTime::createFromFormat('Y-m-d H:i:s', $strDate);
    }

}

class apiData{
    private $request;
    private $files;
    private $response = array();
//    private $user = null;


    /**
     * @param array $request
     * @param array $files
     */
    public function __construct(array $request, array $files){
        $this->request = $request;
        $this->files = $files;
    }

    /**
     * @param array $value
     */
    public function pushResponse(array $value){
        $this->response = array_merge($this->response, $value);
//        $this->response[$key] = $value;
    }

    /**
     * @return array
     */
    public function getAllResponse(){
        return $this->response;
    }

    /**
     * @return Response
     */
    public function sendResponse(){
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($this->response));
        return $response;
    }

    /**
     * @return array
     */
    public function getRequest(){
        return $this->request;
    }

    /**
     * @param $key
     */
    public function removeKeyFromRequest($key){
        unset($this->request[$key]);
    }

    /**
     * @return array
     */
    public function getFiles(){
        return $this->files;
    }

    /**
     * @param $key
     */
    public function removeKeyFromFiles($key){
        unset($this->files[$key]);
    }


//    /**
//     * @return User
//     */
//    public function getUser(){
//        return $this->user;
//    }
//
//    /**
//     * @param User $user
//     */
//    public function setUser(User $user){
//        $this->user = $user;
//    }


}