<?php

$did_setup = get_option( 'wsbe_did_setup' );

if ( $did_setup ) {
	WP_CLI::warning( 'Setup already completed.' );
	exit;
}

WP_CLI::runcommand( 'theme activate storefront' );
WP_CLI::runcommand( "rewrite structure '/%postname%/'" );

$product = new WC_Product_Simple();
$product->set_name( '1kg Coffee Beans' );
$product->set_description( '<!-- wp:paragraph --><p>Please buy me.</p><!-- /wp:paragraph -->' );
$product->set_status( 'publish' );
$product->set_catalog_visibility( 'visible' );
$product->save();

WP_CLI::success( sprintf( 'Created product %d.', $product->get_id() ) );

WP_CLI::success( 'Setup complete!' );

update_option( 'wsbe_did_setup', 1 );
