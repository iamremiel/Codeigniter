<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <?php require_once('resources/script.php');?>
    <title><?=$title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
        <body>
        <?php require_once("pages/".$page.".php");?>
        <?php require_once("pages/modals.php");?>
        </body>
</html>