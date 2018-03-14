<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?> - Visage Livre </title>
        <style rel="text/css">
            .billet{
                border:1px black solid;
                margin:5px 0;
                padding:5px;
            }
        </style>
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