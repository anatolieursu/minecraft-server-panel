const openWikiPanelBtn = document.getElementById("openWikiPanel");
const theNavBar = document.getElementById("sidebarMenu");
openWikiPanelBtn.addEventListener("click", () => {
    theNavBar.style.display = "flex";
    theNavBar.classList.add("newNavBar");
    document.getElementById("content_wiki").classList.add("newContentWiki")
})