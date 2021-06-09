<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Meine Seite</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
<div class="container">

    <h1 class="welcome">Kredihay Loan Management</h1>
    <ul>
        <li><a href="list">/list</a></li>
        <li><a href="create">/create</a></li>
    </ul>
</div>

<script src="public/js/app.js"></script>
</body>
</html>
