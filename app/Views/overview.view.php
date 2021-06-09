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

    <h1 class="welcome">Loan overview</h1>

    <table>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>E-Mail</th>
            <th>Phone number</th>
            <th>Installments</th>
            <th>Credit package</th>
            <th>Pay back until</th>
            <th>Due</th>
            <th></th>
        </tr>
        <?php
        foreach ($result as $loan) {
            ?>
            <tr>
                <td><?= e($loan['name']) ?></td>
                <td><?= e($loan['lastname']) ?></td>
                <td><?= e($loan['email']) ?></td>
                <td><?= isset($loan['phone_number']) ? e($loan['phone_number']) : '' ?></td>
                <td><?= e($loan['installments']) ?></td>
                <td><?= e($loan['credit_package']) ?></td>
                <td><?= e($loan['payback_date']) ?></td>
                <td><?= $loan['due'] == 0 ? '&#127774;' : '&#9889;' ?></td>
                <td>
                    <button onclick="window.location.href='/edit?id=<?= $loan['id_loan'] ?>'">&#x270F;&#xFE0F; edit
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <button onclick="window.location.href='/home">&#127968; Go back home</button>
    <button onclick="window.location.href='/create'">&#10133; Create new loan</button>
</div>

<script src="public/js/app.js"></script>
</body>
</html>
