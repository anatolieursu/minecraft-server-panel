const theInptForReply = document.getElementById("replyFrom");
const labelTextForReply = document.getElementById("labelTextForReply")
function setReply(value, messageContent, author) {
    theInptForReply.value = value;
    console.log("Setat pentru " + value)
    labelTextForReply.innerHTML = "Reply For '" + messageContent + "' | from "+ author +"...";
}

function addMesssage() {
    
}