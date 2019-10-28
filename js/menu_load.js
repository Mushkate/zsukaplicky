function loadPageJs(major, minor){
  console.log("loading page fragment. major: " + major + " minor: " + minor);

  $.ajax({
    url: 'content/' + major + '/' + minor + '.htm',
    beforeSend: function( xhr ) {
      xhr.overrideMimeType( "text/plain; charset=windows-1250" );
    }
  })
    .done(function( data ) {
      $('#mid').html(data);
    });

}