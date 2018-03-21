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
        <?php
        if(isset($_SESSION['user']) && $pauteur==$_SESSION['user']['nickname']){//mon commentaire ?>
       <a href='<?= $baseurl."index.php/visagelivre/supprimer/$pid"?>'><img title='Supprimer le billet' alt='Supprimer le billet' src='<?=$baseurl."assets/img/cross.svg"?>' width='20'/></a> 
<?php
    }?>
        <hr/>
        <?=$pcontent?>
        <a href="<?=$baseurl."index.php/visagelivre/post/$pid"?>">[Afficher les réponses]</a>
    </div>
        <?php
    }
if(isset($_SESSION['user']) && !isset($amisUniq)){//est connecté?>
    
<div style='margin:5px 0;'>
    <?php
    echo form_open('visagelivre/ajoutBillet/-1') ?>
        <div class="addpost">
            <label>Ajouter un post : </label>
            <textarea name="content" maxlength="128"></textarea>
        </div>
        <input type="submit"/>
    </form>
</div>
<?php } ?>
