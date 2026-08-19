<?php
/**
 * Front page — the one-page layout.
 *
 * @package Jack_3D_Creator
 */

get_header();
?>

<main class="j-main">
	<?php
	get_template_part( 'template-parts/section', 'hero' );
	get_template_part( 'template-parts/section', 'marquee' );
	get_template_part( 'template-parts/section', 'about' );
	get_template_part( 'template-parts/section', 'services' );
	get_template_part( 'template-parts/section', 'projects' );
	get_template_part( 'template-parts/section', 'contact' );
	?>
</main>

<?php
get_footer();
