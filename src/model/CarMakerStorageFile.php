<?php

require_once("src/lib/ObjectFileDB.php");
require_once("model/CarMaker.php");
require_once("model/CarMakerStorage.php");

class CarMakerStorageFile implements CarMakerStorage{

    private $db;

    function __construct($file){
        $this->db = new ObjectFileDB($file);
    }

    function create(CarMaker $CarMaker){
        return $this->db->insert($CarMaker);
    }

    function read($id){
        if($this->db->exists($id)){
            return $this->db->fetch($id);
        }else{
            return null;
        }
    }

    function readAll(){
        return $this->db->fetchAll();
    }

    function update($id, CarMaker $CarMaker){
        if($this->db->exists($id)){
            $this->db->update($id,$CarMaker);
            return true;
        }
        return false;
    }

    function delete($id){
        if($this->db->exists($id)){
            $this->db->delete($id);
            return true;
        }
        return false;
    }

    function deleteAll(){
        $this->db->deleteAll();
    }

    function reinit(){
        $this->deleteAll();
        $this->create(new CarMaker("Ferrari","F1",15));
        $this->create(new CarMaker("Mercedes","F1",10));
        $this->create(new CarMaker("Renault","F1",2));
        $this->create(new CarMaker("McLaren","F1",8));
        $this->create(new CarMaker("Aston Martin","F1",0));
        $this->create(new CarMaker("Alpine","F1",0));
        $this->create(new CarMaker("Alpha Tauri","F1",0));
        $this->create(new CarMaker("Alfa Romeo","F1",0));
        $this->create(new CarMaker("Williams","F1",0));
        $this->create(new CarMaker("Haas","F1",0));
    }
}

?>