<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<!-- Menu normal para todos -->
	<?php
		echo "Menu";
	?>
	<ul>
		<li>
			<a href="<?php echo get_site_url(); ?>/my-account/">Painel</a>
		</li>
		<li>
			<a href="<?php echo get_site_url(); ?>/my-account/edit-account/">Minha Conta</a>
		</li>
		<li>
			<a href="<?php echo get_site_url(); ?>/pedidos/">Pedidos</a>
		</li>
		<li>
			<a href="<?php echo get_site_url(); ?>/my-account/downloads/">Manuais</a>
		</li>
		<li>
			<a href="<?php echo get_site_url(); ?>/my-account/edit-address/">Endereço</a>
		</li>
		<!-- <li>
			<a href="<?php echo get_site_url(); ?>/my-account/customer-logout/?_wpnonce=3153a9139c">Sair</a>
		</li> -->
	</ul>
	<!-- Mostrado apenas para administrador -->
	<?php
		if( current_user_can('administrator') ) {
			//ações a tomar se usuário é adiministrador
			echo "Backend WordPress";
			?>
				<ul>
					<li>
						<a href="<?php echo get_site_url(); ?>/wp-admin/index.php" target="_blank">Painel Wordpress</a>
					</li>
					<li>
						<a href="https://analytics.google.com/analytics/web/?authuser=2#/report-home/a171472588w238405375p222881478" target="_blank">Google Analytics</a>
					</li>
					<li>
						<a href="https://search.google.com/search-console?resource_id=https%3A%2F%2Fdiamondnautica.com.br%2F&hl=pt-BR" target="_blank">Google Search Console</a>
					</li>
					<li>
						<a href="https://merchants.google.com/mc/overview?a=170979538" target="_blank">Google Merchant Center</a>
					</li>
					<li>
						<a href="https://developers.google.com/speed/pagespeed/insights/" target="_blank">Google Page Speed Insights</a>
					</li>					
				</ul>
			<?php } else {
			//echo "Sou cliente";
		}
	?>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
