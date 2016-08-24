<?php
/**
 * Created by PhpStorm.
 * User: Huma
 * Date: 4/20/2016
 * Time: 3:20 PM
 */

global $post, $product;

?>

<div class="product-description-image span_12">
    <div class="product-features-section">
        <?php
        if (empty($post->post_content)) {
            if (has_post_thumbnail()) {
                $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
                $image_link = wp_get_attachment_url(get_post_thumbnail_id());
                $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
                    'title' => get_the_title(get_post_thumbnail_id())
                ));

                $attachment_count = count($product->get_gallery_attachment_ids());

                if ($attachment_count > 0) {
                    $gallery = '[product-gallery]';
                } else {
                    $gallery = '';
                }

                echo apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image), $post->ID);

            }
            echo '<div class="product-description">' . apply_filters('woocommerce_short_description', $post->post_excerpt) . '</div>';
        } else {
            echo '<div class="product-detailed-desc">' . the_content() . '</div>';
        }
        ?>
    </div>
</div>
