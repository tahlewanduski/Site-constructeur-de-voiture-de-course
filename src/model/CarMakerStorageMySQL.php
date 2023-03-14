<?php 

class CarMakerStorageMySQL implements CarMakerStorage{

    private $pdo;

    function __construct(PDO $pdo){
        $this->pdo = $pdo;
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    function getCarTab(){
        $carTab = array();
        $req = $this->pdo->prepare('SELECT * FROM carmaker');
        $req->execute();
        while($data = $req->fetch()){
            $carTab[$data['id']] = new CarMaker($data['constructeur'],$data['championship'],$data['win']);
        }
        return $carTab;
    }

    function read($id){
        $req = $this->pdo->prepare('SELECT * FROM carmaker WHERE id = :id');

        $req->execute(['id' => $id]);
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if($data === false){
            return null;
        }else{
            return new CarMakerBuilder($data);
        }
    }

    function readAll(){
        $carTab = array();
        $req = $this->pdo->prepare('SELECT * FROM carmaker');
        $req->execute();
        while($data = $req->fetch()){
            $carTab[$data['id']] = new CarMaker($data['constructeur'],$data['championship'],$data['win']);
        }
        return $carTab;
    }

    function create(CarMaker $carMaker){
        $req = $this->pdo->prepare('INSERT INTO carmaker(constructeur,championship,win) VALUES(:constructeur,:championship,:win)');
        $req->execute(array(
            'constructeur' => $carMaker->getConstructeur(),
            'championship' => $carMaker->getChampionship(),
            'win' => $carMaker->getWin()
        ));
        return $this->pdo->lastInsertId();

    }

    function update($id,CarMaker $carMaker){
        $req = $this->pdo->prepare('UPDATE carmaker SET constructeur = :constructeur, championship = :championship, win = :win WHERE id = :id');
        $req->execute(array(
            'id' => $id,
            'constructeur' => $carMaker->getConstructeur(),
            'championship' => $carMaker->getChampionship(),
            'win' => $carMaker->getWin(),
        ));
    }

    function delete($id){
        $req = $this->pdo->prepare('DELETE FROM carmaker WHERE id = :id');
        $req->execute(array('id' => $id));
    }

}




?>