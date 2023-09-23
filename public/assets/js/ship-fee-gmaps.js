function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -6, lng: 106 },
        zoom: 10,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
    });

    // build request
    let origin = { lat: -6.242726793129511, lng: 106.85510337352753 };
    let destination = { lat: -6.2795863570109605, lng: 106.87973272896001 };

    // working with request and response
    getRequestResponseMap(origin, destination, 0, map)

    // value change on use pickup and use delivery
    let getPickup = document.getElementById('use_pickup');
    let getDelivery = document.getElementById('use_delivery');

    getPickup.addEventListener('change', () => {
        fetchDataNow(getPickup, getDelivery, origin, destination, map)
    })
    // value change on use delivery
    getDelivery.addEventListener('change', () => {
        fetchDataNow(getPickup, getDelivery, origin, destination, map)
        discCouponAndSumSubtotal()
    })
}

function getRequestResponseMap(origin, destination, basicFee = 0, map) {
    // initialize services
    const bounds = new google.maps.LatLngBounds();
    const geocoder = new google.maps.Geocoder();
    const service = new google.maps.DistanceMatrixService();
    const markersArray = [];

    // working with request and response
    let request = {
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
        let theResponse = JSON.stringify(
            response,
            null,
            2
        );

        // put response
        document.getElementById("response").innerText = theResponse;

        // console.log(JSON.parse(theResponse), basicFee);
        // estimation fee
        feeShippingCalc(JSON.parse(theResponse), basicFee);

        discCouponAndSumSubtotal()

        // show on map
        let originList = response.originAddresses;
        let destinationList = response.destinationAddresses;

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
                    let errorTypeZeroResult = 'zero_results';
                    let messageError = error.message.toLowerCase();

                    if (messageError.includes(errorTypeZeroResult.toLowerCase())) {
                        console.log("It's okay. Just bug originate from google!");
                    } else {
                        console.error("Geocode error: " + error);
                    }
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

function fetchDataNow(pickup, delivery, origin, destination, map) {
    let customerId = document.getElementById('customer_id');
    let selectedCustomerId = customerId.options[customerId.selectedIndex].getAttribute('value');
    let getUrl = document.getElementById('geturl').getAttribute('data-url');
    let getValPickup = pickup.options[pickup.selectedIndex].getAttribute('value');
    let getValDelivery = delivery.options[delivery.selectedIndex].getAttribute('value');

    if (selectedCustomerId != '' && (getValPickup == 'Y' || getValDelivery == 'Y')) {
        // request data
        fetch(getUrl + '/get-customer/' + selectedCustomerId)
            .then((response) => response.json())
            .then((data) => {
                if (data.success == 'getInfoSuccess') {
                    let getDataOrigin = { lat: Number(data.origin.latitude), lng: Number(data.origin.longitude) };
                    let getDataDestination = { lat: Number(data.destination.latitude), lng: Number(data.destination.longitude) };
                    let basicFee = data.feePerKilo;

                    // working with request and response
                    getRequestResponseMap(getDataOrigin, getDataDestination, basicFee, map)
                } else {
                    swal.fire({
                        title: 'Opps..!',
                        text: 'Customer or Admin does not set the map position. Please set first!',
                        icon: "error",
                    })
                    if (getValPickup == 'Y') {
                        pickup.value = 'N'
                    } else {
                        delivery.value = 'N'
                    }
                }
            });
    } else {
        // working with request and response
        getRequestResponseMap(origin, destination, 0, map)
    }
}

function feeShippingCalc(response, basicFee = 0) {
    let getPickup = document.getElementById('use_pickup');
    let getDelivery = document.getElementById('use_delivery');
    let getValPickup = getPickup.options[getPickup.selectedIndex].getAttribute('value');
    let getValDelivery = getDelivery.options[getDelivery.selectedIndex].getAttribute('value');
    let shippingInput = document.getElementById('shipping_fee');

    let getData = response['rows'][0].elements[0];
    if (getData.status == 'OK') {
        let getDistance = getData.distance.value / 1000;
        let calcNow = getDistance * basicFee;
        let roundNow = Math.round(calcNow / 1000) * 1000;

        if (getValPickup == 'Y' && getValDelivery == 'Y') {
            let doubleIt = roundNow * 2;
            // console.log(doubleIt);
            shippingInput.value = doubleIt
        } else {
            // console.log(roundNow);
            shippingInput.value = roundNow
        }
    }
}

function mainCalculation() {
    var arrSubtotal = []
    let getAllSubtotal = document.querySelectorAll('[name="subtotal[]"]');
    let sum = 0;

    // calculate sum using forEach() method
    getAllSubtotal.forEach((subtotal) => {
        arrSubtotal.push(Number(subtotal.value));
    })

    arrSubtotal.forEach(num => {
        sum += num;
    })

    return sum;
}

function calcDiscCoupon() {
    let getTotal = mainCalculation();
    let getDiscount = document.getElementById('discount');
    let getLengthOrderData = document.getElementById('length').value;
    let getShippingFee = document.getElementById('shipping_fee').value;
    let totalDisc = 0;

    if (Number(getLengthOrderData) % 5 == 0) {
        let result = 25 * (Number(getTotal) + Number(getShippingFee)) / 100;
        totalDisc += Math.round(result);
    }

    getDiscount.value = totalDisc;
}

function sumSubtotal() {
    let getSubtotalOrder = document.getElementById('subtotal_order');
    let getShippingFee = document.getElementById('shipping_fee').value;
    let getDiscount = document.getElementById('discount').value;
    let getTotal = document.getElementById('total');
    let sum = mainCalculation();

    // sum subtotal
    getSubtotalOrder.value = sum

    // total
    let sumAllCalc = sum + Number(getShippingFee) - Number(getDiscount);
    getTotal.value = sumAllCalc
}

function discCouponAndSumSubtotal() {
    calcDiscCoupon()
    sumSubtotal()
}

function deleteMarkers(markersArray) {
    for (let i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
    }

    markersArray = [];
}

window.initMap = initMap;
