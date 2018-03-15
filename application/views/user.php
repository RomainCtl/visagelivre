<a href="<?=$baseurl?>">Retour a la liste des posts</a>
<a href="<?=$baseurl."index.php/visagelivre/deleteMe/".$user['nickname']?>">Supprimer mon compte</a>
<div>
    <h3><?=$user['nickname'] ?></h3>
    <p><?=$user['email'] ?></p>
    <div>
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <h4>Amis</h4>
        <ul id="friends">
            <?php
            if (!empty($friend)){
                foreach($friend as $f){
                    echo "<li>".$f['ami']." <i>(depuis : ".$f['birth_date'].")</i><a href='".$baseurl."index.php/visagelivre/deleteFriend/".$user['nickname']."/".$f['ami']."'>[Supprimer]</a></li>";
                }
            } else {
                echo "<i>- Aucun -</i>";
            }
            ?>
        </ul>
        <h4>Demandes d'amis envoyées</h4>
        <ul id="friendrequest">
            <?php
            if (!empty($friendRequest)){
                foreach($friendRequest as $f){
                    echo "<li>".$f['target']." - ".$f['request_date']." <a href='".$baseurl."index.php/visagelivre/deleteRequest/".$user['nickname']."/".$f['target']."'>[Supprimer]</a></li>";
                }
            } else {
                echo "<i>- Aucune -</i>";
            }
            ?>
        </ul>
        <h4>Demandes d'amis reçues</h4>
        <ul id="friendtarget">
            <?php
            if (!empty($friendTarget)){
                foreach($friendTarget as $f){
                    echo "<li>".$f['requester']." - ".$f['request_date']." <a href='".$baseurl."index.php/visagelivre/acceptRequest/".$user['nickname']."/".$f['requester']."'>[Accepter]</a><a href='".$baseurl."index.php/visagelivre/deleteRequest/".$user['nickname']."/".$f['requester']."'>[Refuser]</a></li>";
                }
            } else {
                echo "<i>- Aucune -</i>";
            }
            ?>
        </ul>
        <h4>Autres utilisateurs</h4>
        <ul id="otherUser">
            <?php
            if (!empty($otheruser)){
                foreach($otheruser as $f){
                    if ($user['nickname'] != $f['nickname'])
                        echo "<li>".$f['nickname']." <a href='".$baseurl."index.php/visagelivre/requestUser/".$user['nickname']."/".$f['nickname']."'>[Demander en amis]</a></li>";
                }
            } else {
                echo "<i>- Aucune -</i>";
            }
            ?>
        </ul>
    </div>
</div>