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

        <button type="submit" id="submit-btn">Save Loan</button>
    </form>

    <button type="reset" onclick="location.href='<?= ROOT_URL . "/list" ?>'">Cancel</button>

</div>

<script src="public/js/app.js"></script>
<script>
    window.addEventListener('load', () => {
        document.querySelector('form').addEventListener('submit', async e => {
            return await submitForm(e);
        });
    });

    async function submitForm(e) {
        e.preventDefault();
        const form = document.querySelector('form');
        const data = new FormData(form);

        const res = await fetchValidationResults(data);
        if (res !== 'ok') {
            displayValidationResult(res);
            return false;
        } else {
            const res = await fetch('<?= ROOT_URL ?>/edit',
                {
                    method: 'POST',
                    body: data
                });
            console.log('form sent :)');
            window.location.href = '<?= ROOT_URL ?>';
            return true;
        }
    }

    async function validateForm() {
        const form = document.querySelector('form');
        const data = new FormData(form);
        console.log(data.get('name'));
        console.log(data);

        const res = await fetchValidationResults(data);
        console.log(res !== 'ok');
        if (res !== 'ok') {
            displayValidationResult(res);
        }
        console.log(res);
    }

    function displayValidationResult(results) {
        alert(Object.values(results).map(result => `❌️${result}`).join('\n'));
    }

    async function fetchValidationResults(data) {
        const res = await fetch('<?= ROOT_URL ?>/validate?q=edit',
            {
                method: 'POST',
                body: data
            });
        const json = await res.json();

        console.log(json);
        return json;
    }
</script>
</body>
</html>
