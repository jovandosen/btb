// eye-slash-el
// password-input-el
var eyes = document.getElementsByClassName("btb-eye");
var pass = document.getElementsByClassName("password-input-el");

for(var i = 0; i < eyes.length; i++){
    eyes[i].addEventListener("click", togglePasswordVisibility);
}

function togglePasswordVisibility()
{
    if(this.classList.contains("eye-slash-el")){
        this.style.display = "none";
        pass[0].type = "text";
    } else {
        //
        pass[0].type = "password";
    }
}