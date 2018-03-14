<h2>Inscription</h2>

<?php 
echo validation_errors();

echo form_open('visagelivre/inscription'); ?>

    <label for="title">Identifiant</label>
    <input type="input" name="nickname" placeholder="Identifiant" required><br/>
    <label for="title">Mot de passe</label>
    <input type="password" name="pass[]" placeholder="Mot de passe" required><br/>
    <label for="title">Confirmer le Mot de passe</label>
    <input type="password" name="pass[]" placeholder="Mot de passe" required><br/>
    <label for="title">Email</label>
    <input type="email" name="email" placeholder="Email" required><br/>

    <input type="submit" name="submit" value="Connection">

</form>
<a href="<?=$baseurl."/index.php/visagelivre/connect" ?>">Connection</a>