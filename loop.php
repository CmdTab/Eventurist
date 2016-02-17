<?php /* Loop Template used for index/archive/search */ ?>
<article <?php post_class(); ?>>
	<div class="loop-wrap clearfix">
<?php 
      $myPost = new Pod('post',get_the_ID());
      $post_event_cover_photo = $myPost->get_field('event_cover_photo');
      $evenCoverPhoto = $post_event_cover_photo[0]['guid'];
?>
		<div class="loop-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php if (!empty( $evenCoverPhoto )) { 
                                          echo '<img src="http://cdn.cdnfarecompare.com/resources/mcms/eventimages/' . basename($evenCoverPhoto) . '" height="131" width="174" align="left" />'; 
                                          //the_post_thumbnail($evenCoverPhoto);
                                       } else 
                                           { echo '<img src="' . get_template_directory_uri() . '/images/noimage_174x131.png' . '" alt="No Picture" />'; } ?>
			</a>
		</div>
		<header class="loop-data">
			<h3 class="loop-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<p class="meta"><a href="<?php the_permalink()?>" rel="bookmark"><?php $date = get_the_date(); echo $date; ?></a> by <?php the_author_posts_link(); ?></p>
		</header>
		<?php //the_excerpt();

                $excerpt = get_the_content();
                $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
                $excerpt = strip_shortcodes($excerpt);
                $excerpt = strip_tags($excerpt);
                $excerpt = substr($excerpt, 0, 400);
                $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
                $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
                $excerpt = $excerpt.'...';
                //$excerpt = $excerpt.' <a href="'.$permalink.'">read more</a>';
                 ?>
                <?php echo $excerpt; ?>
                
	</div>
</article>