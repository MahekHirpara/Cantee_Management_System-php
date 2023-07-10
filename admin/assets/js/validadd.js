document.querySelector('#name').addEventListener('blur',validateName);
document.querySelector('#price').addEventListener('blur',validatePrice);
document.querySelector('#discription').addEventListener('blur',validateDiscription);
document.querySelector('#image').addEventListener('blur',validateimage);
document.querySelector('#ctg').addEventListener('blur',validateCtg);
document.querySelector('#type').addEventListener('blur',validateType);

function validateName(e)
{
  const Name = document.querySelector('#name');
    if(Name.value == "")
    {
      Name.classList.add('is-invalid');
      Name.classList.remove('is-valid');
        return false;
    }
    else if(Name.value != "")
    {
      Name.classList.remove('is-invalid');
      Name.classList.add('is-valid');
        return true;
    }
}
function validatePrice(e)
{
  const Price = document.querySelector('#price');
    if(Price.value == "")
    {
      Price.classList.add('is-invalid');
      Price.classList.remove('is-valid');
        return false;
    }
    else if(Price.value != "")
    {
      Price.classList.remove('is-invalid');
      Price.classList.add('is-valid');
        return true;
    }
}
function validateDiscription(e)
{
  const Discription = document.querySelector('#discription');
    if(Discription.value == "")
    {
      Discription.classList.add('is-invalid');
      Discription.classList.remove('is-valid');
        return false;
    }
    else if(Discription.value != "")
    {
      Discription.classList.remove('is-invalid');
      Discription.classList.add('is-valid');
        return true;
    }
}
function validateimage(e)
{
  const img = document.querySelector('#image')
    if(img.value == "")
    {
      img.classList.add('is-invalid');
      img.classList.remove('is-valid');
        return false;
    }
    else if(img.value != "")
    {
      img.classList.remove('is-invalid');
      img.classList.add('is-valid');
        return true;
    }
}
function validateCtg(e)
{
  const ctg = document.querySelector('#ctg')
    if(ctg.value == "")
    {
      ctg.classList.add('is-invalid');
      ctg.classList.remove('is-valid');
        return false;
    }
    else if(ctg.value != "")
    {
      ctg.classList.remove('is-invalid');
      ctg.classList.add('is-valid');
        return true;
    }
}
function validateType(e)
{
  const type = document.querySelector('#type')
    if(type.value == "")
    {
      type.classList.add('is-invalid');
      type.classList.remove('is-valid');
        return false;
    }
    else if(type.value != "")
    {
      type.classList.remove('is-invalid');
      type.classList.add('is-valid');
        return true;
    }
}


(function () {
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    for(let form of forms){
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity() || !validateSalary() || !validateEmail() || !validateName() ||!validateimage() || !validateDiscription() || !validatePrice () || !validateCtg() || !validateType()){
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