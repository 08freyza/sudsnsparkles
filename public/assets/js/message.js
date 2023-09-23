const message = document.getElementById("message-notify");
const messageEditProfile = document.getElementById("message-notify-frontend-edit-profile");

if (message) {
    if (message.innerHTML.trim() === "registrationSuccess") {
        Swal.fire({
            title: "Registration Successful",
            text: "Please login to your account",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "wrongPassword") {
        Swal.fire({
            title: "Login Gagal",
            text: "Password yang anda masukkan salah",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "signInNotValid") {
        Swal.fire({
            title: "Login Failed",
            text: "Your username, your email or your password is not valid",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "signInSuccess") {
        Swal.fire({
            title: "Login Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "profileUpdateSuccess") {
        Swal.fire({
            title: "Update Profile Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "profileUpdateFailed") {
        Swal.fire({
            title: "Update Profile Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "addressUpdateSuccess") {
        Swal.fire({
            title: "Update Address Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "addressUpdateFailed") {
        Swal.fire({
            title: "Update Address Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "changePasswordSuccess") {
        Swal.fire({
            title: "Change Password Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "changePasswordFailed") {
        Swal.fire({
            title: "Change Password Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "oldPasswordWrong") {
        Swal.fire({
            title: "Old Password Wrong",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "customerCreateSuccess") {
        Swal.fire({
            title: "Create Service Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "customerCreateFailed") {
        Swal.fire({
            title: "Create Service Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "customerUpdateSuccess") {
        Swal.fire({
            title: "Update Service Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "customerUpdateFailed") {
        Swal.fire({
            title: "Update Service Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "customerDeleteFailed") {
        Swal.fire({
            title: "Delete Service Success",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "serviceCreateSuccess") {
        Swal.fire({
            title: "Create Service Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "serviceCreateFailed") {
        Swal.fire({
            title: "Create Service Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "serviceUpdateSuccess") {
        Swal.fire({
            title: "Update Service Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "serviceUpdateFailed") {
        Swal.fire({
            title: "Update Service Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "serviceDeleteFailed") {
        Swal.fire({
            title: "Delete Service Success",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "serviceCategoryCreateSuccess") {
        Swal.fire({
            title: "Create Service Category Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "serviceCategoryCreateFailed") {
        Swal.fire({
            title: "Create Service Category Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "serviceCategoryUpdateSuccess") {
        Swal.fire({
            title: "Update Service Category Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "serviceCategoryUpdateFailed") {
        Swal.fire({
            title: "Update Service Category Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "orderCreateSuccess") {
        Swal.fire({
            title: "Create Order Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "orderCreateFailed") {
        Swal.fire({
            title: "Create Order Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "orderDetailsCreateFailed") {
        Swal.fire({
            title: "Create Order Detail Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "orderUpdateSuccess") {
        Swal.fire({
            title: "Data Order Updated Successfully",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "orderUpdateFailed") {
        Swal.fire({
            title: "Data Order Updated Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "orderUpdatePayCashFailed") {
        Swal.fire({
            title: "Cash Payment Failed",
            text: "Your payment is lower than your bill!",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "orderUpdatePayCashFailed") {
        Swal.fire({
            title: "Cash Payment Failed",
            text: "Your payment is lower than your bill!",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "orderCancelSuccess") {
        Swal.fire({
            title: "Cancel Data Order Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "orderCancelFailed") {
        Swal.fire({
            title: "Cancel Data Order Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "uploadAndSaveImageSuccess") {
        Swal.fire({
            title: "Image Uploaded Successfully",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "saveImageFailed") {
        Swal.fire({
            title: "Save Image Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "uploadImageFailed") {
        Swal.fire({
            title: "Upload Image Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "uploadImageError") {
        Swal.fire({
            title: "Oops!",
            text: 'Something went wrong!',
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "OldImageDoesntExist") {
        Swal.fire({
            title: "Your Old Image Doesn't Exist",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "AccountDeletedSuccessful") {
        Swal.fire({
            title: "Reset Account Successful",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "AccountDeletedFailed") {
        Swal.fire({
            title: "Reset Account Failed",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "sendEmailForgotPasswordSuccessful") {
        Swal.fire({
            title: "Send Request Successfully",
            text: "Request has been sent to your email.",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "emailInvalid") {
        Swal.fire({
            title: "Email Invalid!",
            text: "Make sure that your email account is exist.",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "sendEmailForgotPasswordFailed") {
        Swal.fire({
            title: "Send Request Failed",
            text: "Looks like your request cannot be processed now.",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "passwordChangeSuccessful") {
        Swal.fire({
            title: "Password Changed Successfully",
            text: "Let's login to your account now.",
            icon: "success",
        });
    } else if (message.innerHTML.trim() === "passwordChangeFailed") {
        Swal.fire({
            title: "Password Changed Failed",
            text: "Sorry, your changes cannot be processed now.",
            icon: "error",
        });
    } else if (message.innerHTML.trim() === "tokenInvalid") {
        Swal.fire({
            title: "Token Invalid",
            text: "Your token is invalid.",
            icon: "error",
        });
    } else {
        // Swal.fire({
        //     title: "Logout Berhasil",
        //     icon: "success",
        // });
    }
} else if (messageEditProfile) {
    if (messageEditProfile.innerHTML.trim() === "successEditProfile") {
        Swal.fire({
            title: "Edit Profil Berhasil",
            icon: "success",
        });
    }
}

const messageSpecial = document.getElementById("message-notify");
const messageAdd = document.getElementById("message-notify-add");
if (messageSpecial) {
    if (messageSpecial.innerHTML.trim() === "orderUpdateSuccessSpecial") {
        if (messageAdd) {
            Swal.fire({
                title: "Your order has been paid!",
                text: "Your Change is " + messageAdd.innerHTML + ".",
                icon: "success",
            });
        }
    }
}
