let profileFlashMsgNum = document.getElementsByClassName("profile-flash-msg-box").length;

if(profileFlashMsgNum > 0){
    setTimeout(function(){
        let profileFlashMsgEl = document.getElementById("profile-flash-msg-el");
        profileFlashMsgEl.remove();
    }, 3000);
}