<?php 
if(isset($_SESSION['user'])){//est connecté?>
    <a href="<?=$baseurl."index.php/visagelivre/disconnect" ?>">Déconnexion</a>
    <a href="<?=$baseurl."index.php/visagelivre/user" ?>">Profil</a>

    <?php if(isset($amisUniq)&&$amisUniq){//Si on est sur les posts des amis uniquements ?>
        <a href="<?=$baseurl ?>">Retour à tous les posts</a>
    <?php }else{ ?>
        <a href="<?=$baseurl."index.php/visagelivre/mesposts" ?>">Mes posts</a>
        <a href="<?=$baseurl."index.php/visagelivre/postsamis" ?>">Posts des amis uniquement</a>
<?php } ?>
<div style='margin:5px 0;'>
    <?php
    echo form_open('visagelivre/ajoutBillet/-1') ?>
        <label>Ajouter un post : </label><textarea name="content"></textarea>
        <input type="submit"/>
    </form>
</div>
    
<?php   }else{//est déconnecté ?>

    <a href="<?=$baseurl."index.php/visagelivre/inscription" ?>">Inscription</a>
    <a href="<?=$baseurl."index.php/visagelivre/connect" ?>">Connexion</a>
<?php } 
    foreach($posts as $post){
        $pcontent=$post['content'];
        $pdate=$post['create_date'];
        $pauteur=$post['auteur'];
        $pid=$post['iddoc'];
    ?>
    <div class="billet">
        <?=$pauteur?><br/>
        <?=$pdate?><br/>
        <?php
        if(isset($_SESSION['user']) && $pauteur==$_SESSION['user']['nickname']){//mon commentaire ?>
       <a href='<?= $baseurl."index.php/visagelivre/supprimer/$pid"?>'>Supprimer le billet</a> 
<?php
    }?>
        <hr/>
        <?=$pcontent?>
        <a href="<?=$baseurl."index.php/visagelivre/post/$pid"?>">[Afficher les réponses]</a>
    </div>
        <?php
    }
?>