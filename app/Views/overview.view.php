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
            <th>Installments</th>
            <th>Credit package</th>
            <th>Paid back</th>
            <th>Pay back until</th>
        </tr>
        <?php
        foreach ($result as $loan) {
            ?>
            <tr>
                <td><?= e($loan['firstname']) ?></td>
                <td><?= e($loan['lastname']) ?></td>
                <td><?= e($loan['email']) ?></td>
                <td><?= e($loan['installments']) ?></td>
                <td><?= e($loan['credit_package']) ?></td>
                <td><?= e($loan['paid_back']) ?></td>
                <td><?= e($loan['payback_date']) ?></td>
            </tr>
        <?php } ?>
    </table>

</div>

<script src="public/js/app.js"></script>
</body>
</html>
