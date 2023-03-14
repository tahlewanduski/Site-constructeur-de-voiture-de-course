<?php 


class CarMakerBuilder{
    private $data;
    const CONSTRUCTEUR_ref = "constructeur";
    const CHAMPIONSHIP_ref = "championship";
    const WIN_ref = "win";
    

    function __construct(array $data)
    {
        $this->data = $data;
        $this->error = null;
    }

    function getData(){
        return $this->data;
    }

    function getError(){
        return $this->error;
    }

    function createCarMaker(){
        if($this->isValid()){
            foreach($this->data as $key => $value){
                $this->data[$key] = htmlspecialchars($value);
            }
            return new CarMaker($this->data[$this::CONSTRUCTEUR_ref],$this->data[$this::CHAMPIONSHIP_ref],$this->data[$this::WIN_ref]);
        }else{
            return null;
        }
    }

    function isValid(){
        if( !key_exists($this::CONSTRUCTEUR_ref, $this->data) || !key_exists($this::CHAMPIONSHIP_ref,$this->data) || !key_exists($this::WIN_ref,$this->data) || $this->data[$this::CONSTRUCTEUR_ref] === null || $this->data[$this::CHAMPIONSHIP_ref] === null || $this->data[$this::WIN_ref] === null || $this->data[$this::CONSTRUCTEUR_ref] === "" || $this->data[$this::CHAMPIONSHIP_ref] === "" || $this->data[$this::WIN_ref] === "" || $this->data[$this::WIN_ref] < 0 || !is_numeric($this->data[$this::WIN_ref])){
            $this->error = "Veuillez remplir tous les champs correctement :: ";
            if(!key_exists($this::CONSTRUCTEUR_ref, $this->data) || $this->data[$this::CONSTRUCTEUR_ref] === null || $this->data[$this::CONSTRUCTEUR_ref] === ""){
                $this->error .= " /!\ UNDEFINED_constructeur ";
            }
            if(!key_exists($this::CHAMPIONSHIP_ref,$this->data) || $this->data[$this::CHAMPIONSHIP_ref] === null || $this->data[$this::CHAMPIONSHIP_ref] === ""){
                $this->error .= " /!\ UNDEFINED_championship";
            }
            if( !key_exists($this::WIN_ref,$this->data) || $this->data[$this::WIN_ref] === null || $this->data[$this::WIN_ref] === "" || !is_numeric($this->data[$this::WIN_ref])){
                $this->error .= " /!\ UNDEFINED_win";
            }elseif($this->data[$this::WIN_ref] < 0){
                $this->error .= " /!\ NEGATIVE_win";
            }
            return false;
        }
        return true;
    }

    function getConst_ref(){
        return $this::CONSTRUCTEUR_ref;
    }

    function getChamp_ref(){
        return $this::CHAMPIONSHIP_ref;
    }

    function getWin_ref(){
        return $this::WIN_ref;
    }

    function getConst(){
        return key_exists($this::CONSTRUCTEUR_ref,$this->data) ? $this->data[$this::CONSTRUCTEUR_ref] : null;
    }

    function getChamp(){
        return key_exists($this::CHAMPIONSHIP_ref,$this->data) ? $this->data[$this::CHAMPIONSHIP_ref] : null;
    }

    function getWin(){
        return key_exists($this::WIN_ref,$this->data) ? $this->data[$this::WIN_ref] : null;
    }


}



?>