function addElement() {
    // Clone the element
    const rowOrders = document.querySelectorAll("#row-orders");
    let element = rowOrders[rowOrders.length - 1].cloneNode(true)

    // Clear the selected value of the cloned select elements
    const nameServiceId = element.querySelectorAll('[name="service_id[]"]');
    nameServiceId.forEach((selectElement) => {
        let getIdNow = selectElement.getAttribute('id');
        let cleanNumbering = Number(getIdNow.replace('service_id', '')) + 1;
        selectElement.setAttribute('id', ('service_id' + cleanNumbering.toString()));
        selectElement.setAttribute('onchange', 'serviceShowDefaultVal(\'' + (cleanNumbering.toString()) + '\')');
        selectElement.selectedIndex = 0;
    });

    const nameQuantity = element.querySelectorAll('[name="quantity[]"]');
    nameQuantity.forEach((inputElement) => {
        let getIdNow = inputElement.getAttribute('id');
        let cleanNumbering = Number(getIdNow.replace('quantity', '')) + 1;
        inputElement.setAttribute('id', ('quantity' + cleanNumbering.toString()));
        inputElement.setAttribute('onblur', 'quantityShowPriceVal(\'' + (cleanNumbering.toString()) + '\')');
        inputElement.value = 0;
    });

    const nameSubtotal = element.querySelectorAll('[name="subtotal[]"]');
    nameSubtotal.forEach((inputElement) => {
        let getIdNow = inputElement.getAttribute('id');
        let cleanNumbering = Number(getIdNow.replace('subtotal', '')) + 1;
        inputElement.setAttribute('id', ('subtotal' + cleanNumbering.toString()));
        inputElement.setAttribute('onblur', 'discCouponAndSumSubtotal()');
        inputElement.value = 0;
    });

    // Append the cloned element to the container
    document.getElementById("the-orders").appendChild(element);

    if (document.getElementById("the-orders").offsetHeight >= 259) {
        document.getElementById("the-orders").style.height = "259px";
    }

    let buttonRemove = document.querySelector("#remove-row");
        buttonRemove.removeAttribute('disabled')
}

function removeElement() {
    // Clone the element
    const rowOrders = document.querySelectorAll("#row-orders");
    rowOrders[rowOrders.length - 1].remove()

    if (document.querySelectorAll("#row-orders").length < 3) {
        document.getElementById("the-orders").removeAttribute("style");
    }

    if (document.querySelectorAll("#row-orders").length == 1) {
        let buttonRemove = document.querySelector("#remove-row");
        buttonRemove.setAttribute('disabled', 'disabled')
    }
}

let buttonAdd = document.querySelector("#add-row");
let buttonRemove = document.querySelector("#remove-row");

buttonAdd.addEventListener("click", (e) => {
    e.preventDefault();

    addElement()
});

buttonRemove.addEventListener("click", (e) => {
    e.preventDefault();

    removeElement()
    discCouponAndSumSubtotal()
});

// Customer Input
let customerId = document.getElementById('customer_id');
customerId.addEventListener('change', () => {
    let usePickupSelect = document.getElementById('use_pickup');
    let useDeliverySelect = document.getElementById('use_delivery');
    let shippingFeeInput = document.getElementById('shipping_fee');
    let selectedCustomerId = customerId.options[customerId.selectedIndex].getAttribute('value');

    usePickupSelect.value = ''
    useDeliverySelect.value = ''
    shippingFeeInput.value = 0

    if (selectedCustomerId != '') {
        usePickupSelect.removeAttribute('disabled')
        useDeliverySelect.removeAttribute('disabled')
    }

    discCouponAndSumSubtotal()
})

function serviceShowDefaultVal(numbering) {
    let getServiceId = document.getElementById('service_id' + numbering);
    let getQuantity = document.getElementById('quantity' + numbering);
    let getSubtotal = document.getElementById('subtotal' + numbering);

    if (getServiceId.value != '' && getQuantity.getAttribute('value') == '0') {
        try {
            getQuantity.value = '0'
            getSubtotal.value = '0'
        } catch (error) {
            console.log('Another bug!');
        }
    }
}

function quantityShowPriceVal(numbering) {
    let serviceId = document.getElementById('service_id' + numbering);
    let getServiceId = serviceId.options[serviceId.selectedIndex];
    let getQuantity = document.getElementById('quantity' + numbering);

    if (getServiceId.value != '') {
        try {
            let getPriceService = getServiceId.getAttribute('data-price');
            let getQuantityService = getQuantity.value;
            let calcPrice = (Number(getQuantityService) * Number(getPriceService)).toString();
            let getSubtotal = document.getElementById('subtotal' + numbering);
            // console.log(calcPrice, getPriceService, getQuantityService);
            getSubtotal.value = calcPrice;

            discCouponAndSumSubtotal()
        } catch (error) {
            console.log('Another bug!');
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
