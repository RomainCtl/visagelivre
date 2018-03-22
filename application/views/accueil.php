<?php if ($title != "Mes Posts"){ ?>
<div id="btnlist">
    <button type="button" onclick="sortA()">Trie par Nom</button>
</div>
<?php } ?>
<div id="lesposts">
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
        <?php
        if (strlen($pcontent) > 30)
            echo mb_substr($pcontent, 0, 30)."...";
        else echo $pcontent;
        ?>
        <a href="<?=$baseurl."index.php/visagelivre/post/$pid"?>">[Afficher les réponses]</a>
    </div>
        <?php
    }
if(isset($_SESSION['user'])){//est connecté?>
    
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
</div>
<script>
    var posts = <?= json_encode($posts, JSON_UNESCAPED_UNICODE); ?>;
    var isconnect = <?= isset($_SESSION['user'])?>;
    var nickname = "<?= (isset($_SESSION['user']) ? $_SESSION['user']['nickname'] : "") ?>";
    var baseurl = "<?= $baseurl ?>";
    
    function sortA(){
        var tmp = posts.sort(function (a, b) {
            return a['auteur'].localeCompare(b['auteur']);
        });
        document.getElementById("btnlist").innerHTML = "<button type='button' onclick='sortN()'>Trie par Date</button>";
        displayPost(tmp);
    }
    
    function sortN(){
        var tmp = posts.sort(function (a, b) {
            return -(a['create_date'].localeCompare(b['create_date']));
        });
        document.getElementById("btnlist").innerHTML = "<button type='button' onclick='sortA()'>Trie par Nom</button>";
        displayPost(tmp);
    }
    
    function displayPost(post){
        var div = document.getElementById('lesposts');
        div.innerHTML = "";
        for (var i=0 ; i < post.length ; i++){
            var tmp = "";
            tmp += "<div class='billet'>";
            tmp += post[i]['auteur']+"<br/>";
            tmp += post[i]['create_date']+"<br/>";
            if (post[i]['auteur'] == nickname){
                tmp += "<a href='"+baseurl+"index.php/visagelivre/supprimer/"+post[i]['iddoc']+"'><img title='Supprimer le billet' alt='Supprimer le billet'  src='"+baseurl+"assets/img/cross.svg' width='20'/></a>";
            }
            tmp += "<hr/>";
            if (post[i]['content'].length > 30){
                tmp += post[i]['content'].substring(0, 30)+"...";
            } else {
                tmp += post[i]['content'];
            }
            tmp += "<a href='"+baseurl+"index.php/visagelivre/post/"+post[i]['iddoc']+"' >[Afficher les réponses]</a></div>";
            
            div.innerHTML += tmp;
        }
        if (isconnect){
            div.innerHTML += "<div style='margin:5px 0;'><form action='"+baseurl+"index.php/visagelivre/ajoutBillet/-1' method='post' accept-charset='utf-8'><div class='addpost'><label>Ajouter un post : </label><textarea name='content' maxlength='128'></textarea></div><input type='submit'/></form></div>";
        }
    }
</script>
