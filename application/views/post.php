<?php
function afficherCommentaires($commentaires){
    $pcontent=$commentaires['content'];
    $pdate=$commentaires['create_date'];
    $pauteur=$commentaires['auteur'];
    $pid=$commentaires['iddoc'];
    
    echo("<div class='billet'>");
    echo($pauteur."<br/>".$pdate."<hr/>".$pcontent);
    if(isset($commentaires['commentaires'])){
        foreach($commentaires['commentaires'] as $com){
            afficherCommentaires($com);
        }
    }
    echo("</div>");
}

afficherCommentaires($commentaires);
?>