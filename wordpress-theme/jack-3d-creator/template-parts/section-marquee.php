<?php
/**
 * Scroll-driven image marquee.
 *
 * @package Jack_3D_Creator
 */

$images = jack3d_marquee_images();

if ( empty( $images ) ) {
	return;
}

$half  = (int) ceil( count( $images ) / 2 );
$row_1 = array_slice( $images, 0, $half );
$row_2 = array_slice( $images, $half );
if ( empty( $row_2 ) ) {
	$row_2 = $row_1;
}

/**
 * Render one repeated row.
 *
 * @param array $row Image URLs.
 */
$render_row = static function ( $row ) {
	for ( $pass = 0; $pass < 3; $pass++ ) {
		foreach ( $row as $url ) {
			printf(
				'<img src="%s" alt="" loading="lazy" decoding="async" />',
				esc_url( $url )
			);
		}
	}
};
?>
<section class="j-marquee" aria-hidden="true" data-marquee>
	<div class="j-marquee__row" data-marquee-row="1"><?php $render_row( $row_1 ); ?></div>
	<div class="j-marquee__row" data-marquee-row="-1"><?php $render_row( $row_2 ); ?></div>
</section>
