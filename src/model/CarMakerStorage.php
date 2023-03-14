<?php 

interface CarMakerStorage{

    function read($id);

    function readAll();

    function create(CarMaker $CarMaker);

    function update($id, CarMaker $CarMaker);

    function delete($id);

}

?>