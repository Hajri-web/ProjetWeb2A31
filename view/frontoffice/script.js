document.addEventListener('DOMContentLoaded', function () {
    console.log("Le script JS est bien chargé !");
    const form = document.querySelector('form.user');

    form.addEventListener('submit', function (e) {
        // Réinitialiser les messages d'erreur
        document.getElementById('email_error').textContent = '';
        document.getElementById('password_error').textContent = '';

        let hasError = false;

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!email) {
            document.getElementById('email_error').textContent = 'L\'adresse email est requise';
            hasError = true;
        } else if (!isValidGmail(email)) {
            document.getElementById('email_error').textContent = 'Veuillez entrer une adresse Gmail valide';
            hasError = true;
        }

        if (!password) {
            document.getElementById('password_error').textContent = 'Le mot de passe est requis';
            hasError = true;
        } else {
            passwordErrorElement.innerHTML = 'Correct';
            passwordErrorElement.style.color = 'green';
        }
        if (!isValid) {
            e.preventDefault();
        }
        function isValidGmail(email) {
            const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            return gmailRegex.test(email);
        }
    });
});
