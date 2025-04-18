<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Document</title>
</head>


<?php if (!empty($error)): ?>
    <h4 style="color: red;"><?= $error ?></h4>
<?php endif; ?>

<?php if (!empty($merciMsg)): ?>
    <h4 style="color: green;"><?= $merciMsg ?></h4>
<?php endif; ?>


<form action="" method="post">
    <div>
        <label for="name">nom</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="message">message</label>
        <textarea type="text" name="message" id="message"></textarea>
    </div>
    <button type="submit">Ok</button>
</form>


<br>
<?php echo "$pagination<hr>"; ?>

<?php if ($totalMessageSousEntier == 0): ?>
    <h2>Message a afficher</h2>
    <h3>Pas encors de messages !</h3>
<?php else: ?>
    <h2>Message a afficher</h2>
    <h3>Il y'a <?= $totalMessageSousEntier ?> message<?= $totalMessageSousEntier > 1 ? "s" : ""; ?>
    </h3>
    <?php foreach ($recupMessage as $message): ?>
        <p><?= $message['name']; ?></p>
        <p><?= $message['message']; ?></p>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

</body>

</html>