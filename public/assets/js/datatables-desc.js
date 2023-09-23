let jquery_datatable = $("#table1").DataTable({
    language: {
        search: "",
        sLengthMenu: "_MENU_",
        sInfo: "_START_ - _END_ Data / _TOTAL_ Data",
        infoEmpty: "0 - 0 Data / 0 Data",
        infoFiltered: "",
        zeroRecords: "Sorry, no matching records found",
        paginate: {
            previous: "Back"
        },
    },
    order: [[0, 'desc']]
})

document.querySelector('.dataTables_length').parentElement.classList.add('mb-2')
document.querySelector('#table1_filter').parentElement.classList.add('mb-2')
document.querySelector('.dataTables_info').parentElement.classList.add('mb-2')
document.querySelector('.dataTables_info').parentElement.classList.add('pe-0')
document.querySelector('.dataTables_paginate').parentElement.classList.add('mb-2')
document.querySelector('.dataTables_paginate').parentElement.classList.add('ps-0')

let table1LengthId = $('#table1_length')
let table1FilterId = $('#table1_filter')
let table1InfoId = $('#table1_info')
let table1PaginateId = $('#table1_paginate')

let table1Filter = $('#table1_filter label')
let table1FilterInput = $('#table1_filter label input')
let table1LengthSelect = $('#table1_length label select')
let table1PaginateUl = $('#table1_paginate ul')

table1Filter.addClass('form-group position-relative has-icon-left mb-0')
table1FilterInput.removeClass('form-control-sm')
table1FilterInput.addClass('ms-0 px-3')
table1FilterInput.attr('placeholder', 'Search')

table1LengthSelect.removeClass('form-select-sm')
table1PaginateUl.addClass('paginate-primary mt-2 mb-1')
// table1LengthId.parent().attr('class', 'ps-sm-0 ps-none col-xs-12 col-sm-6 mb-sm-0 mb-2')
// table1FilterId.parent().attr('class', 'pe-sm-0 pe-none col-xs-12 col-sm-6')
// table1LengthId.addClass('text-sm-start text-center')
// table1FilterId.addClass('text-sm-end text-center')
// table1InfoId.parent().attr('class', 'ps-sm-0 ps-none col-xs-12 col-sm-5 mb-sm-0 mb-2')
// table1PaginateId.parent().attr('class', 'pe-sm-0 pe-none col-xs-12 col-sm-7')
// table1InfoId.addClass('text-sm-start text-center')
table1InfoId.addClass('pt-2 pb-1 mt-2 mb-1')
// table1PaginateId.addClass('float-sm-end float-center')
