<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Edit l</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
<div class="container">
    <h1 class="welcome">Edit loan</h1>

    <form method="post">
        <fieldset>
            <legend>Personal Information</legend>

            <label for="name">Firstname</label>
            <input type="text" id="name" name="name" value="<?php echo $result["name"]; ?>">

            <label for="lastname">Lastname</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $result['lastname'] ?>">

            <label for="email">E-Mail</label>
            <input type="text" id="email" name="email" value="<?php echo $result['email'] ?>"><br>

            <label for="phone_number">Phone number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="+41 00 000 00 00"
                   value="<?php echo $result['phone_number'] ?>">
        </fieldset>

        <fieldset>
            <legend>Loan Information</legend>
            <label for="creditpackage">Loan package</label>
            <select id="creditpackage" name="creditpackage">
                <?php
                foreach ($creditpackageData as $index => $creditpackage) {
                    echo "<option value='" . $creditpackage["id_creditpackage"] . "'>" . $creditpackage["name"] . "</option>";
                }
                ?>
            </select>

            <input type="checkbox" id="status" name="paid_back" value="1">
            <label for="checkbox">Status</label>
        </fieldset>

        <button type="submit">Save Loan</button>
    </form>

    <button type="reset" onclick="location.href='<?php echo ROOT_URL . "/list" ?>'">Cancel</button>

</div>

<script src="public/js/app.js"></script>
</body>
</html>
