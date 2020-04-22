function loadPageJs(major, minor){
  console.log("loading signpost fragment. major: " + major + " minor: " + minor);

  $.ajax({
    url: 'content/' + major + '/' + minor + '/' + minor + '.htm',
    cache: false,
    beforeSend: function( xhr ) {
      //xhr.overrideMimeType( "text/plain; charset=windows-1250" );
      xhr.overrideMimeType( "text/plain; charset=UTF-8" );
    }
  })
    .done(function( data ) {
      console.log(data);
      $('#mid').html(data);
      console.log("cache: false");
    });

}


function loadArticleJS(major, minor, index) {
  console.log("loading exact page fragment. major: " + major + " minor: " + minor + " index:" + index);

  $.ajax({
    url: 'content/' + major + '/' + minor + '/' + index + '/' + index + '.htm',
    beforeSend: function( xhr ) {
      xhr.overrideMimeType( "text/plain; charset=windows-1250" );
    }
  })
    .done(function( data ) {
      console.log(data);
      $('#mid').html(data);
    });
}

function loadActuality(){
  console.log("In loadActuality function");
  const queryString = window.location.search;
  console.log(queryString);
  console.log("Calling POST");

  $.ajax({
    url: "main/displayAct.php"+queryString
  }).done(function(data) {
    $('#divActuality').html(data);
  });
}


function loadPager(){
  console.log("In loadPager function");
  const url = window.location.href;
  var actualPage = /page=([^&]+)/.exec(url)[1];
  console.log(actualPage);
  console.log("Calling POST");

  $.ajax({
    url: "main/getActCount.php"
  }).done(function(data) {
    console.log("data: "+data);
    if(actualPage==1) {
      output=generatePager(2, actualPage, data);
    } else if (actualPage==2) {
      output=generatePager(1, actualPage, data);
    } else {
      output=generatePager(0, actualPage, data);
    }
    $('#divPager').html(output);
  });
}

function generatePager(index, actualPage, actualities) {

  console.log("actualPage "+actualPage);
  arrayPages=[parseInt(actualPage, 10)-2, parseInt(actualPage, 10)-1, 
    parseInt(actualPage), parseInt(actualPage, 10)+1, parseInt(actualPage, 10)+2, 
    parseInt(actualPage, 10)+3, parseInt(actualPage, 10)+4];
  actPerPage=3.;
  pages = parseInt(actualities) / actPerPage;
  console.log("actualPage: " + actualPage + "    acutalities: " + actualities + "   pages: " + pages);
  if(parseInt(actualPage) > Math.ceil(pages)) {
    actualPage=1;
  }
  console.log("actualPage: " + actualPage);

  output='<div class="pagination"> <a href="actuality.php?page='+(parseInt(actualPage)-1)+'">&laquo;</a>';
  if (pages < 5 ) {
    console.log("in if(pages < 5 )");
    for( i=0; i<pages; i++) {
      console.log(i + "     " + pages)
      if ( (i+1) == parseInt(actualPage)) {
        output=output+'<a href="actuality.php?page='+(i+1)+'" class="active">'+(i+1)+'</a>';
      } else {
        output=output+'<a href="actuality.php?page='+(i+1)+'">'+(i+1)+'</a>';
      }
    }
  } else {
    for(i=index; i<index+5; i++){
      if( parseInt(arrayPages[i])==parseInt(actualPage)) {
        output=output+'<a href="actuality.php?page='+arrayPages[i]+'" class="active">'+arrayPages[i]+'</a>';
      } else {
        output=output+'<a href="actuality.php?page='+arrayPages[i]+'">'+arrayPages[i]+'</a>';
      }
    };
  }
  output=output+'<a href="actuality.php?page='+(parseInt(actualPage)+1)+'">&raquo;</a></div>';
  return output;
}