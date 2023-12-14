<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $titulo; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php echo isset($header)?$header:"" ?>
        <?= $body; ?>
        <?php echo isset($footer)?$footer:""; ?>

    </body> 
</html>