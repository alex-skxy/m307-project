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
    <form>
        <label for="name">Firstname</label>
        <input type="text" id="name" name="name" placeholder="Firstname">
        <label for="lastname">Lastname</label>
        <input type="text" id="lastname" name="lastname" placeholder="Lastname">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email" placeholder="E-Mail">
        <label for="phone_number">Phone number</label>
        <input type="text" id="phone_number" name="phone_number" placeholder="Phone number">
        <label for="installments">Amount installments</label>
        <input type="text" id="installments" name="installments" placeholder="Amount installments">
        <label for="creditpackage">Loan package</label>
        <select id="creditpackage">
            <?php
            foreach ($creditpackageData as $index => $creditpackage) {
                echo "<option value='" . $creditpackage["id_creditpackage"] . "'>" . $creditpackage["name"] . "</option>";
            }
            ?>
        </select>

        <label for="tbxPayday">Repayment date</label>
        <input type="date" id="tbxPayday" name="Repayment date" placeholder="Repayment date" disabled>


        <button type="reset">Cancel</button>
        <button type="submit">Create Loan</button>
    </form>


</div>

<script src="public/js/app.js"></script>
</body>
</html>
