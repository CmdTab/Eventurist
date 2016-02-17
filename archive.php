<?php get_header(); ?>
	<div id="main-content" class="home-content group">
		
		<?php mh_before_page_content(); ?>
		<?php if (have_posts()): ?>

		<div class="latest-section group">
			<?php while (have_posts()) : the_post();?>
			<article class="home-post">
			<?php 
				$myPost = new Pod('post',get_the_ID());
				//Photos
				$post_event_cover_photo = $myPost->get_field('event_cover_photo');
				$evenCoverPhoto = $post_event_cover_photo[0]['guid'];
				$post_event_detail_photo_1 = $myPost->get_field('event_detail_photo_1');
				$eventdetail_photo_1 = $post_event_detail_photo_1[0]['guid'];
				//Locale
				$post_pod_city = $myPost->get_field('city_location');
				//Dates
				$post_event_start_date = date('n/j',strtotime($myPost->get_field('event_start_date')));
	           $post_event_end_date = date('n/j',strtotime($myPost->get_field('event_end_date')));
			?>
				<a href="<?php the_permalink(); ?>">
					<?php 	
						if (!empty( $evenCoverPhoto )) { 
							echo '<img src="http://cdn.cdnfarecompare.com/resources/mcms/eventimages/' . basename($evenCoverPhoto) . '"  />'; 
						} else {
							echo '<img src="' . get_template_directory_uri() . '/images/noimage_174x131.png' . '" alt="No Picture" />';
						}
					?>
					<div class="post-content">
		                <h2><?php the_title(); ?></h2>
		                <div class="post-city">
		                	<?php
		                		if($post_pod_city[0]['cityname']) {
			                		echo $post_pod_city[0]['cityname'];
			                	}
			                	if($post_pod_city[0]['state']) {
			                		echo ', ';
			                		echo $post_pod_city[0]['state'];
			                	}
			                	if($post_pod_city[0]['countrycode']) {
			                		echo ', ';
			                		echo $post_pod_city[0]['countrycode'];
			                	}
		                	?>
		                </div>
		                <ul class="post-meta">
		                	<li>
		                		<?php 
		                			if($post_event_start_date) {
			                			echo '<svg class="icon icon-calendar-o"><use xlink:href="#icon-calendar-o"></use></svg>';
			                			echo $post_event_start_date;
			                			if($post_event_end_date) {
			                				echo ' - ';
			                				echo $post_event_end_date;
			                			}
				                	}
				                ?>
				            </li>
		                	<li><svg class="icon icon-plane"><use xlink:href="#icon-plane"></use></svg>From $221</li>
		                </ul>
					</div>
				</a>
			</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	
	<?php //get_sidebar(); ?>
<?php get_footer(); ?>