<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?> - Visage Livre </title>
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
                <strong>&copy; 2016</strong>
            </div>
        </div>
    </body>
</html>