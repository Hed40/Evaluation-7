
 // Récupérer le conteneur des missions
    let missionsContainer = document.getElementById('missionsSection');

    // Effectuer une requête AJAX pour récupérer les missions par statut
    function getMissionsByStatus(status) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Mettre à jour le contenu du conteneur avec les missions
                    missionsContainer.innerHTML = '';

                    let response = JSON.parse(xhr.responseText);
                    let missions = response.missions;

                    for (let i = 0; i < missions.length; i++) {
                        let mission = missions[i];

                        let missionHtml = `
                            <div>
                                <strong>Status:</strong> ${mission.Status}<br>
                                <strong>Titre:</strong> ${mission.Titre}<br>
                                <strong>Description:</strong> ${mission.Description}<br>
                                <strong>CodeName:</strong> ${mission.CodeName}
                            </div>
                            <hr>
                        `;

                        missionsContainer.innerHTML += missionHtml;
                    }
                } else {
                    console.error('Une erreur s\'est produite lors de la requête AJAX');
                }
            }
        };
        xhr.open('GET', '/missions/' + status);
        xhr.send();
    }

    // Écouter les événements de clic sur les liens de statut
    let statusLinks = document.getElementsByClassName('dropdown-item');
    for (let i = 0; i < statusLinks.length; i++) {
        statusLinks[i].addEventListener('click', function(event) {
            event.preventDefault();
            let status = this.getAttribute('data-status');
            getMissionsByStatus(status);
        });
    }


