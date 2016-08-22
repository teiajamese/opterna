<?php get_header();

if(is_shop() || is_product_category() || is_product_tag()) {
	
	//page header for main shop page
	nectar_page_header(woocommerce_get_page_id('shop'));
	
} 

//change to 3 columsn per row when using sidebar
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

?>

<div class="container-wrap">
	
	<div class="container main-content">
		
		<div class="row">

<?php
			
			if ( function_exists( 'yoast_breadcrumb' ) ){ yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } 
			
			$options = get_nectar_theme_options();  

 			$main_shop_layout = (!empty($options['main_shop_layout'])) ? $options['main_shop_layout'] : 'no-sidebar';
			$single_product_layout = (!empty($options['single_product_layout'])) ? $options['single_product_layout'] : 'no-sidebar';
			
			//single product layout
			if(is_product()){
				
				if($single_product_layout == 'right-sidebar' || $single_product_layout == 'left-sidebar'){ 
					add_filter('loop_shop_columns', 'loop_columns');
				}
				
				switch($single_product_layout) {
					case 'no-sidebar':
						woocommerce_content(); 
						break; 
					case 'right-sidebar':

						echo '<div id="post-area" class="col span_9">';
							woocommerce_content(); 
						echo '</div><!--/span_9-->';
						
						echo '<div id="sidebar" class="col span_3 col_last">';
							get_sidebar(); 
						echo '</div><!--/span_9-->';

						break; 
						
					case 'left-sidebar':
						echo '<div id="sidebar" class="col span_3">';
						 	get_sidebar(); 
						echo '</div><!--/span_9-->';
						
						echo '<div id="post-area" class="col span_9 col_last">';
							woocommerce_content(); 
						echo '</div><!--/span_9-->';
						
						break; 
					default: 
						woocommerce_content(); 
						break; 
				}
		
			}
			//Main Shop page layout 
			elseif(is_shop() || is_product_category() || is_product_tag()) {
				?>


			<div id="post-area" class="col span_9">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="facetwp-template">
					<ul class="products grid">
						<?php 
							$params = array(
					        'posts_per_page' => -1,
					        'post_type' => 'product',
					        'status' => 'published',
						);
						$wc_query = new WP_Query($params); 
						?>
						<?php if ($wc_query->have_posts()) : ?>
						<?php while ($wc_query->have_posts()) : 
						        $wc_query->the_post(); 
						        
						?>
						       	<li class="col span_4 
						        <?php 
						        	$prodID = get_the_ID();
						        	$loc = get_field('region');
									if($loc){
										//$loc = preg_replace('/\s+/', '', $loc);
										//echo ' '. $loc; 
										echo $loc;
									}
								    $product_terms = wp_get_object_terms( $prodID,  'product_cat' );
									if ( ! empty( $product_terms ) ) {
										if ( ! is_wp_error( $product_terms ) ) {
												foreach( $product_terms as $term ) {
													$prodName = $term->name; 
													$prodName = preg_replace('/\s+/', '', $prodName);
													echo ' '. $prodName;
													
												}

										}
									}
								?>">
								<?php
										 //woocommerce_template_loop_product_thumbnail();
										 $thumbnail_id = get_post_thumbnail_id($prodID);
										 $thumbnail_object = wp_get_attachment_url(get_post_thumbnail_id($prodID));
										?>
						        	<a href="<?php the_permalink(); ?>">
						        		<div class="product-wrap" style='background-image:url("<?php 
						        			if($thumbnail_object){
						        				echo $thumbnail_object;
						        			}
						        			else{
						        				echo get_site_url(). '/wp-content/plugins/woocommerce/assets/images/placeholder.png';
						        			}
						        		?>")'>
						        		
						        			
						        		
						        	</div>
						        	</a>
						        	<h3 class="prod-name"><?php the_title();?> </h3>
						        </li>
								
						<?php endwhile; ?>
						<?php wp_reset_postdata();  ?>
						<?php else:  ?>
						<p>
						     <?php _e( 'No Products' ); ?>
						</p>
						<?php endif; ?>

					</ul>
				</div>
			</div><!--/post-area-->
			<div class="col span_3">
				<div id="options">
				Availability
				<select class="location">
					<option value="*" id="*">Everywhere</option>
					<option value=".mideast" id="mideast">Middle East</option>
					<option value=".us" id="us">US</option>
				</select>

				Product Categories
				<div>
								<!--<ul class="filters-select">
					<li data-filter="*">All</li>-->
				 <?php $product_terms = get_terms( 'product_cat' );
					if ( ! empty( $product_terms ) ) {
						if ( ! is_wp_error( $product_terms ) ) {
								foreach( $product_terms as $term ) {
									 $prodID = $term->term_id;
									 $children = get_terms( 'product_cat', array(
										        'orderby'    => 'count',
										        'hide_empty' => true,
										        'parent' => $prodID,
										) );
								if($term->parent == 0) {
										
										$prodName = $term->name; 
										$prodName = preg_replace('/\s+/', '', $prodName);
										echo '<input type="checkbox" value=".'.$prodName.'" id="'.$prodName.'"/><label for="'.$prodName.'">'.esc_html($term->name).'</label>';

										if( ! empty( $children ) ) {
											echo '<div class="child-checkbox">';
											foreach($children as $child){
												$childName = $child->name;
												$childName = preg_replace('/\s+/', '', $childName);
										    	echo '<input type="checkbox" value=".'.$childName.'" id="'.$childName.'"/><label for="'.$childName.'">'.esc_html($child->name).'</label>';
											}
											echo '</div>';
										}
									} 
									
								}
							}
						}
				?>
				</div>
				<!--</ul>-->
				
				<a href="">
					<div class="isotope-reset">
					Reset
					</div>
				</a>
				</div><!-- End of options div -->

			</div>
			<?php //regular WooCommerce page layout 
			}
			else {
				 woocommerce_content(); 
			}
			?>
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->

<?php get_footer(); ?>