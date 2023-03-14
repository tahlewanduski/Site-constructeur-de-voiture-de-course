
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title> <?php echo $this->title; ?></title>
  </head>
  <body>
    <div><?php echo $this->feedback; ?></div>
    <div>
      <a href='<?php echo $this->menu['accueil']; ?>'>Accueil</a>
      <a href='<?php echo $this->menu['constructeurs']; ?>'>Constructeurs</a>
      <a href='<?php echo $this->menu['new']; ?>'>Nouveau Constructeur</a>
      <a href='<?php echo $this->menu['a_propos'] ?>'>A propos</a>
    </div>

    <h1><?php echo $this->title; ?></h1>
    <div><?php echo $this->content; ?></div>
  
  </body>

</html>