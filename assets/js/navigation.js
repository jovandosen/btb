var navEl = document.getElementById("user-links-wrapper-box");
var navElLinks = document.getElementById("logged-user-dropdown-links-el");

if(navEl !== null){

    var elements = [navEl, navElLinks];

    for(var i = 0; i < elements.length; i++){
        elements[i].addEventListener("mouseover", showLinks);
        elements[i].addEventListener("mouseout", hideLinks);
    }

    function showLinks()
    {
        navElLinks.style.display = "block";
    }

    function hideLinks()
    {
        navElLinks.style.display = "none";
    }

}