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