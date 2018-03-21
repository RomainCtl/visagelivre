<?php
echo validation_errors();

if (isset($errormsg)) echo $errormsg;

echo "<div class='signForm'>";
    echo form_open('visagelivre/connect'); ?>

        <div>
            <label for="title">Identifiant</label>
            <input class="inp" type="input" name="nickname" placeholder="Identifiant" required><br/>
        </div>
        <div>
            <label for="title">Mot de passe</label>
            <input class="inp" type="password" name="pass" placeholder="Mot de passe" required><br/>
        </div>
        <div>
            <input type="submit" name="submit" value="Connexion">
        </div>
    </form>
<a href="<?=$baseurl."index.php/visagelivre/inscription" ?>">Inscription</a>
</div>