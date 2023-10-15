const ForumPanel = document.getElementById("forumPanel");
document.getElementById("closePanelForum").addEventListener("click", () => {
    ForumPanel.style.display = "none";
})
document.getElementById("addForumPanel").addEventListener("click", () => {
    ForumPanel.style.display = "flex";
})

const aboutMePanel = document.getElementById("setAboutMePanel");
const buttonToCloseAboutMe = document.getElementById("closeAboutMe");

const openBtnAboutMe = document.getElementById("openAboutMePanel");
openBtnAboutMe.addEventListener("click", () => {
    aboutMePanel.style.display = "flex";
})
buttonToCloseAboutMe.addEventListener("click", () => {
    aboutMePanel.style.display = "none"
})

const buttonToCloseEventPanel = document.getElementById("closeEventPanel");
const eventPanel = document.getElementById("postAnEvent")
const openEventPanel = document.getElementById("openEventPostBtn")

openEventPanel.addEventListener("click", () => {
    eventPanel.style.display = "flex";
})
buttonToCloseEventPanel.addEventListener("click", () => {
    eventPanel.style.display = "none"
})