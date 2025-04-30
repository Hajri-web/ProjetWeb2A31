document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addUserForm');

    form.addEventListener('submit', function (e) {
        ['nom', 'prenom', 'genre', 'email', 'password'].forEach(id => {
            const errorSpan = document.getElementById(id + '_error');
            if (errorSpan) errorSpan.textContent = '';
        });

        let hasError = false;

        const nom = document.getElementById('nom').value.trim();
        const prenom = document.getElementById('prenom').value.trim();
        const genre = document.getElementById('genre').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!nom) {
            document.getElementById('nom_error').textContent = 'Le nom est requis';
            hasError = true;
        } else if (!/^[A-Z]/.test(nom)) {
            document.getElementById('nom_error').textContent = 'Le nom doit commencer par une majuscule';
            hasError = true;
        }

        if (!prenom) {
            document.getElementById('prenom_error').textContent = 'Le prénom est requis';
            hasError = true;
        } else if (!/^[A-Z]/.test(prenom)) {
            document.getElementById('prenom_error').textContent = 'Le prénom doit commencer par une majuscule';
            hasError = true;
        }

        if (!genre) {
            document.getElementById('genre_error').textContent = 'Le genre est requis';
            hasError = true;
        }

        if (!email) {
            document.getElementById('email_error').textContent = 'L\'email est requis';
            hasError = true;
        } else if (!validateEmail(email)) {
            document.getElementById('email_error').textContent = 'Format d\'email invalide';
            hasError = true;
        }

        if (!password) {
            document.getElementById('password_error').textContent = 'Le mot de passe est requis';
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); // Bloque la soumission du formulaire
        }
    });

    function validateEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }
});
