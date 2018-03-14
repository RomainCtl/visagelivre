<h2>Accueil</h2>

<a href="<?=$baseurl."index.php/visagelivre/inscription" ?>">Inscription</a>
<a href="<?=$baseurl."index.php/visagelivre/connect" ?>">Connexion</a>

<?php
    foreach($posts as $post){
        $pcontent=$post['content'];
        $pdate=$post['create_date'];
        $pauteur=$post['auteur'];
        $pid=$post['iddoc'];
    ?>
    <div class="billet">
        <?=$pauteur?><br/>
        <?=$pdate?><br/>
        <hr/>
        <?=$pcontent?>
        <a href="<?=$baseurl."index.php/visagelivre/post/$pid"?>">[Afficher les réponses]</a>
    </div>
        <?php
    }
?>