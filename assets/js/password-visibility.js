var eyes = document.getElementsByClassName("btb-eye");

for(var i = 0; i < eyes.length; i++){
    eyes[i].addEventListener("click", togglePasswordVisibility);
}

function togglePasswordVisibility()
{
    this.parentElement.style.display = "none";

    if(this.classList.contains("eye-slash-el")){
        this.parentElement.nextElementSibling.style.display = "block";
        this.parentElement.parentElement.parentElement.querySelector("input[type='password']").type = "text";
    } else {
        this.parentElement.previousElementSibling.style.display = "block";
        this.parentElement.parentElement.parentElement.querySelector("input[type='text']").type = "password";
    }
}