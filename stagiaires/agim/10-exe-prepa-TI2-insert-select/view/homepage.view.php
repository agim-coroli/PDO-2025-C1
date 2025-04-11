<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Exercice</title>
</head>

<body>
    <div class="container mt-5 text-center">
        <div class="mb-3">
            <h1>Exercice</h1>
            <h2>Laissez-nous un message</h2>
        </div>
    </div>

    <div class="container mt-5 border border-3 border-dark shadow py-5">
        <form method="POST" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="surname" class="form-label">Surnom :</label>
                <input type="text" class="form-control" id="surname" name="surname" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="text" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message :</label>
                <input type="text" class="form-control" id="message" name="message" >
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <hr>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">
                    <?php if (count($message) === 0): ?>
                        Pas encore de messages
                    <?php else: ?>
                        Il y a <?= count($message) ?> message<?= count($message) === 1 ? "" : "s"; ?>
                    <?php endif; ?>
                </h2>
                <hr>
            </div>
        </div>

        <?php if (count($message) > 0): ?>
            <div class="row">
                <?php foreach ($message as $mess): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><strong>Surnom : </strong><?= $mess['surname'] ?></h3>
                                <p class="card-text"><strong>Email : </strong> <?= $mess['email'] ?></p>
                                <p class="card-text"><strong>Message : </strong> <?= $mess['message'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>