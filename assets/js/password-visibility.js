var eyes = document.getElementsByClassName("btb-eye");
var pass = document.getElementById("password");

for(var i = 0; i < eyes.length; i++){
    eyes[i].addEventListener("click", togglePasswordVisibility);
}

function togglePasswordVisibility()
{
    if(this.classList.contains("eye-slash-el")){
        this.style.display = "none";
        document.getElementById("eye-element").style.display = "block";
        pass.type = "text";
    } else {
        this.style.display = "none";
        document.getElementById("eye-slash-element").style.display = "block";
        pass.type = "password";
    }
}