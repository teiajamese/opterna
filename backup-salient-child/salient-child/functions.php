<?php
function theme_enqueue_styles()
{

    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
//    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));

    wp_enqueue_script('custom-js', get_template_directory_uri() . '-child/js/custom.js');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


/** Related Products ********************************************************/

function get_related_products()
{
    get_template_part('/woocommerce/product/related');
}

add_action('related_products', 'get_related_products');

/** Product Title, Category & Tags ********************************************************/

function get_product_meta()
{
    get_template_part('/woocommerce/product/meta');
}

add_action('product_title_category_tags', 'get_product_meta');


/** Product Title, Category & Tags ********************************************************/

function get_product_summary()
{
    get_template_part('/woocommerce/product/description_image');
}

add_action('product_description_feature_image', 'get_product_summary');

/** Product Title, Category & Tags ********************************************************/

function get_product_category()
{
    get_template_part('/woocommerce/archive-product');
}

add_action('product_category_template', 'get_product_category');

/** Product Title, Category & Tags ********************************************************/

function get_product_count_by_category()
{
    get_template_part('/woocommerce/loop/result-count');
}

add_action('woocommerce_get_counts', 'get_product_count_by_category');


function my_facetwp_is_main_query( $is_main_query, $query ) {
    if ( isset( $query->query_vars['facetwp'] ) ) {
        $is_main_query = true;
    }
    return $is_main_query;
}
add_filter( 'facetwp_is_main_query', 'my_facetwp_is_main_query', 10, 2 );

?>