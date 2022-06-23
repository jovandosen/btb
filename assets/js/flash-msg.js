let flashMsgNum = document.getElementsByClassName("flash-msg-box").length;

if(flashMsgNum > 0){
    setTimeout(function(){
        let flashMsgEl = document.getElementById("flash-msg-el");
        flashMsgEl.remove();
    }, 3000);
}