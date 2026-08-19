<?php
/**
 * Hero section.
 *
 * @package Jack_3D_Creator
 */

$portrait = jack3d_mod( 'jack3d_hero_portrait' );
$email    = jack3d_mod( 'jack3d_contact_email' );
?>
<section class="j-hero" id="home">
	<nav class="j-nav j-reveal" style="--j-y:-20px" aria-label="<?php esc_attr_e( 'Primary', 'jack-3d-creator' ); ?>">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
				)
			);
		} else {
			jack3d_default_nav();
		}
		?>
	</nav>

	<div class="j-hero__title-wrap">
		<h1 class="j-heading j-hero__title j-reveal" style="--j-delay:.15s">
			<?php echo esc_html( jack3d_mod( 'jack3d_hero_title' ) ); ?>
		</h1>
	</div>

	<div class="j-hero__bottom">
		<p class="j-hero__tagline j-reveal" style="--j-delay:.35s;--j-y:20px">
			<?php echo esc_html( jack3d_mod( 'jack3d_hero_tagline' ) ); ?>
		</p>

		<div class="j-hero__cta j-reveal" style="--j-delay:.5s;--j-y:20px">
			<a class="j-btn-contact" href="<?php echo esc_url( 'mailto:' . $email ); ?>">
				<?php echo esc_html( jack3d_mod( 'jack3d_cta_label' ) ); ?>
			</a>
		</div>
	</div>

	<div class="j-hero__portrait j-reveal" data-magnet style="--j-delay:.6s;--j-y:30px">
		<?php
		jack3d_image(
			$portrait,
			/* translators: portrait alt text */
			__( 'Jack, 3D creator portrait', 'jack-3d-creator' )
		);
		?>
	</div>
</section>
