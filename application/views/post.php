<?php
function afficherCommentaires($commentaires,$cur){
    $pcontent=$commentaires['content'];
    $pdate=$commentaires['create_date'];
    $pauteur=$commentaires['auteur'];
    $pid=$commentaires['iddoc'];
    
    echo("<div class='billet'>");
    echo($pauteur."<br/>".$pdate."<hr/>".$pcontent);
    if(isset($commentaires['commentaires'])){
        foreach($commentaires['commentaires'] as $com){
            afficherCommentaires($com,$cur);
        }
    }
        echo("<hr/><div style='margin:5px 0;'>");
        echo form_open("visagelivre/ajoutBillet/$pid/$cur"); 
        echo("<label>Ajouter un commentaire : </label><textarea name='content'></textarea>
              <input type='submit'/>
        </form>
    </div>");
    echo("</div>");
}
?>
<a href="<?=$baseurl?>">Retour à la liste des posts</a>
<?php
afficherCommentaires($commentaires,$cur);
?>