
		// Fonction pour récupérer les données des points de fraîcheur depuis l'API OpenDataSoft
function getPointsDeFraicheur() {
    var apiUrl = 'https://opendata.paris.fr/api/records/1.0/search/?dataset=ilots-de-fraicheur-equipements-activites&facet=type&facet=payant&facet=arrondissement&facet=horaires_periode';

    // Effectuez une requête AJAX pour récupérer les données
    var xhr = new XMLHttpRequest();
    xhr.open('GET', apiUrl, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Traitement des données ici
            var response = JSON.parse(xhr.responseText);
            var records = response.records;

            // Créez des marqueurs sur la carte pour afficher les emplacements
            afficherMarqueursSurCarte(records);
        } else {
            console.error('Erreur de requête AJAX : ' + xhr.status);
        }
    };

    xhr.onerror = function () {
        console.error('Erreur de requête AJAX : impossible de se connecter à l\'API.');
    };

    xhr.send();
}

// Fonction pour afficher les marqueurs des points de fraîcheur sur la carte
function afficherMarqueursSurCarte(records) {
    // Créez une instance de carte Google Maps (utilisez votre propre clé API)
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 48.8566, lng: 2.3522 }, // Centrez la carte sur Paris
        zoom: 12 // Niveau de zoom initial
    });

    // Parcourez les enregistrements (records) pour extraire les coordonnées des points de fraîcheur
    for (var i = 0; i < records.length; i++) {
        var record = records[i];
        var fields = record.fields;
        var coordinates = fields.geopoint;

        // Créez un marqueur pour chaque point de fraîcheur
        var marker = new google.maps.Marker({
            position: { lat: coordinates[0], lng: coordinates[1] },
            map: map,
            title: fields.nom // Titre du marqueur (peut être personnalisé)
        });
    }
}

// Lorsque l'utilisateur clique sur le bouton
document.getElementById('showPointsButton').addEventListener('click', function () {
    // Appel de la fonction pour récupérer les points de fraîcheur
    getPointsDeFraicheur();
});
