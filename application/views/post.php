<?php
function afficherCommentaires($commentaires,$cur,$baseurl){
    $pcontent=$commentaires['content'];
    $pdate=$commentaires['create_date'];
    $pauteur=$commentaires['auteur'];
    $pid=$commentaires['iddoc'];
    
    
    echo("<div class='billet'>");
    echo($pauteur."<br/>".$pdate);
    
    if(isset($_SESSION['user']) && $pauteur==$_SESSION['user']['nickname']){//mon commentaire ?>
       <a href='<?= $baseurl."index.php/visagelivre/supprimer/$pid/$cur"?>'><img title='Supprimer le billet' alt='Supprimer le billet' src='<?=$baseurl."assets/img/cross.svg"?>' width='20'/></a> 
<?php
    }
    
    echo("<hr/>".$pcontent);
    if(isset($commentaires['commentaires'])){
        foreach($commentaires['commentaires'] as $com){
            afficherCommentaires($com,$cur,$baseurl);
        }
    }
    if(isset($_SESSION['user'])){ 
        echo("<hr/><div style='margin:5px 0;'>");
        echo form_open("visagelivre/ajoutBillet/$pid/$cur"); 
        echo("<label>Ajouter un commentaire : </label><textarea name='content'  maxlength='128'></textarea>
              <input type='submit'/>
        </form>
    </div>");
        }
    echo("</div>");
}
?>
<div style="display: flex;margin-bottom: 20px;">
    <a class="normal" href="<?=$baseurl?>">Retour à la liste des posts</a>
</div>
<?php
afficherCommentaires($commentaires,$cur,$baseurl);
?>