
<div id="app_widget_motion_carosel" class="box span4 shadow">
	<div class="box-header header-gradient">
		<a href="<? base_url(); ?>apps/motion" class="pull-left">
			<h2>Motion Recent</h2>
	  </a>
	 	<div class="box-controls pull-right">
			<span class="icon-chevron-up"></span>
			<span class="icon-remove"></span>
		</div>	 
	</div>
	<div class="box-body">
		<div id="myCarousel" class="carousel slide">
		  <!-- Carousel items -->
		  <div class="carousel-inner" style="height:250px;">
		    <?
		    if( isset( $images ) && is_array( $images ) && count( $images ) != 0 ){
					?>
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
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta grav</p>
							</div>
							*/ ?>
						</div>
	    	    <?
	    	  }
		    } else {
		      ?>
		      <div class="item">No Images Today</div>
		      <?
		    }
		    ?>
		  </div>
		  <!-- Carousel nav -->
		  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
	</div>
</div>