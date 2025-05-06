<?php
include_once(__DIR__ . '/../../controller/usercontroller.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recherche utilisateurs</title>
</head>
<body>
    <h1>Recherche</h1>
    <input type="text" id="searchInput" placeholder="ID, Nom ou Rôle" autocomplete="off">

    <h2>Résultats :</h2>
    <table border="1" id="resultsTable" style="display:none;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Genre</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody id="resultsBody">
        </tbody>
    </table>
    <p id="noResultsMessage" style="display:none;">Aucun utilisateur trouvé.</p>

    <script>
        const searchInput = document.getElementById('searchInput');
        const resultsTable = document.getElementById('resultsTable');
        const resultsBody = document.getElementById('resultsBody');
        const noResultsMessage = document.getElementById('noResultsMessage');

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length === 0) {
                resultsTable.style.display = 'none';
                noResultsMessage.style.display = 'none';
                resultsBody.innerHTML = '';
                return;
            }

            fetch('searchUsersAjax.php?search=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    resultsBody.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(user => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${user.id}</td>
                                <td>${user.nom}</td>
                                <td>${user.prenom}</td>
                                <td>${user.gmail || user.email || ''}</td>
                                <td>${user.genre || ''}</td>
                                <td>${user.role || user.Role || ''}</td>
                            `;
                            resultsBody.appendChild(row);
                        });
                        resultsTable.style.display = '';
                        noResultsMessage.style.display = 'none';
                    } else {
                        resultsTable.style.display = 'none';
                        noResultsMessage.style.display = '';
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                    resultsTable.style.display = 'none';
                    noResultsMessage.style.display = 'none';
                    resultsBody.innerHTML = '';
                });
        });
    </script>
</body>
</html>
