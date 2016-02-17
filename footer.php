<!--<footer class="site-footer">
	
	<div class="company">
		<p>Eventurist is a product of</p>
		<?php mh_logo(); ?>
		<ul>
			<li><a href = "#">Find Cheap Flights</a></li>
			<li><a href = "#">Latest Deals</a></li>
			<li><a href = "#">Fare Alerts</a></li>
		</ul>
	</div>
	<div class="quote">
		<blockquote>“It is good to have an end to journey toward; but it is the journey that matters, in the end.” - Ernest Hemingway</blockquote>
	</div>
</footer>-->
<div class="event-cats group">
	<h3>Event Categories</h3>
	<?php
		$c = 0;
		$count = get_categories($args);
		foreach($count as $item) {
			$c++;
		}
		$k = ceil($c/5);
		/*end count*/
		$i = 0;
		$args = array(
			'orderby' => 'name',
			'parent' => 0
		);
		$categories = get_categories($args);
		foreach($categories as $category) :
			$i++;
			if ( ($i % $k) == 1 ) {
				echo '<ul class="cat-list">';
			}
	?>
		<li>
			<a href = "<?php echo get_category_link( $category->term_id ); ?>" title="View all posts in <?php echo $category->name; ?>"><?php echo $category->name; ?></a>
		</li>
		<?php 
			if ( ($i % $k) == 0 ) {
				echo '</ul>';
			}
			
			$subargs = array(
				'orderby' => 'term_group',
				'parent' => $category->term_id
			);
			$subcategories = get_categories($subargs);
			foreach($subcategories as $subcategory) :
				$i++;
				if ( ($i % $k) == 1 ) {
					echo '<ul class="cat-list">';
				}
		?>
		<li>
			<a href = "<?php echo get_category_link( $subcategory->term_id ); ?>" title="View all posts in <?php echo $subcategory->name; ?>"><?php echo $subcategory->name; ?></a>
		</li>
		<?php 
			if ( ($i % $k) == 0 ) {
				echo '</ul>';
			}
			
			endforeach; ?>
	<?php endforeach; ?>
	<?php //wp_list_categories('title_li='); ?>
</div>
<footer class="fc-footer">
	<div class="group">
		<img src = "<?php bloginfo('template_directory'); ?>/images/logo-gray.png">
		<ul>
			<li>
				<a href = "#">About</a>
			</li>
			<li>
				<a href = "#">Customer Service</a>
			</li>
			<li>
				<a href = "#">Media</a>
			</li>
			<li>
				<a href = "#">Privacy</a>
			</li>
			<li>
				<a href = "#">Terms</a>
			</li>
			<li>
				<a href = "#">Sitemap</a>
			</li>
		</ul>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>