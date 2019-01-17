<style>
.tekst{
	  text-align: center;
	  font-size: 30px;
  }
</style>

<div id="carouselExampleControls" class="carousel" data-interval="3000" data-ride="carousel" style="width: 800px; margin: auto" >
  <div class="carousel-inner"  >
    <div class="carousel-item active">
      <img   src="https://www.mitsupport.dk/wp-content/uploads/2015/12/thinkcentrem90-1.jpg" width="800" height="600" alt="First slide">
    </div>
    <div class="carousel-item">
      <img   src="http://www.invent.dk/images/stories/virtuemart/product/z440-workstation.jpg" width="800" height="600" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img   src="https://s3.eu-west-2.amazonaws.com/foeniks-products/172d5469-7387-4da9-9ef9-371bee2871fd/9bd44797-ade7-4c50-957f-94f2d04bbc71/1200x800.jpg" width="800" height="600" alt="Third slide">
    </div>
	<div class="carousel-item">
      <img   src="https://cheekymunkey.co.uk/wp-content/uploads/2017/11/Business-IT-pic-1.jpg" width="800" height="600" alt="Third slide">
    </div>
  </div>  
</div>

<p class="tekst">Vi klargører og sælger computere</p>

<script>
document.getElementById("PageTitle").innerHTML = "Forside"; //Sætter titlen på siden.

$('.carousel').carousel({ride:true, pause:false}) //Carousellen skal cycle igennem billederne. Pause: false gør at carousellen ikke stopper met at cycle igennem billederne, 
												//Når man har musen over den.
</script>