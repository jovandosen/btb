var navEl = document.getElementById("user-links-wrapper-box");
var navElLinks = document.getElementById("logged-user-dropdown-links-el");

navEl.addEventListener("mouseover", showLinks);
navEl.addEventListener("mouseout", hideLinks);

function showLinks()
{
    navElLinks.style.display = "block";
}

function hideLinks()
{
    navElLinks.style.display = "none";
}