<div>
    <div id="infos">
        <h3><?=$user['nickname'] ?></h3>
        <p><?=$user['email'] ?></p>
        <div class="btnGroup">
            <a class="normal" href="<?=$baseurl?>">Retour a la liste des posts</a>
            <a class="dangerous" href="<?=$baseurl."index.php/visagelivre/deleteMe/".$user['nickname']?>">Supprimer mon compte</a>
        </div>
    </div>
    <div id="user">
        <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <div class="col">
            <h4>Amis</h4>
            <ul id="friends">
                <?php
                if (!empty($friend)){
                    foreach($friend as $f){
                        echo "<li>".$f['ami']." <i>(depuis : ".$f['birth_date'].")</i><a title='Supprimer' class='option' href='".$baseurl."index.php/visagelivre/deleteFriend/".$user['nickname']."/".$f['ami']."'><img title='[Supprimer]' alt='[Supprimer]' src='".$baseurl."assets/img/cross.svg' width='20'/></a></li>";
                    }
                } else {
                    echo "<i>- Aucun -</i>";
                }
                ?>
            </ul>
            <h4>Autres utilisateurs</h4>
            <ul id="otherUser">
                <?php
                if (!empty($otheruser)){
                    foreach($otheruser as $f){
                        if ($user['nickname'] != $f['nickname'])
                            echo "<li>".$f['nickname']." <a class='option' title='Demander en amis' href='".$baseurl."index.php/visagelivre/requestUser/".$user['nickname']."/".$f['nickname']."'><img title='[Demander en amis]' alt='[Demander en amis]' src='".$baseurl."assets/img/plus.svg' width='20'/></a></li>";
                    }
                } else {
                    echo "<i>- Aucune -</i>";
                }
                ?>
            </ul>
        </div>
        <div class="col">
            <h4>Demandes d'amis envoyées</h4>
            <ul id="friendrequest">
                <?php
                if (!empty($friendRequest)){
                    foreach($friendRequest as $f){
                        echo "<li>".$f['target']." - ".$f['request_date']." <a class='option' title='Supprimer' href='".$baseurl."index.php/visagelivre/deleteRequest/".$user['nickname']."/".$f['target']."'><img title='[Supprimer]' alt='[Supprimer]' src='".$baseurl."assets/img/cross.svg' width='20'/></a></li>";
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
                        echo "<li>".$f['requester']." - ".$f['request_date']." <a title='Accepter' class='option'  href='".$baseurl."index.php/visagelivre/acceptRequest/".$user['nickname']."/".$f['requester']."'><img title='[Accepter]' alt='[Accepter]' src='".$baseurl."assets/img/plus.svg' width='20'/></a><a title='Refuser' class='option'  href='".$baseurl."index.php/visagelivre/deleteRequest/".$user['nickname']."/".$f['requester']."'><img title='[Supprimer]' alt='[Supprimer]' src='".$baseurl."assets/img/cross.svg' width='20'/></a></li>";
                    }
                } else {
                    echo "<i>- Aucune -</i>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>