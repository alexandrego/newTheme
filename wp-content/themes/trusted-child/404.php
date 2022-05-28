<?php
/**
 * The template for displaying 404 page
 *
 * @package Trusted
 */

get_header();
?>	
	<div id="error_404">
		<img src="../wp-content/uploads/2021/05/naufragio-de-navio-de-carga-navio-afundando-no-oceano_1441-4064.jpg" id="img_404" />
		<p id="pag_404"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'trusted' ); ?></p>

		<p><?php esc_html_e( 'Maybe try a search?', 'trusted' ); ?> <?php get_search_form(); ?></p>

		<!-- <p><?php //esc_html_e( 'Browse our pages.', 'trusted' ); ?></p> -->
		<!-- <ul>
		<?php //wp_list_pages( array( 'title_li' => '' ) ); ?>
		</ul> -->
	</div>

<?php get_footer(); ?>
