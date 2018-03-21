<?php 
echo validation_errors();

if (isset($errormsg)) echo $errormsg;

echo "<div class='signForm'>";
    echo form_open('visagelivre/inscription'); ?>

        <div>
            <label for="title">Identifiant</label>
            <input type="input" name="nickname" placeholder="Identifiant" required><br/>
        </div>
        <div>
            <label for="title">Mot de passe</label>
            <input type="password" name="pass[]" placeholder="Mot de passe" required><br/>
        </div>
        <div>
            <label for="title">Confirmer le Mot de passe</label>
            <input type="password" name="pass[]" placeholder="Mot de passe" required><br/>
        </div>
        <div>
            <label for="title">Email</label>
            <input type="email" name="email" placeholder="Email" required><br/>
        </div>
        <div>

            <input type="submit" name="submit" value="Inscription">
        </div>

    </form>
<a href="<?=$baseurl."index.php/visagelivre/connect" ?>">J'ai déjà un compte</a>
</div>