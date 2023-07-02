// Récupérer le conteneur des missions
let missionsContainer = document.getElementById("missionsSection");

// Effectuer une requête AJAX pour récupérer les missions par statut
function getMissionsByStatut(statut) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Mettre à jour le contenu du conteneur avec les missions
        missionsContainer.innerHTML = "";

        let response = JSON.parse(xhr.responseText);
        let missions = response.missions;

        for (let i = 0; i < missions.length; i++) {
          let mission = missions[i];

          let missionHtml = `
            <div class="form-container">
              <div class="card-header">
                <h5 class="card-title text-center">${mission.Titre}</h5>
              </div>
              <hr>
              <div class="card-body mt-3">
                <div class="row">
                  <div class="col-md-6">
                    <p class="card-text">
                      <strong>Description :</strong>
                      ${mission.Description}
                    </p>
                    <p class="card-text">
                      <strong>Nom de code :</strong>
                      ${mission.CodeName}
                    </p>
                    <p class="card-text">
                      <strong>Pays :</strong>
                      ${mission.Pays}
                    </p>
                    <p class="card-text">
                      <strong>Début :</strong>
                      ${mission.StartDate ? mission.StartDate : ""}
                    </p>
                    <p class="card-text">
                      <strong>Fin :</strong>
                      ${mission.EndDate ? mission.EndDate : ""}
                    </p>
                  </div>
                  <div class="col-md-6">
                    <p class="card-text ${getStatutClass(mission.Statut)}">
                      <strong>Statut :</strong>
                      ${mission.Statut}
                    </p>
                    <p class="card-text">
                      <strong>Agent :</strong>
                      ${mission.Agents}
                    </p>
                    <p class="card-text">
                      <strong>Contacts :</strong>
                      ${mission.Contacts}
                    </p>
                    <p class="card-text">
                      <strong>Spécialité requise :</strong>
                      ${mission.Spécialité}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <hr>
          `;

          missionsContainer.innerHTML += missionHtml;
        }
      } else {
        console.error("Une erreur s'est produite lors de la requête AJAX");
      }
    }
  };
  xhr.open("GET", "/home/" + statut);
  xhr.send();
}

// Écouter les événements de clic sur les liens de statut
let statutLinks = document.getElementsByClassName("dropdown-item");
for (let i = 0; i < statutLinks.length; i++) {
  statutLinks[i].addEventListener("click", function (event) {
    event.preventDefault();
    let statut = this.getAttribute("data-statut");
    getMissionsByStatut(statut);
  });
}

function getStatutClass(statut) {
  switch (statut) {
    case "En attente":
      return "statut-pending";
    case "En cours":
      return "statut-in-progress";
    case "Terminée":
      return "statut-completed";
    case "Annulée":
      return "statut-deleted";
    default:
      return "";
  }
}


