<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="<?= $baseurl."assets/img/visagelivre.svg" ?>"/>
        <title><?= $title ?> - Visage Livre </title>
        <link href="<?= $baseurl."assets/css/style.css" ?>" rel="stylesheet" />
    </head>
    <body>
        <div id="global">
            <div id="entete">
                <img title="VisageLivre Icon" alt="VisageLivre Icon" src="<?= $baseurl."assets/img/visagelivre.svg" ?>" width="50"/>
                <h1><a href="<?=$baseurl ?>">isage Livre</a></h1>
                <div>
                    <a href="<?=$baseurl ?>">Accueil</a>
                    <?php 
                    if(isset($_SESSION['user'])){//est connecté?>
                        <a href="<?=$baseurl."index.php/visagelivre/mesposts" ?>">Mes posts</a>
                        <a href="<?=$baseurl."index.php/visagelivre/user" ?>">Profil</a>
                        <a href="<?=$baseurl."index.php/visagelivre/disconnect" ?>">Déconnexion</a>
                    <?php  }else{//est déconnecté ?>
                        <a href="<?=$baseurl."index.php/visagelivre/inscription" ?>">Inscription</a>
                        <a href="<?=$baseurl."index.php/visagelivre/connect" ?>">Connexion</a>
                    <?php } ?>
                </div>
            </div>
            <div id="contenu">
                <?php if ($title != 'Post'){
                    echo "<h2 class='htitle'>$title</h2>";
                } ?>
                <?php $this->load->view($content); ?>
            </div>
        </div>
    </body>
</html>