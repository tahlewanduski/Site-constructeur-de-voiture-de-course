<?php

require_once "src/model/CarMakerBuilder.php";

class Controller{
    private $view;
    private $carTab;

    function __construct($view,$carMakerStorage)
    {
        $this->view = $view;
        $this->carMakerStorage= $carMakerStorage;
    }

    public function getCarTabC(){
        return $this->carMakerStorage->readAll();
    }


    /*Affiche les infos demandées si elles existent*/
    public function showInformation($id) {
        if(!key_exists( $id,$this->getCarTabC())){
            if($id=="liste"){
                $this->showList($this->getCarTabC());
            }else{
                $this->view->makeUnknownCarPage();
            }
        }else{
            $carMaker = $this->getCarTabC()[$id];
            $this->view->makeCarPage($id,$this->getCarTabC()[$id]);
        }
    }

    /**Affiche la liste */
    public function showList($tab){
        $this->view->makeListPage($tab);
    }

    /**Enregistre un nouveau constructeur si valide */
    function saveNewCarMaker(array $data){
        $carMakerBuilder = new CarMakerBuilder($data);
        if($carMakerBuilder->isValid()){
            $id = $this->carMakerStorage->create($carMakerBuilder->createCarMaker());
            $this->view->displayCarMakerCreationSuccess($id);        
        }else{
            $_SESSION['currentNewCarMaker'] = $carMakerBuilder; 
            $this->view->displayCarMakerCreationFailure();

        }
        unset($_SESSION["currentNewCarMaker"]);
    }

    /**Affiche a propos */
    function showApropos(){
        $this->view->makeAproposPage();
    }

    /**Créer un nouveau constructeur avant enregistrement */
    function newCarMaker($po){
        if(key_exists("currentNewCarMaker",$_SESSION)){
            $carMakerBuilder = $_SESSION["currentNewCarMaker"];
        }else{
            $carMakerBuilder = new CarMakerBuilder($po);
        }
        $this->view->makeCarMakerCreationPage($carMakerBuilder);
        unset($_SESSION["currentNewCarMaker"]);
    }

    /**Demande si deletion ou non */
    function askCarMakerDeletion($id){
        if($this->carMakerStorage->read($id) !== null){
            $this->view->makeUnknownCarPage();
        }
        $this->view->makeCarMakerDeletionPage($id);
    }

    /**Delete le constructeur */
    function deleteCarMaker($id){
        $this->carMakerStorage->delete($id);
        $this->view->displayCarMakerDeletionSuccess($id);
    }

    /*Modifie le constructeur choisi*/
    function updateCarMaker($id){
        if(key_exists("currentUpdateCarMaker",$_SESSION)){
            $carMakerBuilder = $_SESSION["currentUpdateCarMaker"];
        }else{
            $carMakerBuilder = $this->carMakerStorage->read($id);
        }
        $this->view->makeCarMakerUpdatePage($id,$carMakerBuilder);
        unset($_SESSION["currentUpdateCarMaker"]);
    }

    /**Enregistre le constructeur modifié */
    function saveUpdateCarMaker($id,$data){
        $carMakerBuilder = new CarMakerBuilder($data);
        if($carMakerBuilder->isValid()){
            $this->carMakerStorage->update($id,$carMakerBuilder->createCarMaker());
            $this->view->displayCarMakerUpdateSuccess($id);
        }else{
            $_SESSION['currentUpdateCarMaker'] = $carMakerBuilder; 
            $this->view->displayCarMakerUpdateFailure($id);
        }
        unset($_SESSION["currentUpdateCarMaker"]);
    }
}

?>