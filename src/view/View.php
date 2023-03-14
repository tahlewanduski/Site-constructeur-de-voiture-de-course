<?php

require_once "src/model/CarMakerBuilder.php";

class View{

    private $title;
    private $content;
    private $menu;
    private $feedback;

    function __construct($title,$content,$routeur,$feedback)
    {
        $this->title=$title;
        $this->content=$content;
        $this->routeur = $routeur;
        $this->menu= array(
            "accueil" => $this->routeur->getCarMakerURL(null),
            "constructeurs" => $this->routeur->getCarMakerURL("liste"),
            "new" => $this->routeur->getCarMakerCreationURL(),
            "a_propos" => $this->routeur->getCarMakerURL("a_propos")
        );
        $this->feedback = $feedback;
    }

    /**Affiche le rendu de la page */
    function render(){
        require_once "squelette.php";
    }

    /*--Création des pages--*/

    /**Créer la page d'accueil */
    function makeHomePage(){
        $this->title = "Accueil";
        $this->content = "Bienvenue sur le site des Constructeurs de voitures de course";
    }

    /**Créer la page d'un constructeur */
    function makeCarPage($id,$CarMaker){
        $this->title = $CarMaker->getConstructeur();
        $this->content = $CarMaker->getConstructeur() . " est un constructeur de voiture de " . $CarMaker->getChampionship() . ", il contabilise ". $CarMaker->getWin() . " victoires.";
        $this->content .= "<br> <fieldset><form action='". $this->routeur->getCarMakerAskDeletionURL($id) ."' method='post'><input type='submit' value='Delete'></form></fieldSet>";
        $this->content .= "<fieldset><form action='". $this->routeur->getCarMakerUpdateURL($id) ."' method='post'><input type='submit' value='Update'></form></fieldSet>";
    }

    /**Créer la page pour afficher la liste des constructeurs */
    function makeListPage($tab){
        /*filtrer la liste des objets via un champ de recherche */
        $this->content = "<fieldset><form action='". $this->routeur->getCarMakerURL("liste") ."' method='post'><input type='text' name='search'><input type='submit' value='Search'></form></fieldSet>";
        if(key_exists("search", $_POST) && $_POST["search"] != "") {
            foreach($tab as $key => $id){
                if($id->getConstructeur() != $_POST["search"]){
                    unset($tab[$key]);
                }
            } 
        }
        $this->title = "Liste";
        $this->content .= "Liste des Constructeurs disponibles:";
        $this->content .= "<ul>";
        foreach($tab as $key => $id){
            $this->content .= "<li><a href='". $this->routeur->getCarMakerURLid($key) ."'>". $id->getConstructeur() . "</a></li>";
        }
        $this->content .= "</ul>";
        $this->render();
    }    

    /**Créer la page pour afiicher le contenu de A Propos */
    function makeAproposPage(){
        $this->title = "A propos";
        $this->content = "<p>Ce site a été créé par Félix Sénéchal (22003660), étudiant en informatique à l'Université de Caen Normandie.";
        $this->content .= "Il a été réalisé dans le cadre du cours de PHP de M.Alexandre Niveau.</p>";
        $this->content .= "<p> J'ai choisi les constructeurs de voiture de course car je suis fan de course automobile.</p>";
        $this->content .= "<h2>Points réalisés</h2>";
        $this->content .= "<ul style='list-style-image: linear-gradient(to left bottom, red, blue);'>";
        $this->content .= "<li>Liste d'objets, affichables indépendamment</li>";
        $this->content .= "<li>Création basique d'un objet</li>";
        $this->content .= "<li>Modification basique d'un objet</li>";
        $this->content .= "<li>Builders pour la manipulation d'objets</li>";
        $this->content .= "<li>Suppression d'un objet</li>";
        $this->content .= "<li>Redirection en GET après création/modif/suppression réussie</li>";
        $this->content .= "<li>Utilisation de sessions pour la gestion des feedbacks</li>";
        $this->content .= "<li>Redirection en GET après POST même lors des erreurs</li>";
        $this->content .= "<li>Utilisation d'une base de données MySQL</li>";
        $this->content .= "<li>Possibilité de filtrer la liste des objets via un champ de recherche</li>";
        $this->content .= "</ul>";
        $this->render();
    }

    /**Créer la page pour créer un constructeur */
    public function makeCarMakerCreationPage($CarMakerBuilder){
        $valueConstructeur = $CarMakerBuilder->getConst();
        $valueChampionship = $CarMakerBuilder->getChamp();
        $valueWin = $CarMakerBuilder->getWin();
        $this->title = "Création d'un constructeur";
        $this->content = "Ajouter un constructeur en remplissant le formulaire ci-dessous:";
        $this->content .="<div> <fieldset><form action='". $this->routeur->getCarMakerSaveURL() ."' method='post'>
        <div><label> Constructeur : <input type='text' id='constructeur' name='constructeur' value='". $valueConstructeur ."'></label></div>
        <div><label> Disciplines : <input type='text' id='championship' name='championship'  value='". $valueChampionship ."'></label></div>
        <div><label> Titres constructeurs remportés : <input type='text' id='win' name='win'  value='". $valueWin ."'></label></div>
        <br>
        <input type='submit' value='Save'>
        </form></fieldset></div>";
    }

    /**Créer la page pour supprimer un constructeur */
    function makeCarMakerDeletionPage($id){
        $this->title = "Suppression";
        $this->content = "Suppression du constructeur";
        $this->content .= "<br><fieldset><form action='". $this->routeur->getCarMakerDeletionURL($id) ."' method='post'><input type='submit' value='Yes'></form></fieldSet>";
        $this->content .= "<fieldset><form action='". $this->routeur->getCarMakerURL($id) ."' method='post'><input type='submit' value='No'></form></fieldSet>";
    }

    /*Créer la page pour modifier un constructeur*/
    function makeCarMakerUpdatePage($id,$CarMakerBuilder){
        $this->title = "Modification";
        $this->content = "Modification du constructeur";
        $valueConstructeur = $CarMakerBuilder->getConst();
        $valueChampionship = $CarMakerBuilder->getChamp();
        $valueWin = $CarMakerBuilder->getWin();
        $this->content .="<div> <fieldset><form action='". $this->routeur->getCarMakerUpdateSaveURL($id) ."' method='post'>
        <div><label> Constructeur : <input type='text' id='constructeur' name='constructeur' value='". $valueConstructeur ."'></label></div>
        <div><label> Disciplines : <input type='text' id='championship' name='championship'  value='". $valueChampionship ."'></label></div>
        <div><label> Titres constructeurs remportés : <input type='text' id='win' name='win'  value='". $valueWin ."'></label></div>
        <br>
        <input type='submit' value='Save'>
        </form></fieldset></div>";

    }

    /*--Redirections création et modifications constructeurs avec feedback--*/
    
    /**Affiche le feedbacks après création d'un constructeur et redirige vers celui-ci */
    function displayCarMakerCreationSuccess($id){
        $this->feedback = "<p style='color:white;  text-align:center; background-color:green; border-radius: 1em;'> Le constructeur a bien été ajouté :) </p>";
        $this->routeur->POSTredirect($this->routeur->getCarMakerURLid($id),$this->feedback);
    }

    /**Affiche le feedbacks après échec de création d'un constructeur et reste sur la page de création*/
    function displayCarMakerCreationFailure(){
        $this->feedback = "<p style='color:red; font-weight:200px; text-align:center; border:1px solid red; border-radius: 1em;'>".$_SESSION["currentNewCarMaker"]->getError()." </p>";
        $this->routeur->POSTredirect($this->routeur->getCarMakerCreationURL(),$this->feedback);
    }

    /**Affiche le feedbacks après modification d'un constructeur et redirige vers celui-ci */
    function displayCarMakerUpdateSuccess($id){
        $this->feedback = "<p style='color:white;  text-align:center; background-color:green; border-radius: 1em;'> Le constructeur a bien été modifié :) </p>";
        $this->routeur->POSTredirect($this->routeur->getCarMakerURLid($id),$this->feedback);
    }

    /**Affiche le feedbacks après échec de modification d'un constructeur et reste sur la page de modification */
    function displayCarMakerUpdateFailure($id){
        $this->feedback = "<p style='color:red; font-weight:200px; text-align:center; border:1px solid red; border-radius: 1em;'>".$_SESSION["currentNewCarMaker"]->getError()." </p>";
        $this->routeur->POSTredirect($this->routeur->getCarMakerUpdateURL($id),$this->feedback);
    }

    /**Affiche le feedbacks après suppression d'un constructeur et redirige vers la page de liste de constructeurs */
    function displayCarMakerDeletionSuccess(){
        $this->feedback = "<p style='color:white;  text-align:center; background-color:green; border-radius: 1em;'> Le constructeur a bien été supprimé :) </p>";
        $this->routeur->POSTredirect($this->routeur->getCarMakerURL('liste'),$this->feedback);
    }

    /*--Création des différentes pages d'erreurs--*/

    /**Page de Debug */
    public function makeDebugPage($variable) {
        $this->title = 'Debug';
        $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
    }

    /**Page d'action inconnu pour le routeur*/
    function makeUnknownActionPage(){
        $this->title = "ERROR ACTION";
        $this->content = "<p> Action isn't correct";
    }
    
    /**Page d'erreur */
    function makeErrorPage(Exception $e){
        $this->title = "ERROR Exception";
        $this->content = "<p> Une erreur est survenue : " . $e->getMessage();
    }

    /**Page de constructeur inconnu dans la base de données */
    function makeUnknownCarPage(){
        $this->title = "ERROR";
        $this->content = "<p> KEY isn't in context with automobile's sport";
    }
}
?>