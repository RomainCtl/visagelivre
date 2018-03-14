<div>
    <h3><?=$user['nickname'] ?></h3>
    <p><?=$user['email'] ?></p>
    <div>
        <h4>Amis</h4>
        <ul id="friends">
            <?php
            if (!empty($friend)){
                foreach($friend as $f){
                    echo "<li>".$f['ami']." <i>(depuis : ".$f['birth_date'].")</i></li>";
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
                    echo "<li>".$f['requester']." - ".$f['request_date']."</li>";
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
                    echo "<li>".$f['target']." - ".$f['request_date']."</li>";
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
                    echo "<li>".$f['nickname']."</li>";
                }
            } else {
                echo "<i>- Aucune -</i>";
            }
            ?>
        </ul>
    </div>
</div>