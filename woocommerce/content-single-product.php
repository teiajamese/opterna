<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}

?>
<!--Product Detail Start-->

<div class="product-detail-page col">

    <!-- This method gets product title, categories and tags if any -->

    <?php do_action('product_title_category_tags');?>

    <!-- This method gets product feature image and short description -->

    <?php do_action('product_description_feature_image');?>

    <!-- This method will render page from visual composer -->

<!--    <div class="product-features-section">-->
<!--        --><?php //the_content(); ?>
<!--    </div>-->

    <!-- This method gets all related products -->
    <?php do_action( 'related_products' ); ?>

</div>

<!--Product Detail End-->