<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?> - Visage Livre </title>
        <link href="<?= $baseurl."assets/css/style.css" ?>" rel="stylesheet" />
        
    </head>
    <body>
        <div id="global">
            <div id="entete">
                <h1>Visage Livre</h1>
            </div>
            <div id="contenu">
                <?php $this->load->view($content); ?>
            </div>
            <div id="pied">
                <strong>&copy; 2018</strong>
            </div>
        </div>
    </body>
</html>