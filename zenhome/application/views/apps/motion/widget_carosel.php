
<div id="app_chat_portlet" class="portlet span4">
	<a href="<? base_url(); ?>apps/motion">
		<h2>Motion Recent</h2>
	</a>
	<div id="myCarousel" class="carousel slide">
	  <!-- Carousel items -->
	  <div class="carousel-inner" style="height:250px;">
			<div class="item active">
      	<img src="http://zen.homedns.org/<? echo $images[0]; ?>" alt="">
      </div>
	    <?
	    $i = 0;
	    foreach ($images as $image) {
	    	if( $i == 0 ){
	    		$i++;
	    		continue;
	    	}
	    	?>
				<div class="item">
        	<img src="http://zen.homedns.org/<? echo $image; ?>" alt="">
        	<? /*
          <div class="carousel-caption">
          	<h4>First Thumbnail label</h4>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          </div>
          */ ?>
        </div>
	    	<?
	    }
	    ?>
	  </div>
	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div<