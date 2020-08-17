           
<link rel="stylesheet" href="style/header.css">   
<link rel="stylesheet" href="style/select.css">  
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">      

<script src="js/galery.js" type="text/javascript"></script>
<script src="js/act.js" type="text/javascript"></script>
              

<div class="header" id="header">
  <table class="headerTable">
    <tr>
      <td><img src="images/children.jpg" class="childImg" ></td>
      <td style="widht:100%;"><p class="headerText">Základní škola U Kapličky, Orlová&#x2011;Lutyně</p> </td>
      <td><img src="images/logo.jpg" style="max-height:90px"></td>
    </tr>
  </table>
</div> 

<script>
function openTab(openId) {
  hideAll();
  console.log("after hide all");
  console.log("before getelementbyid for " + openId);
  document.getElementById(openId).classList.replace("hidden", "visible");
  console.log("after getelementbyid");
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  id = openId + "Button";
  console.log("Button id: " + id);
  document.getElementById(openId + "Button").classList.add("active");
}

function hideAll() {
  //hide delete fields
  document.getElementById("delete").classList.replace("visible", "hidden");
  document.getElementById("deleteDivMinor").classList.replace("visible", "hidden");
  document.getElementById("deleteMainSelect").value="nothing";
  document.getElementById("deleteDivFile").classList.replace("visible", "hidden");
  
  //hide insert fields
  document.getElementById("insert").classList.replace("visible", "hidden");
  document.getElementById("insertMainSelect").value="nothing";
  //minorSelected_hideAll("insert");

  //hide insertAct fields
  document.getElementById("insertAct").classList.replace("visible", "hidden");
  document.getElementById("deleteAct").classList.replace("visible", "hidden");

  //hide galery
  document.getElementById("insertGal").classList.replace("visible", "hidden");
  document.getElementById("deleteGal").classList.replace("visible", "hidden");

  //hide schoolroom
  document.getElementById("insertSchRoom").classList.replace("visible", "hidden");

  //hide index
  document.getElementById("insertIndex").classList.replace("visible", "hidden");
  document.getElementById("indexPdf").classList.replace("visible", "hidden");
  document.getElementById("indexWord").classList.replace("visible", "hidden");
}
</script>

<div class="w3-bar w3-black" id="divTabs">
  <button id="insertButton" class="tablinks w3-bar-item w3-button" onclick="openTab('insert')">Vložit článek</button>
  <button id="deleteButton" class="tablinks w3-bar-item w3-button" onclick="openTab('delete')">Smazat článek</button>
  <button id="insertActButton" class="tablinks w3-bar-item w3-button" onclick="openTab('insertAct')">Vložit aktualitu</button>
  <button id="deleteActButton" class="tablinks w3-bar-item w3-button" onclick="openTab('deleteAct')">Smazat aktualitu</button>
  <button id="insertGalButton" class="tablinks w3-bar-item w3-button" onclick="openTab('insertGal')">Vložit galerii</button>
  <button id="deleteGalButton" class="tablinks w3-bar-item w3-button" onclick="openTab('deleteGal')">Smazat galerii</button>
  <button id="insertSchRoomButton" class="tablinks w3-bar-item w3-button" onclick="openTab('insertSchRoom')">Vložit učebnu</button>
  <button id="insertIndexButton" class="tablinks w3-bar-item w3-button" onclick="openTab('insertIndex')">Vložit hlavní text</button>
</div>

<!-- ---------------------------------- ARTICLES ---------------------------------- -->
<div id="insert" class="hidden">
  <h3> Vyplňte všechny údaje: </h3>
  <br />

  <form id="insertForm" action="upload/upload.php" method="post"  enctype="multipart/form-data">
    <div class="selection" onchange="mainSelected('insert')">
      <select id="insertMainSelect" name="insertMainSelect">
        <option value="nothing">Vyberte kategorii</option>
        <option value="OSkole">O Škole</option>
        <option value="ProZaky">Pro Žáky</option>
        <option value="ProRodice">Pro Rodiče</option>
      </select>
    </div>
    
    <div id="insertDivMinor" class="hidden selection" onchange="minorSelected('insert')">
      <select id="insertMinorSelect" name="insertMinorSelect">
      </select>
    </div>

    <br />

    <div id="divTitle" class="hidden">
      <label for="title" class="btn">Titulek souboru:</label>
      <input type="text" name="title" id="title" required="required" style="width:500px" />
    </div>
    
    <br />
    
    <div id="divFileType" class="hidden selection" onchange="filetypeChosen()">
      <select id="fileType" name="fileType">
        <option value="pdf"> PDF</option>
        <option value="word"> Word - web application</option>
      </select>
    </div>
      
    <div style="height: 10px">
    </div>
    
    <div id="pdf" class="hidden" >
      <label for="pdfFile" class="btn">Nahrajte PDF soubor: </label>
      <input type="file" name="pdfFile" id="pdfFile" onChange="showUploadButton()" />
    </div>

    <div id="word" class="hidden" >
      <label for="folder" class="btn">Nahrajte složku: </label>
      <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="" onChange="showUploadButton()" />
    </div>
        
    <input id="submitButtonUpload" type="submit" value="Potvrdit nahrání" class="hidden"/>
  </form>
</div>

<div id="delete" class="hidden">
<h3> Vyberte soubor ke smazání: </h3>
<br />
<form id="deleteForm" action="upload/delete.php" method="post"  enctype="multipart/form-data">
    <div class="selection" onchange="mainSelected('delete')">
      <select id="deleteMainSelect" name="deleteMainSelect">
        <option value="nothing">Vyberte kategorii</option>
        <option value="OSkole">O Škole</option>
        <option value="ProZaky">Pro Žáky</option>
        <option value="ProRodice">Pro Rodiče</option>
        <option value="ZakovskaKnizka">Žákovská Knížka</option>
        <option value="Aktuality">Aktuality</option>
      </select>
    </div>
    
    <div id="deleteDivMinor" class="hidden selection" onchange="minorSelected('delete')">
      <select id="deleteMinorSelect" name="deleteMinorSelect">
      </select>
    </div>

    <div id="deleteDivFile" class="hidden selection" onchange="fileToDeleteSelected('delete')">
      <select id="deleteFileSelect" name="deleteFileSelect">
      </select>
    </div>
        
    <input id="submitButtonDelete" type="submit" value="Odstranit článek" class="hidden"/>
  </form>

</div>

<!-- ---------------------------------- ACTUALITY ---------------------------------- -->
<div id="insertAct" class="hidden">
  <h3> Vyplňte všechny údaje: </h3>
  <br />

  <form id="insertActForm" action="upload/uploadAct.php" method="post"  enctype="multipart/form-data">
    <div id="divActTitle" >
      <label for="ActTitle" class="btn">Titulek:</label>
      <input type="text" name="ActTitle" id="ActTitle" required="required" style="width:500px" />
    </div>
    
    <br />
    
    <div id="divActText">
      <label for="ActText">Text:</label>
      <textarea id="ActText" name="ActText" rows="4" cols="100" required="required" ></textarea>
    </div>
        
    <input id="submitButtonUpload" type="submit" value="Potvrdit nahrání" />
  </form>
</div>

<div id="deleteAct" class="hidden">
  <h3> Seznam posledních dvaceti článků: </h3>
  <br />

  <div id="divActTitles" >
    <?php
      include("upload/deleteAct.php");
      getLastActualities(20);
    ?>
  </div>
</div>


<!-- ---------------------------------- GALERY ---------------------------------- -->
<div id="insertGal" class="hidden">
  <h3> Vyplňte všechny údaje: </h3>
  <br />

  <form id="insertGalForm" action="upload/uploadGal.php" method="post"  enctype="multipart/form-data">
    <div id="divGalTitle" >
      <label for="GalTitle" class="btn">Titulek:</label>
      <input type="text" name="GalTitle" id="GalTitle" required="required" style="width:500px" />
    </div>

    <div id="divGalDate" >
      <label for="GalDate" class="btn">Datum akce:</label>
      <input type="text" name="GalDate" id="GalDate" required="required" style="width:500px" />
    </div>
    
    <br />
    
    <div id="divGalFiles">
      <label for="files">Soubory:</label>
      <input type="file" name="files[]" id="files" multiple />
    </div>
        
    <input id="submitButtonUpload" type="submit" value="Potvrdit nahrání" />
  </form>
</div>

<div id="deleteGal" class="hidden">
  <h3> Seznam galerií: </h3>
  <br />

  <div id="divGalTitles" >
    <?php
      include("upload/handleGal.php");
      getGaleries();
    ?>
  </div>
</div>


<!-- ---------------------------------- Schoolroom ---------------------------------- -->
<div id="insertSchRoom" class="hidden">
  <h3> Vyplňte všechny údaje: </h3>
  <br />

  <form id="insertSchRoomForm" action="upload/uploadSchRoom.php" method="post"  enctype="multipart/form-data">
    <div id="divSchRoomTitle" >
      <label for="SchRoomTitle" class="btn">Titulek:</label>
      <input type="text" name="SchRoomTitle" id="SchRoomTitle" required="required" style="width:500px" />
    </div>

    <div id="divSchRoomText" >
      <label for="SchRoomText" class="btn">Text o učebně:</label>
      <textarea id="SchRoomText" name="SchRoomText" required="required" rows="4" cols="50"></textarea>
    </div>
    
    <br />
    
    <div id="divGalFiles">
      <label for="ActText">Soubory:</label>
      <input type="file" name="files[]" id="files" multiple />
    </div>
        
    <input id="submitButtonUpload" type="submit" value="Potvrdit nahrání" />
  </form>
</div>


<!-- ---------------------------------- INDEX ---------------------------------- -->
<div id="insertIndex" class="hidden">
  <h3> Vyplňte všechny údaje: </h3>
  <br />

  <form id="indexForm" action="upload/upload.php" method="post"  enctype="multipart/form-data">
    <div id="divFileType" class="selection" onchange="indexFiletypeChosen()">
      <select id="indexFileType" name="indexFileType">
        <option value="">Vyberte typ souboru...</option>
        <option value="pdf"> PDF</option>
        <option value="word"> Word - web application</option>
      </select>
    </div>

    <input type="hidden" name="insertMainSelect"  value="UvodniStranka">
    <input type="hidden" name="insertMinorSelect"  value="UvodniStranka">
    <input type="hidden" name="parameter_name"  value="your_custom_value">

      
    <div style="height: 10px">
    </div>
    
    <div id="indexPdf" class="hidden">
      <label for="pdfFile" class="btn">Nahrajte PDF soubor: </label>
      <input type="file" name="pdfFile" id="pdfFile" onChange="indexShowUploadButton()" />
    </div>

    <div id="indexWord" class="hidden" >
      <label for="folder" class="btn">Nahrajte složku: </label>
      <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="" onChange="indexShowUploadButton()" />
    </div>
        
    <input id="indexSubmitButtonUpload" type="submit" value="Potvrdit nahrání" class="hidden"/>
  </form>
</div>
