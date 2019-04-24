 function loadPageJs(id){
 if(id == 'onas' ){
   $('#mid').load('menu/onas.php');
 } else {
  $('#mainPanel').load('menu/' + id + '.html');
  }
 }