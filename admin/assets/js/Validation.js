document.querySelector('#Email').addEventListener('blur',validateEmail);
document.querySelector('#Password').addEventListener('blur',validatePass);
const reSpaces=/^\S*$/;
function validateEmail(e)
{
    const email = document.querySelector('#Email');
    const re = /^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/;
    if(email.value == "")
    {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        return false;
    }
    else if(reSpaces.test(email.value) && email.value != "" && re.test(email.value) )
    {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
        return true;
    }
}
function validatePass(e)
{
    const pass = document.querySelector('#Password');
    const re = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})(?=.*[!@#$%^&*])/;
    if(pass.value == "")
    {
        pass.classList.add('is-invalid');
        pass.classList.remove('is-valid');
        return false;
    }
    else if(reSpaces.test(pass.value) && pass.value != "" && re.test(pass.value) )
    {
        pass.classList.remove('is-invalid');
        pass.classList.add('is-valid');
        return true;
    }
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    for(let form of forms){
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity() || !validateEmail() || !validatePass()) {
            event.preventDefault()
            event.stopPropagation()
          }
         else{
          form.classList.add('was-validated');
         }
        }, 
        false
      );
    }
  })();