function enlargeImage(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Get the image text
  var imgText = document.getElementById("imgtext");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Use the value of the alt attribute of the clickable image as text inside the expanded image
  imgText.innerHTML = imgs.alt;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
  $(document).scrollTop($(document).height());
}

function showGallery(galery) {
  console.log("in showGalery");
  $.ajax({
    type: "POST",
    url: "main/galeryLoadImages.php",
    data: ({name: galery}),
  }).done(function(data) {
    console.log("in done of showGlaery")
    $('.tdMid').html(data);
  });
}