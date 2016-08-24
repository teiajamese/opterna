<?php
/**
 * Created by PhpStorm.
 * User: Huma
 * Date: 4/20/2016
 * Time: 2:28 PM
 */


global $post, $product, $woocommerce, $woocommerce_loop;
?>
<div class="related-product-section">
        <?php
        if ( empty( $product ) || ! $product->exists() ) {
            return;
        }

        $related = $product->get_related( 4 );

        if ( sizeof( $related ) === 0 ) return;

        $args = apply_filters( 'woocommerce_related_products_args', array(
            'post_type'            => 'product',
            'ignore_sticky_posts'  => 1,
            'no_found_rows'        => 1,
            'posts_per_page'       => 4,
            'orderby'              => $orderby,
            'post__in'             => $related,
            'post__not_in'         => array( $product->id )
        ) );

        $products = new WP_Query( $args );

        $woocommerce_loop['columns'] = $columns;

        if ( $products->have_posts() ) : ?>

            <div class="related products">

                <h2 class="text-center"><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

                <div class="span_12">

                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                        <?php // Store loop count we're currently on
                        if ( empty( $woocommerce_loop['loop'] ) ) {
                            $woocommerce_loop['loop'] = 0;
                        }

                        // Store column count for displaying the grid
                        if ( empty( $woocommerce_loop['columns'] ) ) {
                            $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
                        }

                        // Ensure visibility
                        if ( ! $product || ! $product->is_visible() ) {
                            return;
                        }

                        // Increase loop count
                        $woocommerce_loop['loop']++;
                        ?>
                        <div class="span_3 related-product">
                            <?php
                            echo '<h3>' . get_the_title() . '</h3>';
                            echo '<div class="img-with-aniamtion-wrap">';
                            echo '<a href="'.get_the_permalink().'">'.woocommerce_get_product_thumbnail().'</a>';
                            echo '</div>';
                            ?>
                        </div>

                    <?php endwhile; // end of the loop. ?>

                </div>

            </div>

        <?php endif;

        wp_reset_postdata();
        ?>
</div>