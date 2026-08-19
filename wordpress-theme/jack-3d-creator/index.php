<?php
/**
 * Main template.
 *
 * On the site's front page it renders the full one-page layout; elsewhere
 * (blog index, archives, search) it renders a simple dark post list.
 *
 * @package Jack_3D_Creator
 */

get_header();

if ( is_front_page() && ! is_paged() ) :
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
else :
	?>
	<main class="j-fallback">
		<?php if ( have_posts() ) : ?>
			<h1><?php echo esc_html( is_home() ? get_bloginfo( 'name' ) : wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>

			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
					<?php endif; ?>
					<?php the_excerpt(); ?>
				</article>
				<?php
			endwhile;
			?>

			<div class="j-pagination">
				<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
			</div>
		<?php else : ?>
			<h1><?php esc_html_e( 'Nothing found', 'jack-3d-creator' ); ?></h1>
			<p><?php esc_html_e( 'No content matched your request.', 'jack-3d-creator' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</main>
	<?php
endif;

get_footer();
