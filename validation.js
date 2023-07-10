

document.querySelector('#Username').addEventListener('blur', validateName);
document.querySelector('#Email').addEventListener('blur', validateEmail);
document.querySelector('#Password').addEventListener('blur', validatePass);

function validateName(e) {
    const Name = document.querySelector('#Username');
    if (Name.value == "") {
        Name.classList.add('is-invalid');
        Name.classList.remove('is-valid');
        return false;
    }
    else if (Name.value != "") {
        Name.classList.remove('is-invalid');
        Name.classList.add('is-valid');
        return true;
    }
}
function validateEmail(e) {
    const email = document.querySelector('#Email');
    if (email.value == "") {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        return false;
    }
    else if (email.value != "") {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
        return true;
    }
}
function validatePass(e) {
    const pass = document.querySelector('#Password');
    if (pass.value == "") {
        pass.classList.add('is-invalid');
        pass.classList.remove('is-valid');
        return false;
    }
    else if (pass.value != "") {
        pass.classList.remove('is-invalid');
        pass.classList.add('is-valid');
        return true;
    }
}

(function () {

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    for (let form of forms) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity() || !validateName() || !validateEmail() || !validatePass()) {
                event.preventDefault()
                event.stopPropagation()
            }
            else {
                form.classList.add('was-validated');
            }
        },
            false
        );
    }
})();

