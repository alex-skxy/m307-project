// Javascript
console.info('JS geladen.');

async function submitForm(e, submitUrl, validationUrl, redirectUrl) {
    e.preventDefault();
    const form = document.querySelector('form');
    const data = new FormData(form);

    const res = await fetchValidationResults(data, validationUrl);
    if (res !== 'ok') {
        displayValidationResult(res);
        return false;
    } else {
        const res = await fetch(submitUrl,
            {
                method: 'POST',
                body: data
            });
        console.info('form sent :)');
        window.location.href = redirectUrl;
        return true;
    }
}

async function validateForm() {
    const form = document.querySelector('form');
    const data = new FormData(form);

    const res = await fetchValidationResults(data);
    if (res !== 'ok') {
        displayValidationResult(res);
    }
}

function displayValidationResult(results) {
    alert(Object.values(results).map(result => `❌️${result}`).join('\n'));
}

async function fetchValidationResults(data, validationUrl) {
    const res = await fetch(validationUrl,
        {
            method: 'POST',
            body: data
        });
    const json = await res.json();

    return json;
}

function calculateDate() {
    const daysToAdd = document.getElementById('installments').value * 15;
    let date = new Date(Date.now());
    date.setDate(date.getDate() + daysToAdd);
    return date;
}

function setRepaymentDate() {
    const date = calculateDate().toISOString().substring(0, 10);
    document.getElementById('tbxPayday').value = date;
}
