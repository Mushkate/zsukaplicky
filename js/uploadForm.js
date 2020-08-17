function mainSelected(formType){
    console.log("Form type:", formType);
    minorId=formType + "DivMinor";
    console.log("minor div id: ", minorId);
    var value = document.getElementById(formType + "MainSelect").value;
    console.log("Selected: ", value)
    //if nothing selected, hide next selection div
    if (value == "nothing") {
        document.getElementById(minorId).classList.replace("visible", "hidden");
        minorSelected_hideAll(formType);
        return;
    } if (value == "Fotogalerie" || value == "ZakovskaKnizka" || value == "Aktuality" ){
        document.getElementById(minorId).classList.replace("visible","hidden");
        document.getElementById("divFileType").classList.replace("hidden","visible"); 
        var filetypevalue = document.getElementById("fileType").value;
        if (filetypevalue == "pdf" ){
            document.getElementById("pdf").classList.replace("hidden", "visible");
            document.getElementById("word").classList.replace("visible", "hidden")
        } else {
            document.getElementById("word").classList.replace("hidden", "visible")
            document.getElementById("pdf").classList.replace("visible", "hidden");
        }
    } else {
        document.getElementById(minorId).classList.replace("hidden", "visible");
        setMinorFor(value, formType);
        filetype_hideAll();
    }
}

function minorSelected(formType){
    var value = document.getElementById(formType + "MinorSelect").value;
    console.log("minorSelect.value = ", value);
    //if nothing is selected, hide file type round button
    console.log("value == nothing: ", value == "nothing");
    if (value == "nothing") {
        document.getElementById("divFileType").classList.replace("visible", "hidden");
        return;
    }
    if (formType == "insert") {
        document.getElementById("divFileType").classList.replace("hidden", "visible");
        document.getElementById("divTitle").classList.replace("hidden", "visible");
        filetypeChosen();
    }
    if (formType == "delete") {
        document.getElementById("deleteDivFile").classList.replace("hidden", "visible");
        
        var major = document.getElementById(formType + "MainSelect").value;
        var minor = document.getElementById(formType + "MinorSelect").value;

        console.log("Calling POST for delete...");
        $.ajax({
            type: "POST", 
            url: 'upload/filesToDelete.php',
            cache: false,
            data: {major: major, minor: minor},

            success: function(obj){
                console.log("Just success delete!");
            }
          })
          .done(function( data ) {
            console.log(data);
            console.log("Just done delete!");
            document.getElementById(formType + "FileSelect").innerHTML = data;
          });;
    }
}

function filetypeChosen(){
    var value = document.getElementById("fileType").value;
    console.log("fileType.value: ", value);
    if (value == "pdf") {
        document.getElementById("pdf").classList.replace("hidden", "visible");
        document.getElementById("word").classList.replace("visible", "hidden");
    } else {
        document.getElementById("word").classList.replace("hidden", "visible");
        document.getElementById("pdf").classList.replace("visible", "hidden");
    }
}

function indexFiletypeChosen(){
    var value = document.getElementById("indexFileType").value;
    console.log("indexFileType.value: ", value);
    if (value == "pdf") {
        document.getElementById("indexPdf").classList.replace("hidden", "visible");
        document.getElementById("indexWord").classList.replace("visible", "hidden");
    } else {
        document.getElementById("indexWord").classList.replace("hidden", "visible");
        document.getElementById("indexPdf").classList.replace("visible", "hidden");
    }
}

function fileToDeleteSelected(formType){
    document.getElementById("submitButtonDelete").classList.replace("hidden","visible");
}

function showUploadButton(){
    document.getElementById("submitButtonUpload").classList.replace("hidden", "visible");
}

function indexShowUploadButton(){
    document.getElementById("indexSubmitButtonUpload").classList.replace("hidden", "visible");
}

//hide-all methods
function minorSelected_hideAll(formType){
    console.log("In minorSelected_hideAll for type: ", formType)
    document.getElementById(formType + "DivMinor").classList.replace("visible", "hidden");
    filetype_hideAll();
    title_hide();
}

function title_hide(){
    document.getElementById("divTitle").classList.replace("visible","hidden");
}

function filetype_hideAll(){
    document.getElementById("divFileType").classList.replace("visible", "hidden");
    forms_hideAll();
}

function forms_hideAll(){
    document.getElementById("pdf").classList.replace("visible", "hidden");
    document.getElementById("word").classList.replace("visible", "hidden");
}

//method for generating minor
function setMinorFor(major, formType) {
    var items;
    console.log("Major: ", major);
    switch(major){
        case "OSkole":
            console.log("in o skole");
            items = ["Dokumenty", "Vzdělávací program", "Učebny", "Organizace", "Evropské projekty", "Pedagogický sbor", "Školská rada"];
            values = ["Dokumenty", "VzdelavaciProgram","Ucebny","Organizace", "EvropskeProjekty", "PedagogickySbor", "SkolskaRada"];
            break;
        case "ProZaky":
            console.log("in pro zaky");
            items = ["Školní rok 2019/2020", "Plánované Akce", "Bezpčená Škola", "Dětský Parlament", "Školní Řád"];
            values = ["SkolniRok", "PlanovaneAkce", "BezpecnaSkola", "DetskyParlament", "SkolniRad"]
            break;        
        case "ProRodice":
            console.log("in pro zaky");
            items = ["Školní rok 2019/2020", "Informace", "Školní Jídelna", "Školní Družina", "Školní Poradenské Pracoviště"];
            values = ["SkolniRok", "Informace", "SkolniJidelna", "SkolniDruzina", "SkolniPoradenskePracoviste"]
            break;
        default:
            console.log("did not hit");
    }
    var html="<option>Vyberte podkategorii</option>";
    for(var i =0; i < items.length; i++){
        html = html + "<option value=" + values[i] + ">" + items[i] + "</option>";
    }
    document.getElementById(formType + "MinorSelect").innerHTML = html;
}