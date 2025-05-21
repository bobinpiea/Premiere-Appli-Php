<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Mon Appli -  PHP </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="lien-accueil"><a href="index.php">Accueil</a></div>
            <div class="lien-panier"><a href="recap.php">Voir panier (<?php echo $nbArticles; ?>)</a></div>
        </nav>
    </header>
    <main>
        <div id="wrapper">
            <?= $content ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </main>

    <footer>
        <p>© <?php echo date("Y"); ?> - Mon site PHP</p>
    </footer>
</body>
</html>