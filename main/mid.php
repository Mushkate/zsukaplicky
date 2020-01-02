<div id="mid" class="mid">

<div class="animation">   
<div class="w3-content w3-section" style="max-width:99%;margin-top:10px">
  <div class="mySlides" style="background-image:url('images/school/1.JPG');" > </div>
  <div class="mySlides" style="background-image:url('images/school/2.JPG');"  > </div>
  <div class="mySlides" style="background-image:url('images/school/3.JPG');" > </div>
  <div class="mySlides" style="background-image:url('images/school/4.JPG');" > </div>
</div>

<script>
var myIndex = 1;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 4000); 
}
</script>
</div>
<h3>Zde bude hlavní text.</h3>

</div>