<?php

class CarMaker{
    private $constructeur;
    private $championship;
    private $win;

    function __construct($constructeur,$championship,$win)
    {
        $this->constructeur=$constructeur;
        $this->championship=$championship;
        $this->win=$win;
    }

    function getConstructeur(){
        return $this->constructeur;
    }

    function getChampionship(){
        return $this->championship;
    }

    function getWin(){
        return $this->win;
    }

}

?>