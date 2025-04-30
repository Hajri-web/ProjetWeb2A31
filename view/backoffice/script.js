document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form.user'); // Select form by class "user"
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const titleElement = document.getElementById('title');
    const destinationElement = document.getElementById('destination');

    function isValidGmail(email) {
        // Regex to check if email is a valid Gmail address
        const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        return gmailRegex.test(email);
    }
    form.addEventListener('submit', function (event) {
        let isValid = true;

        // Email validation (existing)
        const emailErrorElement = document.getElementById('email_error');
        const email = emailInput.value.trim();
        if (!isValidGmail(email)) {
            emailErrorElement.innerHTML = 'Please enter a valid Gmail address.';
            emailErrorElement.style.color = 'red';
            emailInput.focus();
            isValid = false;
        } else {
            emailErrorElement.innerHTML = 'Correct';
            emailErrorElement.style.color = 'green';
        }

        // Password validation (existing)
        const passwordErrorElement = document.getElementById('password_error');
        const password = passwordInput.value.trim();
        if (password === '') {
            passwordErrorElement.innerHTML = 'Password cannot be empty.';
            passwordErrorElement.style.color = 'red';
            passwordInput.focus();
            isValid = false;
        } else {
            passwordErrorElement.innerHTML = 'Correct';
            passwordErrorElement.style.color = 'green';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
