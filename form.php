           
<link rel="stylesheet" href="style/header.css">   
<link rel="stylesheet" href="style/select.css">  
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">            

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
  if (openId == "insert") {
    document.getElementById("delete").classList.replace("visible", "hidden");
    document.getElementById("deleteDivMinor").classList.replace("visible", "hidden");
    document.getElementById("deleteMainSelect").value="nothing";

    document.getElementById(openId).classList.replace("hidden", "visible");
  } else {
    document.getElementById("insert").classList.replace("visible", "hidden");
    document.getElementById("insertMainSelect").value="nothing";
    minorSelected_hideAll("insert");
    
    document.getElementById("delete").classList.replace("hidden", "visible");
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  id = openId + "Button";
  console.log("Button id: " + id);
  document.getElementById(openId + "Button").classList.add("active");
}
</script>

<div class="w3-bar w3-black" id="divTabs">
  <button id="insertButton" class="tablinks w3-bar-item w3-button" onclick="openTab('insert')">Vložit</button>
  <button id="deleteButton" class="tablinks w3-bar-item w3-button" onclick="openTab('delete')">Smazat</button>
</div>

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
        <option value="ZakovskaKnizka">Žákovská Knížka</option>
        <option value="Aktuality">Aktuality</option>
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
      <input type="file" name="pdfFile" id="pdfFile" onChange="showButton()" />
    </div>

    <div id="word" class="hidden" >
      <label for="folder" class="btn">Nahrajte složku: </label>
      <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="" onChange="showButton()" />
    </div>
        
    <input id="submitButton" type="submit" value="Submit the form" class="hidden"/>
  </form>
</div>

<div id="delete" class="hidden">
<h3> Hello from deleting! </h3>
<form id="deleteForm" action="upload/delete.php" method="post"  enctype="multipart/form-data">
    <div class="selection" onchange="mainSelected('delete')">
      <select id="deleteMainSelect" name="mainSelect">
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
        
    <input id="submitButton" type="submit" value="Submit the form" class="hidden"/>
  </form>

</div>