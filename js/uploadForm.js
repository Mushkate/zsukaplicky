function mainSelected(){
    var value = document.getElementById("mainSelect").value;
    console.log(value);
    console.log(value == "nothing");
    //if nothing selected, hide next selection div
    if (value == "nothing") {
        document.getElementById("divMinor").classList.replace("visible", "hidden");
        minorSelected_hideAll();
        return;
    }
    document.getElementById("divMinor").classList.replace("hidden", "visible");
    document.getElementById("minorSelect").innerHTML = ' \
        <option value="newvalue">new</option> \
        <option value="newvalue">newq</option> \
        <option value="newvalue">newqw</option>';
    filetype_hideAll();
}

function minorSelected(){
    var value = document.getElementById("minorSelect").value;
    console.log(value);
    //if nothing is selected, hide file type round button
    console.log(value == "nothing");
    if (value == "nothing") {
        document.getElementById("divFileType").classList.replace("visible", "hidden");
        return;
    }
    document.getElementById("divFileType").classList.replace("hidden", "visible");
    filetypeChosen();
}

function filetypeChosen(){
    var value = document.getElementById("fileType").value;
    if (value == "pdf") {
        document.getElementById("pdfForm").classList.replace("hidden", "visible");
        document.getElementById("folderForm").classList.replace("visible", "hidden");
    } else {
        document.getElementById("pdfForm").classList.replace("visible", "hidden");
        document.getElementById("folderForm").classList.replace("hidden", "visible");
    }
}

//hide-all methods

function minorSelected_hideAll(){
    document.getElementById("divMinor").classList.replace("visible", "hidden");
    filetype_hideAll();
}

function filetype_hideAll(){
    document.getElementById("divFileType").classList.replace("visible", "hidden");
    forms_hideAll();
}

function forms_hideAll(){
    document.getElementById("folderForm").classList.replace("visible", "hidden");
    document.getElementById("pdfForm").classList.replace("visible", "hidden");
}