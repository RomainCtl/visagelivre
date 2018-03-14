<h2>Connection</h2>

<?php 
echo validation_errors();

echo form_open('visagelivre/connect'); ?>

    <label for="title">Identifiant</label>
    <input type="input" name="nickname" placeholder="Identifiant" required><br/>
    <label for="title">Mot de passe</label>
    <input type="pass" name="pass" placeholder="Mot de passe" required><br/>

    <input type="submit" name="submit" value="Connection">

</form>
<a href="<?=$baseurl."/index.php/visagelivre/inscription" ?>">Inscription</a>