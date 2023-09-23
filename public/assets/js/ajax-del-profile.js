$(document).ready(function() {
    $('#delete-data').on('click', function (e) {
        e.preventDefault()

        Swal.fire({
            title: 'Are you sure?',
            text: `This will permanently reset your account!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset now!'
        }).then((result) => {
            if (result.isConfirmed){
                $('#delete-form-data').submit();
            }
        });
    });
})
