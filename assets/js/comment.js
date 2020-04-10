class Comment {
    constructor (html) {
        this.html = html;

        this.url;


        //  document.getElementById(this.html).addEventListener('click', function(e) {
        //     document.getElementById('voilebleu').style.display = 'none';
        //     document.getElementById('formulaire').style.visibility = 'hidden';
        //     document.getElementById('clear').style.visibility='hidden';
        //     document.getElementById('submit_button').style.visibility='hidden';
        // });

    }

    displayMarkers() {
        const requestStations = new Ajax () //Je crée une requête des stations qui est une nouvelle requête Ajax. Elle prendra comme paramètres l'url et la réponse
        
        requestStations.ajaxGet(this.url, (response) => {
            console.log(response);

            let dataStations = JSON.parse(response);
            for (let i=0; i<dataStations.length; i++) {
                let station = dataStations[i] //Je récupère les stations sous forme de tableau
                
                //Je récupère les informations pour l'affichage des markers sur la carte
                let report = station.report;
                let status = station.status;
                let answer = station.answer;


                const reportButtons = document.querySelectorAll(this.html);
                for(let i = 0; i < reportButtons.length; i++) {
                    console.log(reportButtons.length);
                
                    reportButtons[i].addEventListener('click', (e) => {
                        e.preventDefault();
                        console.log('hello');
                        this.url = reportButtons[i].getAttribute('data-href');
                        console.log (this.url);
                        reportButtons[i].innerHTML = report;
                        reportButtons[i].innerHTML = status;
                        reportButtons[i].innerHTML = answer;
                    });
                
                //Au click sur un marker les informations de ce marker s'affichent dans un cadre à côté
                // marker.addEventListener ('click', function(e) {
                //     document.getElementById('infostations').scrollIntoView({behavior: "smooth", block: "start"})
                //     document.getElementById('name_station').innerHTML = name;
                //     document.getElementById('address_station').innerHTML = address;
                //     document.getElementById('bike_stands').innerHTML = bikeStands;
                //     document.getElementById('available_bikes').innerHTML = availableBikes;
                    
                    //J'affiche le statut de la réservation et le bouton de réservation
                        // if (status === 'CLOSED') {
                        //     document.getElementById('status').innerHTML = "La station est fermée.<br>Vous ne pouvez pas effectuer de réservation. Veuillez vous rapprocher d'une autre station.";
                        //     document.getElementById('reservation_button').style.visibility = 'hidden';
                        //     document.getElementById('formulaire').style.visibility = 'hidden';
                        // } if (availableBikes === 0) {
                        //     document.getElementById('status').innerHTML = "Il n'y a pas de vélos disponibles.<br>Vous ne pouvez pas effectuer de réservation. Veuillez vous rapprocher d'une autre station.";
                        //     document.getElementById('reservation_button').style.visibility = 'hidden';
                        //     document.getElementById('formulaire').style.visibility = 'hidden';
                        // } else if (status === 'OPEN' & availableBikes > 0) {
                        //     document.getElementById('status').innerHTML = "Des vélos sont disponibles.<br>Vous pouvez effectuer une réservation.";
                        //     document.getElementById('reservation_button').style.visibility = 'visible';
                        //     document.getElementById('formulaire').style.visibility = 'hidden';
                            
                        // };
                // });

                };
            // this.mapTown.addLayer(markers); //Les marqueurs sont affichés sur la carte
            };
        });
    }
}

const updateComment = new Comment('buttonReportComment');
updateComment.displayMarkers();
