<?php

require_once 'CarMaker.php';

class CarMakerStorageStub implements CarMakerStorage{

    private $carTab;

    function __construct(){
        $this->carTab = array(
            'merco' => new CarMaker('Mercedes','F1',8),
            'alpine' => new CarMaker('Alpine','F1',0),
            'ferrari' => new CarMaker('Scuderia Ferrari','F1',16),
            'ferrarigt' => new CarMaker('Ferrari','24h du Mans',9),
            'ford' => new CarMaker('Ford','24h du Mans',4),
            'porsche' => new CarMaker('Porsche','24h du Mans',19),
        );
    }

    function getCarTab(){
        return $this->carTab;
    }

    function read($id){
        if(!key_exists( $id,$this->carTab)){
            return null;
        }else{
            return $this->carTab[$id];
        }
    }

    function readAll(){
        return $this->carTab;
    }

    function create(CarMaker $carMaker){
        $this->carTab[strtolower($carMaker->getConstructeur())] = $carMaker;
    }

    function update($id,CarMaker $carMaker){
        $this->carTab[$id] = $carMaker;
    }

    function delete($id){
        unset($this->carTab[$id]);
    }
}

?>