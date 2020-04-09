class Comment {
    constructor (url) {
        this.url = url;//url qui pointe la route à suivre
//au clic sur la corbeille
//requête envoyée pour deleter par l'id au serveur. l'url est celle qui va déterminer l'action à effectuer donc envoyer le delete-report-comment.html?

let obj = document.querySelector("a");
document.write( "<br> Valeur de href : "+ obj.getAttribute("href") ); // on récupère la valeur de 
        // document.getElementById(this.html).addEventListener('click', function(e) {
        //     document.getElementById('voilebleu').style.display = 'none';
        //     document.getElementById('formulaire').style.visibility = 'hidden';
        //     document.getElementById('clear').style.visibility='hidden';
        //     document.getElementById('submit_button').style.visibility='hidden';
        // });

    }

    deleteReportComment() {
        const request = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        
        request.ajaxGet(this.url, (response) => {
            let datas = JSON.parse(response);
            // let markers = L.markerClusterGroup(); //La réponse doit arriver sous forme de regroupement de marqueurs

            // for (let i=0; i<datas.length; i++) {
            //     let station = datas[i]; //Je récupère les stations sous forme de tableau
                
                //Je récupère les informations pour l'affichage des markers sur la carte
                
                //Je récupère les informations pour l'affichage des infos de chaque station
                // let name = station.id;
                // let address = station.address;
                // let status = station.status;
                // let bikeStands = station.bike_stands;
                // let availableBikes = station.available_bikes;

                //Je crée une icône pour chaque marker
                // let iconStation = L.icon({  //Je crée une icône spécifique
                //     iconUrl: 'images/icon/velo8.png',
                //     iconSize: [50, 50],
                //     iconAnchor: [25, 50], //Je déplace l'ancre pour que la pointe arrive sur la rue et non les maisons
                //     popupAnchor: [0, -50], //Je déplace le popup en hauteur
                // });

                //J'affiche les markers
                // let marker = L.marker([x, y], {icon: iconStation});//Je récupère la fonction marker de Leaflet pour intégrer les résultats dans la mapTown
                // markers.addLayer(marker); //J'ajoute le regroupement de marqueur au groupe

                //Au click sur un marker les informations de ce marker s'affichent dans un cadre à côté
                // marker.addEventListener ('click', function(e) {
                //     document.getElementById('infostations').scrollIntoView({behavior: "smooth", block: "start"})
                //     document.getElementById('name_station').innerHTML = name;
                //     document.getElementById('address_station').innerHTML = address;
                //     document.getElementById('bike_stands').innerHTML = bikeStands;
                //     document.getElementById('available_bikes').innerHTML = availableBikes;
                    
                //     //J'affiche le statut de la réservation et le bouton de réservation
                //         if (status === 'CLOSED') {
                //             document.getElementById('status').innerHTML = "La station est fermée.<br>Vous ne pouvez pas effectuer de réservation. Veuillez vous rapprocher d'une autre station.";
                //             document.getElementById('reservation_button').style.visibility = 'hidden';
                //             document.getElementById('formulaire').style.visibility = 'hidden';
                //         } if (availableBikes === 0) {
                //             document.getElementById('status').innerHTML = "Il n'y a pas de vélos disponibles.<br>Vous ne pouvez pas effectuer de réservation. Veuillez vous rapprocher d'une autre station.";
                //             document.getElementById('reservation_button').style.visibility = 'hidden';
                //             document.getElementById('formulaire').style.visibility = 'hidden';
                //         } else if (status === 'OPEN' & availableBikes > 0) {
                //             document.getElementById('status').innerHTML = "Des vélos sont disponibles.<br>Vous pouvez effectuer une réservation.";
                //             document.getElementById('reservation_button').style.visibility = 'visible';
                //             document.getElementById('formulaire').style.visibility = 'hidden';
                            
                //         };
                // });

            // };
            // this.mapTown.addLayer(markers); //Les marqueurs sont affichés sur la carte
        });
    }
};
