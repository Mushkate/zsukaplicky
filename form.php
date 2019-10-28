           
<link rel="stylesheet" href="style/header.css">   
<link rel="stylesheet" href="style/select.css">              
<div class="header" id="header"></div>   

<h3> Vyberte kategorii, pro kterou chcete vložit aktualizaci: </h3>

<form id="folderForm" action="upload/upload.php" method="post"  enctype="multipart/form-data">
  <table> <tr> <td>
    <div class="mainselection" onchange="mainSelected()">

      <select id="mainSelect" name="mainSelect">
        <option value="nothing">Vyberte kategorii</option>
        <option value="OSkole">O Škole</option>
        <option value="ProZaky">Pro Žáky</option>
        <option value="ProRodice">Pro Rodiče</option>
        <option value="ZakovskaKnizka">Žákovská Knížka</option>
        <option value="Aktuality">Aktuality</option>
      </select>
    </div>
    </td><td>
      <div id="divMinor" class="hidden mainselection" onchange="minorSelected()">
        <select id="minorSelect" name="minorSelect" >
        </select>
      </div>
    </td><td>
      <div id="divFileType" class="hidden mainselection" onchange="filetypeChosen()">
        <select id="fileType" name="fileType">
        <option value="pdf"> PDF</option>
        <option value="word"> Word - web application</option>
      </div> 
    </td>
    </tr>
  </table>
  <div style="height: 10px">
  </div>

  <div id="title" class="hidden">
    <label for="pdfFile" class="btn">Nahrajte PDF soubor: </label>
    <input type="file" name="pdfFile" id="pdfFile" onChange="showButton()">
  </div>
  
  <div id="pdf" class="hidden" >
    <label for="pdfFile" class="btn">Nahrajte PDF soubor: </label>
    <input type="file" name="pdfFile" id="pdfFile" onChange="showButton()">
  </div>

  <div id="word" class="hidden" >
    <label for="folder" class="btn">Nahrajte složku: </label>
    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="" onChange="showButton()" >
  </div>
      
  <input id="submitButton" type="submit" value="Submit the form" class="hidden"/>
</form>