           
<link rel="stylesheet" href="style/header.css">   
<link rel="stylesheet" href="style/select.css">              
<div class="header" id="header"></div>   

<h3> Vyberte kategorii, pro kterou chcete vložit aktualizaci: </h3>

<table> <tr> <td>
  <div class="mainselection" onchange="mainSelected()">
    <select id="mainSelect">
      <option value="nothing">Vyberte kategorii</option>
      <option value="volvo">O nás</option>
      <option value="saab">Zaměstnanci</option>
      <option value="fiat">Poradenské pracoviště</option>
    </select>
  </div>
  </td><td>
    <div id="divMinor" class="hidden mainselection" onchange="minorSelected()">
      <select id="minorSelect" >
      <option value="volvo">O nás</option>
      <option value="saab">Zaměstnanci</option>
      <option value="fiat">Poradenské pracoviště</option>
      </select>
    </div>
  </td><td>
    <div id="divFileType" class="hidden mainselection" onchange="filetypeChosen()">
      <select id="fileType">
      <option value="pdf"> PDF</option>
      <option value="word"> Word - web application</option>
    </div> 
  </td>
  </tr>
  </table>
    <form id="pdfForm" action="upload/uploadPdf.php" method="post" enctype="multipart/form-data" class="hidden">
      <label for="pdfFile" class="btn">Nahrajte PDF soubor: </label>
      <input type="file" name="pdfFile" id="pdfFile">
      <input type="submit">
    </form>

    <form id="folderForm" action="uploadFolder.php" method="post" enctype="multipart/form-data" class="hidden">
      <label for="folder" class="btn">Nahrajte složku: </label>
      <input type="file" id="folder" webkitdirectory mozdirectory />
      <input type="submit">
    </form>