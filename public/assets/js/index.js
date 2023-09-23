// initMap is now async
function initMap() {
    const bounds = new google.maps.LatLngBounds();
    const markersArray = [];
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -6, lng: 106 },
        zoom: 10,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
    });
    // initialize services
    const geocoder = new google.maps.Geocoder();
    const service = new google.maps.DistanceMatrixService();
    // build request
    const origin = { lat: -6.242726793129511, lng: 106.85510337352753 };
    const destination = { lat: -6.290104984995477, lng: 106.89973408069223 };
    const request = {
        origins: [origin],
        destinations: [destination],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: true,
        avoidTolls: true,
    };

    // put request on page
    document.getElementById("request").innerText = JSON.stringify(
        request,
        null,
        2
    );
    // get distance matrix response
    service.getDistanceMatrix(request).then((response) => {
        // put response
        document.getElementById("response").innerText = JSON.stringify(
            response,
            null,
            2
        );

        // show on map
        const originList = response.originAddresses;
        const destinationList = response.destinationAddresses;

        deleteMarkers(markersArray);

        const showGeocodedAddressOnMap = (asDestination) => {
            const handler = ({ results }) => {
                bounds.extend(results[0].geometry.location);
                map.fitBounds(bounds);
                markersArray.push(
                new google.maps.Marker({
                    map,
                    position: results[0].geometry.location,
                    label: asDestination ? "D" : "O",
                })
                );
            };
            return handler;
        };

        for (let i = 0; i < originList.length; i++) {
            const results = response.rows[i].elements;

            geocoder
                .geocode({ address: originList[i] })
                .then(showGeocodedAddressOnMap(false))
                .catch((error) => {
                    console.error("Geocode error: " + error);
                });

            for (let j = 0; j < results.length; j++) {
                geocoder
                    .geocode({ address: destinationList[j] })
                    .then(showGeocodedAddressOnMap(true))
                    .catch((error) => {
                        console.error("Geocode error: " + error);
                    });
            }
        }
    });
}

function deleteMarkers(markersArray) {
    for (let i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
    }

    markersArray = [];
}

window.initMap = initMap;

