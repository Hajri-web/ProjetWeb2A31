document.addEventListener('DOMContentLoaded', function () {
    console.log("Le script JS est bien chargé !");
    const form = document.querySelector('form.user');

    form.addEventListener('submit', function (e) {
        // Réinitialiser les erreurs
        document.getElementById('firstName_error').textContent = '';
        document.getElementById('lastName_error').textContent = '';
        document.getElementById('email_error').textContent = '';
        document.getElementById('password_error').textContent = '';
        document.getElementById('repeatPassword_error').textContent = '';

        let hasError = false;

        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const repeatPassword = document.getElementById('repeatPassword').value.trim();

        if (!firstName) {
            document.getElementById('firstName_error').textContent = 'Le prénom est requis';
            hasError = true;
        } else if (!/^[A-Z]/.test(firstName)) {
            document.getElementById('firstName_error').textContent = 'Le prénom doit commencer par une majuscule';
            hasError = true;
        }

        if (!lastName) {
            document.getElementById('lastName_error').textContent = 'Le nom est requis';
            hasError = true;
        } else if (!/^[A-Z]/.test(lastName)) {
            document.getElementById('lastName_error').textContent = 'Le nom doit commencer par une majuscule';
            hasError = true;
        }

        if (!email) {
            document.getElementById('email_error').textContent = 'L\'adresse email est requise';
            hasError = true;
        } else if (!validateEmail(email)) {
            document.getElementById('email_error').textContent = 'Format d\'adresse email invalide';
            hasError = true;
        }

        if (!password) {
            document.getElementById('password_error').textContent = 'Le mot de passe est requis';
            hasError = true;
        }
        else if (!isStrongPassword(password)) {
            document.getElementById('password_error').textContent = 'Le mot de passe doit contenir au moins 8 caractères, avec des lettres et des chiffres';
            hasError = true;
        }
        if (!repeatPassword) {
            document.getElementById('repeatPassword_error').textContent = 'Veuillez répéter le mot de passe';
            hasError = true;
        } else if (password !== repeatPassword) {
            document.getElementById('repeatPassword_error').textContent = 'Les mots de passe ne correspondent pas';
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); // Empêche la soumission du formulaire
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    function isStrongPassword(password) {
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return passwordRegex.test(password);
    }
});
