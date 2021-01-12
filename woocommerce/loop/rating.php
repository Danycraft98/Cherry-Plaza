<?php
/**
 * Template Name: Loop Rating
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

echo wc_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.
