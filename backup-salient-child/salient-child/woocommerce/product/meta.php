<?php
/**
 * Created by PhpStorm.
 * User: Huma
 * Date: 4/20/2016
 * Time: 3:17 PM
 */

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>

<div class="product-meta-section">
    <h2><?php the_title(); ?></h2>

    <p><?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>
        <br/>
        <?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?></p>

</div>
