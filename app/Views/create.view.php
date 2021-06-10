<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Create loan</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
<div class="container">
    <h1 class="welcome">Create a new loan</h1>
    <form method="post">
        <fieldset>
            <legend>Personal Information</legend>

            <label for="name">Firstname</label>
            <input type="text" id="name" name="name" placeholder="Firstname" required>

            <label for="lastname">Lastname</label>
            <input type="text" id="lastname" name="lastname" placeholder="Lastname" required>
            <br>

            <label for="email">E-Mail</label>
            <input type="email" id="email" name="email" placeholder="E-Mail" required>

            <label for="phone_number">Phone number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Phone number">
        </fieldset>

        <fieldset>
            <legend>Loan Information</legend>
            <label for="installments">Amount installments</label>
            <input type="number" id="installments" name="installments" placeholder="Amount installments" min="1"
                   max="10" value="1" required>
            <label for="creditpackage">Loan package</label>
            <select id="creditpackage" name="creditpackage" required>
                <?php
                foreach ($creditpackageData as $index => $creditpackage) {
                    echo "<option value='" . $creditpackage["id_creditpackage"] . "'>" . $creditpackage["name"] . "</option>";
                }
                ?>
            </select>
            <br>

            <label for="tbxPayday">Repayment date</label>
            <input type="date" id="tbxPayday" name="Repayment date" placeholder="Repayment date" disabled>
        </fieldset>

        <button type="submit" id="submit-btn">Create Loan</button>
    </form>

    <button type="reset" onclick="location.href='<?= ROOT_URL . "/list" ?>'">Cancel</button>

</div>

<script src="public/js/app.js"></script>
<script>
    window.addEventListener('load', () => {
        document.querySelector('form').addEventListener('submit', async e => {
            return await submitForm(e, '<?= ROOT_URL ?>/create', '<?= ROOT_URL ?>/validate?q=create', '<?php echo ROOT_URL ?>/list');
        });
        setRepaymentDate()
        document.querySelector('#installments').addEventListener('onchange', e => {
            setRepaymentDate()
        })
    });
</script>
</body>
</html>
