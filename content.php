<?php /* Default template for displaying content. */ ?>
<?php 
	$myPost = new Pod();
	$post_image_asset = $myPost->get_field('image_asset');
	$post_event_start_date = $myPost->get_field('event_start_date');
	$post_event_end_date = $myPost->get_field('event_end_date');
	$post_flight_departure = $myPost->get_field('flight_departure_date');
	$post_proposed_flight_return = $myPost->get_field('flight_return_date');

	$post_city = $myPost->get_field('venue_city');
	$post_city_name = $myPost->display('city_location');

	$post_event_url = $myPost->get_field('event_url');
	$post_event_ticket_url = $myPost->get_field('event_ticket_url');
	$post_event_price = $myPost->get_field('event_price');

	$post_venue_airport = $myPost->get_field('venue_airport');
	$post_venue_country = $myPost->get_field('venue_country');

	$post_venue_airport_name = $myPost->display('airport_location');
	$post_venue_country_name = $myPost->display('country_location');

	$post_pod_city = $myPost->get_field('city_location');

	$citypod = pods( 'citylocation', $post_pod_city ); 

	$cityCodeFromPod = $citypod->get_field('citycode');
	$post_pod_venue_name = $myPost->field('venue_name');
	$post_pod_venueAddress = $myPost->field('venue_address');

	//$post_pod_city->get_field('citycode');

	$post_venue_name = $myPost->get_field('venue_name');
	$post_venue_address = $myPost->get_field('venue_address');

	$post_event_cover_photo = $myPost->get_field('event_cover_photo');
	$evenCoverPhoto = $post_event_cover_photo[0]['guid'];

	$post_event_detail_photo_1 = $myPost->get_field('event_detail_photo_1');
	$post_event_detail_photo_2 = $myPost->get_field('event_detail_photo_2');
	$post_event_detail_photo_3 = $myPost->get_field('event_detail_photo_3');
	$post_event_detail_photo_4 = $myPost->get_field('event_detail_photo_4');
	$post_event_detail_photo_5 = $myPost->get_field('event_detail_photo_5');

	$eventdetail_photo_1 = $post_event_detail_photo_1[0]['guid'];
	$eventdetail_photo_2 = $post_event_detail_photo_2[0]['guid'];
	$eventdetail_photo_3 = $post_event_detail_photo_3[0]['guid'];
	$eventdetail_photo_4 = $post_event_detail_photo_4[0]['guid'];
	$eventdetail_photo_5 = $post_event_detail_photo_5[0]['guid'];

	$tips = $myPost->get_field('tips');
	$where_to_eat = $myPost->get_field('where_to_eat');
	$reflexion = $myPost->get_field('reflexion');
	$when_should_i_go = $myPost->get_field('when_should_i_go');
	$where_should_i_stay = $myPost->get_field('where_should_i_stay');
?>
<article <?php post_class('group'); ?>>
	<div class="single-intro">
		<header class="single-thumbnail">
			<?php if( !empty( $post_event_cover_photo[0]['ID'] ) ) : ?>
				<?php echo wp_get_attachment_image( $post_event_cover_photo[0]['ID'], 'full' ); ?>
			<?php endif ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="single-details">
			<h3><svg class="icon icon-info-circle"><use xlink:href="#icon-info-circle"></use></svg>Event Details</h3>
			<h5>Event Location</h5>
			<?php echo $post_pod_venue_name; ?><br />
			<?php echo $post_pod_venueAddress; ?>
			<h5>Event date</h5>
			<?php echo $post_event_start_date; ?> to <?php echo $post_event_end_date; ?>
			<?php

				$dateDeparture = new DateTime($post_flight_departure);
				$dateReturn = new DateTime($post_proposed_flight_return);
				$searchURL = "http://www.farecompare.com/alerts/index.html?originCityCode={origin}&destinationCityCode={destination}&departDate={departureDate}&returnDate={returnDate}&currencyCode=USD&siteCode=1&alertedPrice=1084#quote";

				$searchURLAction = "http://www.farecompare.com/alerts/index.html?currencyCode=USD&siteCode=1&alertedPrice=1084#quote";

				$searchURL = str_replace ("{origin}","DFW" , $searchURL);
				$searchURL = str_replace ("{destination}",$post_city, $searchURL);
				$searchURL = str_replace ("{departureDate}",$dateDeparture->format('Ymd') , $searchURL);
				$searchURL = str_replace ("{returnDate}",$dateReturn->format('Ymd'), $searchURL);

				$searchURL2 = "http://www.farecompare.com/redirect/mobiledeal-redirect.html?quoteKey=C{origin}C{destination}{departureDate}0000R{returnDate}0000P1CTF&flowType=N-mobileDeal--v#results";

				$searchURL2 = str_replace ("{origin}","DFW" , $searchURL2);
				$searchURL2 = str_replace ("{destination}",$post_pod_city[0]['citycode'], $searchURL2);
				$searchURL2 = str_replace ("{departureDate}",$dateDeparture->format('Ymd') , $searchURL2);
				$searchURL2 = str_replace ("{returnDate}",$dateReturn->format('Ymd'), $searchURL2);

				$searchURLAction2 = "http://www.farecompare.com/redirect/mobiledeal-redirect.html?quoteKey=CDFWCZRH201511070000R201511140000P1CTF&flowType=N-mobileDeal--v#results";
			?>
			<h5>Closest Airport</h5>
			<?php echo $post_venue_airport_name; ?>
			
			<div class="photo-cred">
				<svg class="icon icon-camera"><use xlink:href="#icon-camera"></use></svg>
				<p>John Bayou</p>
			</div>
			
		</div><!--single-details-->
		<div class="single-find">
			<a href="<?php echo $searchURL2; ?>" target="_blank"><svg class="icon icon-plane"><use xlink:href="#icon-plane"></use></svg>Find Flights</a>
		</div>
	</div><!--single-intro-->
	<div class="single-main">
		<div class="entry group">
			<div class="single-section">
				<h2>What to expect </h2>
				<?php the_content(); ?>
			</div>
			<?php if( !empty( $eventdetail_photo_1 ) ) : ?>
			<div class="single-section single-photos">
				<h2>Event Photos</h2>
				
				<!--****Begin Slider****-->
				<div id="carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php if( !empty( $post_event_detail_photo_1[0]['ID'] ) ) : ?>
						<li data-target="#carousel" data-slide-to="0" class="active"></li>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_2[0]['ID'] ) ) : ?>
						<li data-target="#carousel" data-slide-to="1"></li>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_3[0]['ID'] ) ) : ?>
						<li data-target="#carousel" data-slide-to="2"></li>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_4[0]['ID'] ) ) : ?>
						<li data-target="#carousel" data-slide-to="3"></li>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_5[0]['ID'] ) ) : ?>
						<li data-target="#carousel" data-slide-to="4"></li>
						<?php endif ?>
					</ol>

					<div class="carousel-inner" role="listbox">
						<?php if( !empty( $post_event_detail_photo_1[0]['ID'] ) ) : ?>
						<div class="item active">
							<?php echo wp_get_attachment_image( $post_event_detail_photo_1[0]['ID'], 'full' ); ?>
						</div>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_2[0]['ID'] ) ) : ?>
						<div class="item">
							<?php echo wp_get_attachment_image( $post_event_detail_photo_2[0]['ID'], 'full' ); ?>
						</div>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_3[0]['ID'] ) ) : ?>
						<div class="item">
							<?php echo wp_get_attachment_image( $post_event_detail_photo_3[0]['ID'], 'full' ); ?>
						</div>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_4[0]['ID'] ) ) : ?>
						<div class="item">
							<?php echo wp_get_attachment_image( $post_event_detail_photo_4[0]['ID'], 'full' ); ?>
						</div>
						<?php endif ?>
						<?php if( !empty( $post_event_detail_photo_5[0]['ID'] ) ) : ?>
						<div class="item">
							<?php echo wp_get_attachment_image( $post_event_detail_photo_5[0]['ID'], 'full' ); ?>
						</div>
						<?php endif ?>
					</div>

					<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
						<svg class="icon icon-angle-left"><use xlink:href="#icon-angle-left"></use></svg>
						<span class="assistive-text">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
						<svg class="icon icon-angle-right"><use xlink:href="#icon-angle-right"></use></svg>
						<span class="assistive-text">Next</span>
					</a>
				</div>
			</div>
			<?php endif ?>
			<?php if( !empty( $tips ) || !empty( $where_to_eat ) || !empty( $reflexion )  ) : ?>
			<div class="single-section">
				<h2>While you're there</h2>
				<?php if( !empty( $tips )): ?>
				<h5>Tips for getting there and back</h5>
				<?php echo $tips; ?>
				<?php endif; ?>
				<?php if( !empty( $where_to_eat )): ?>
				<h5>Where to eat</h5>
				<?php echo $where_to_eat; ?>
				<?php endif; ?>
				<?php if( !empty( $reflexion )): ?>
				<h5>Reflection</h5>
				<?php echo $reflexion; ?>
				<?php endif; ?>
			</div>
			<?php endif ?>
			<?php if( !empty( $when_should_i_go ) || !empty( $where_should_i_stay ) ) : ?>
			<div class="single-section">
				<h2>Travel Info</h2>
				<?php if( !empty( $when_should_i_go )): ?>
				<h5>When should I go</h5>
				<?php echo $when_should_i_go; ?>
				<?php endif; ?>
				<?php if( !empty( $where_should_i_stay )): ?>
				<h5>Where should I stay</h5>
				<?php echo $where_should_i_stay; ?>
				<?php endif; ?>
			</div>
			<?php endif ?>
			<?php if( !empty( $post_event_price ) || !empty( $post_event_url ) || !empty( $post_event_ticket_url ) ) : ?>
			<div class="single-section">
				<h2>Details</h2>
				<?php if($post_event_price) : ?>
				<h5>Event Price</h5>
				<?php echo $post_event_price ?>
				<?php endif; ?>
				<div class="single-links">
					<?php if($post_event_url) : ?>
					<a href="<?php echo $post_event_url ?>" target="_blank">Event website &raquo;</a><br />
					<?php endif; ?>
					<?php if($post_event_ticket_url) : ?>
					<a href="<?php echo $post_event_ticket_url ?>" target="_blank">Event Ticket &raquo;</a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="single-section" style="display: none;">
				<h4>Test tools Trends</h4>
				<form action="<?php echo $searchURLAction; ?>" target="_blank">
					<input type="text" name="originCityCode" value="DFW" maxlength="3" size="3">
					<input type="text" name="destinationCityCode" value="<?php echo $post_pod_city[0]['citycode']; ?>" maxlength="3" size="3">
					<input type="text" name="departDate" value="<?php echo $dateDeparture->format('Ymd'); ?>" maxlength="3" size="3">
					<input type="text" name="returnDate" value="<?php echo $dateReturn->format('Ymd'); ?>" maxlength="3" size="3">
					<BR>
					<input type="submit" value="search">
				</form>
			</div>
			<div class="single-section" style="display: none;">
				<?php if (has_tag()) : ?>
					<div class="post-tags group">
						<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
					</div>
				<?php endif; ?>
			</div>
			<footer class="single-section">
				<?php mh_post_header(); ?>
				<p class="meta post-meta"><?php _e('Posted on ', 'mh-magazine-lite'); ?><span class="updated"><?php the_date(); ?></span><?php _e(' in ', 'mh-magazine-lite') . the_category(', ') ?> </p>
			</footer>
		</div><!--entry-->
	<?php //dynamic_sidebar('posts-2'); ?>
	</div><!--single-main-->
	<?php mh_after_post_content(); ?>
</article>