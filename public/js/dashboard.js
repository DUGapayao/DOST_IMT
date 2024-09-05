function toggleContent() {
    var content = document.getElementById("hidden-content");

    if(content.style.display == "none" || content.style.display == "") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
}

function collapseSidebar() {
    var sidebar = document.getElementById("sidebar");
    var main_content = document.getElementById("main-content-id");
    var collapse_icon = document.getElementById("collapse-icon-id");

    if(sidebar.style.display == "none" || sidebar.style.display == "") {
        sidebar.style.display = "flex";
        main_content.style.width = "80vw";
        collapse_icon.style.transform = "";
    } else {
        sidebar.style.display = "none";
        main_content.style.width = "98.7vw";
        collapse_icon.style.transform = "rotate(180deg)";
    }
}

const addDialog = document.getElementById("add-dialog");
const dialogContainer = document.querySelector(".dialog-container");

function showAddDialog() {
    addDialog.showModal();
}

function closeAddDialog() {
    addDialog.close();
}

addDialog.addEventListener("click", (e) => {
    if(!dialogContainer.contains(e.target)){
        addDialog.close();
    }
});

/**
{
    if(!dialogContainer.contains(e.target)){
        addDialog.close();
    }
});
**/