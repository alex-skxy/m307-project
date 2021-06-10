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
            <input type="text" id="name" name="name" placeholder="Firstname">

            <label for="lastname">Lastname</label>
            <input type="text" id="lastname" name="lastname" placeholder="Lastname">
            <br>

            <label for="email">E-Mail</label>
            <input type="text" id="email" name="email" placeholder="E-Mail">

            <label for="phone_number">Phone number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Phone number">
        </fieldset>

        <fieldset>
            <legend>Loan Information</legend>
            <label for="installments">Amount installments</label>
            <input type="number" id="installments" name="installments" placeholder="Amount installments" min="1"
                   max="10" onchange="setRepaymentDate()" value="1">
            <label for="creditpackage">Loan package</label>
            <select id="creditpackage" name="creditpackage">
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
    <button type="reset" onclick="location.href='<?= ROOT_URL ?>'">Cancel</button>

</div>

<script src="public/js/app.js"></script>
<script>
    window.addEventListener('load', () => {
        document.querySelector('form').addEventListener('submit', async e => {
            return await submitForm(e);
        });
    });

    async function submitForm(e) {
        const form = document.querySelector('form');
        const data = new FormData(form);

        const res = await fetchValidationResults(data);
        if (res !== 'ok') {
            displayValidationResult(res);
            e.preventDefault();
            return false;
        } else {
            console.log('form sent :)');
            return true;
        }
    }

    function calculateDate() {
        const daysToAdd = document.getElementById('installments').value * 15;
        let date = new Date(Date.now());
        date.setDate(date.getDate() + daysToAdd);
        console.log(date);
        return date;
    }

    function setRepaymentDate() {
        const date = calculateDate().toISOString().substring(0, 10);
        console.log(date);
        document.getElementById('tbxPayday').value = date;
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
        const res = await fetch('/validate?q=create',
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
