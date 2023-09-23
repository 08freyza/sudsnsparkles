$(document).ready(function() {
    let token = $("meta[name='csrf-token']").attr("content");

    $('body').on('click', '#delete-data', function () {
        let url = $(this).data('url');
        let id = $(this).data('id');
        let titlePage = $(this).data('title-page');
        let trObj = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: `You won't be able to revert ${id} data!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: url + "/" + id,
                    type: 'POST',
                    data: {
                        "id":id,
                        "_method": 'DELETE'
                    },
                    success: function(data) {
                        if (data.success == 'deleteSuccess') {
                            swal.fire({
                                title: `Delete ${id} ${titlePage} Successful`,
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            console.log(response)
                            swal.fire({
                                title: `Delete ${id} ${titlePage} Failed`,
                                icon: "error",
                            });
                        }
                    }
                })
                .done(function(response){

                })
                .fail(function(){
                    swal.fire({
                        title: 'Opps..!',
                        text: 'Something went wrong! Call your administrator to fix this problem!',
                        icon: "error",
                    });
                });
            }
        });
    });
})
