//  @license
//  Copyright 2019 Google LLC. All Rights Reserved.
//  SPDX-License-Identifier: Apache-2.0

let map

let currLat = document.getElementById("latlng").getAttribute("data-lat")
let currLng = document.getElementById("latlng").getAttribute("data-lng")
let textLat = document.getElementById("latitude")
let textLng = document.getElementById("longitude")
let resetPos = document.getElementById('reset-position');

// initMap is now async
async function initMap() {
    // Initiate
    const myLatlng = { lat: Number(currLat), lng: Number(currLng) }
    const locationButton = document.createElement("button");
    textLat.setAttribute('value', currLat)
    textLng.setAttribute('value', currLng)

    // Request libraries when needed, not in the script tag.
    const { Map } = await google.maps.importLibrary("maps")
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker")

    // Short namespaces can be used.
    map = new Map(document.getElementById("map"), {
        center: myLatlng,
        zoom: 18,
        mapId: "DEMO_MAP_ID",
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
    })

    // Get Position Point
    let infoWindow = new google.maps.InfoWindow({
        content: "Click the map to get Lat/Lng!",
        position: myLatlng,
    })
    let marker = new AdvancedMarkerElement({
        map: map,
        position: myLatlng,
    });

    marker.setMap(map)

    // Click Add Listener
    map.addListener("click", (mapsMouseEvent) => {
        // Close the current position
        marker.setMap(null)

        // Create a new marker
        marker = new AdvancedMarkerElement({
            map: map,
            position: mapsMouseEvent.latLng,
        });

        // Create a new info window
        infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
        });
        infoWindow.setContent(
            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        );

        // Set Text
        let setNewText = JSON.parse(JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2))
        textLat.setAttribute('value', setNewText.lat.toString())
        textLng.setAttribute('value', setNewText.lng.toString())

        // Open infoWindow Again
        marker.setMap(map)
        map.panTo(mapsMouseEvent.latLng)
    })

    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

    locationButton.addEventListener("click", (e) => {
        e.preventDefault()
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                // Close the current position
                marker.setMap(null)

                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Create a new marker
                marker = new AdvancedMarkerElement({
                    map: map,
                    position: pos,
                });

                textLat.setAttribute('value', pos.lat.toString())
                textLng.setAttribute('value', pos.lng.toString())

                marker.setMap(map)
                map.panTo(pos)
                },
                () => {
                    handleLocationError(true, marker, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, marker, map.getCenter());
        }
    });


    if (resetPos) {
        resetPos.addEventListener('click', (e) => {
            e.preventDefault()

            textLat.setAttribute('value', "")
            textLng.setAttribute('value', "")

            marker.setMap(null)

            swal.fire({
                title: 'Reset Success!',
                icon: "success",
            })
        })
    }
}

function handleLocationError(browserHasGeolocation, marker, pos) {
    let showError =
        browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."

    swal.fire({
        title: 'Opps..!',
        text: showError,
        icon: "error",
    })

    marker.setMap(map)
    map.panTo(pos)
}

initMap()
