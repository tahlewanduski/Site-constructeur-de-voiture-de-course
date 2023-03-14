<?php
require_once "view/View.php";
require_once "control/Controller.php";
require_once 'model/CarMaker.php';
require_once 'model/CarMakerStorage.php';
require_once 'model/CarMakerStorageFile.php';
require_once 'model/CarMakerBuilder.php';

class Router{

    function __construct(){
    }

    function main(CarMakerStorage $carMS){
        /*start la session*/
        session_start();

        /*initialise le feedback*/
        if(key_exists("feedback",$_SESSION)){
            $feedback = $_SESSION["feedback"];
            unset($_SESSION["feedback"]);
        }else{
            $feedback = "";
        }
        $View = new View("Acceuil","Bienvenue",$this, $feedback);
        $Cont = new Controller($View,$carMS);
        
        /* Reinitaialise la liste d'objets */
        /*$Cont->carMakerStorage->reinit();*/

        /*check URL*/
        $carId = key_exists("id",$_GET) ? $_GET["id"] : null;
        $action = key_exists("action",$_GET) ? $_GET["action"] : null;
        if($action === null){
            $action = ($carId === null) ? "home" : "show";
        }
        if(key_exists("liste",$_GET)){
            $Cont->showList($Cont->getCarTabC());
        }
        if(key_exists("new",$_GET)){
            $Cont->newCarMaker($_POST);
        }
        if(key_exists("a_propos",$_GET)){
            $Cont->showApropos();
        }
        try{
            switch($action){
                case "home":
                    $View->makeHomePage();
                    break;
                case "show":
                    if($carId === null){
                        $View->makeUnknownActionPage();
                    }else{
                        $Cont->showInformation($carId);
                    }
                    break;
                
                case "new":
                    $Cont->newCarMaker($_POST);
                    break;
                    
                case "save":
                    $Cont->saveNewCarMaker($_POST);
                    break;

                case "update":
                    $Cont->updateCarMaker($_GET["id"]);
                    break;

                case "upsave":
                    $Cont->saveUpdateCarMaker($_GET["id"],$_POST);
                    break;
                
                case "delete":
                    $Cont->askCarMakerDeletion($_GET["id"]);
                    break;

                case "deletion":
                    $Cont->deleteCarMaker($_GET["id"]);
                    break;

                default:
                    $View->makeUnknownActionPage();
                    break;
                }
        } catch(Exception $e){
            $View->makeErrorPage($e);
        }

        $View->render();
    }

    function getCarMakerURL($id){
            if($id === null){
                $url = './carMaker.php';
            }else{
                $url = './carMaker.php?'.$id;
            }
        return $url;
    }

    function getCarMakerURLid($id){
        return './carMaker.php?id='.$id;
    }

    function getCarMakerCreationURL() {
        return './carMaker.php?action=new';
    }

    function getCarMakerSaveURL() {
        return './carMaker.php?action=save';
    }

    function getCarMakerUpdateURL($id) {
        return './carMaker.php?action=update&id='.$id;
    }
    
    function getCarMakerUpdateSaveURL($id) {
        return './carMaker.php?action=upsave&id='.$id;
    }
    function getCarMakerDeletionURL($id) {
        return './carMaker.php?action=deletion&id='.$id;
    }

    function getCarMakerAskDeletionURL($id) {
        return './carMaker.php?action=delete&id='.$id;
    }

    function POSTredirect($url, $feedback){
        $_SESSION["feedback"] = $feedback;
        header('Location:'. $url, true, 303);
    }
}


?>