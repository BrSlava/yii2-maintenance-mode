<?php
/**
 * Default view of maintenance mode component for Yii framework 2.0
 * @author Brusenskiy Dmitry <brussens@nativeweb.ru>
 */
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="<?= \Yii::$app->language ?>">
<head>
    <meta charset="<?= \Yii::$app->charset ?>">
    <title><?= Html::encode(Yii::$app->name) ?></title>
    <style>
        body { text-align: center; padding: 150px; }
        h1 { font-size: 50px; }
        body { font: 20px Helvetica, sans-serif; color: #333; }
        article { display: block; text-align: left; width: 650px; margin: 0 auto; }
        a { color: #dc8100; text-decoration: none; }
        a:hover { color: #333; text-decoration: none; }
    </style>
</head>
<body>
<article>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>
            <?= Yii::$app->maintenanceMode->message ?>
        </p>
    </div>
</article>
</body>
</html>
