<?php
/**
 * Footer template.
 *
 * @package Jack_3D_Creator
 */
?>
	</div><!-- #content -->

	<footer class="j-footer">
		<span><?php echo esc_html( jack3d_mod( 'jack3d_footer_text' ) ); ?></span>
		<span>
			<a href="<?php echo esc_url( 'mailto:' . jack3d_mod( 'jack3d_contact_email' ) ); ?>">
				<?php echo esc_html( jack3d_mod( 'jack3d_contact_email' ) ); ?>
			</a>
		</span>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
