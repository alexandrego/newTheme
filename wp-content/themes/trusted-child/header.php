<?php
/**
 * The theme header.
 *
 * @package Trusted
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:locale" content="pt_BR">
	  	
	<!--Verificação Norton -->
	<meta name="keywords" content="keyword1, keyword2, distribuidor náutico, peças para barco, luminaria para barco, luz de cabine, luz de popa, bombordo e boreste, bombordo, boreste, bomba de porão, automatico de bomba de porão, colete salva vidas, boia de arrinque, limpa contato, wd 40, wd40, verdugo, verdugo nautico, friso de barco, parachoque para barco, rotor para motor de popa, instrumentos para barco, velocimetro, amperimetro, voltimetro, horimetro, indicador de funções, indicador de combustivel, indicador de nível de agua, tacometro, pitot, manilha, óleo de motor para barco, oleo 2 tempos, oleo uni nautix, turotest, churrasqueira para barco, luz de emergência, exaustor para motohome, seaflo, anodo para motor de popa, auto falante nautico, amplificador de som para barcos, jbl, cabo de comando para barco, cado de direção, caixa de direção para barco, capa para barco, toldo para barco, gerador para barco, defensa náutica, banco de barco, gerador de energia, tanque de combustivel, boia tubular, boia de kombi, boia de combustivel, nsw-y3bjuie947r09sodb5o3u2t3wkg21chduum1z0jg5dy79x4uxntpb4rhfv175lihctehd4xaiddkzhlmf7q4z0irsdkonyhkg-cw1cvf89l3-uumdzxm9wbfqfcm78b2"/>
	<!--Fim verificação Norton -->

	<!--Verificação Google Search Console -->
	<meta name="google-site-verification" content="0SdeBKizc0NeIc9w-YFVYtTdTrVuE0dF9FNaIkJHqe8" /> <!--Luis Google Merchant-->
	<meta name="google-site-verification" content="gODkaaWcRNqIr5dBsUH42oCCJFCONcw3Bs9uUdQY1vs"/> <!--kliken-->
	<meta name="google-site-verification" content="DmSs7rYIHqs9Rxs2wl2iogti-M5_1WNwMWs0kczkS70" /> <!-- Deploy -->
	<meta name="google-site-verification" content="20ChwfKemiBhdblEAneTfnHXkNbNlBjUVpvvcH1eIkM" /> <!--Desenvolvimento-->

	<!--Reivindicação Pinterest-->
	<meta name="p:domain_verify" content="e45fb92f13b0c13c33d66eb4fb934cb0"/>
	<!--Fim Reivindicação Pinterest-->
	<meta name="msvalidate.01" content="5AA44A9228C832C98256504989D00B59" />
	<meta name="yandex-verification" content="8b7a80b06b05a858" />
	<meta name="facebook-domain-verification" content="cig6fa62tjjusdyysfhroqwxhhfs4b" />

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<?php do_action( 'wp_body_open' ); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'trusted' ); ?></a>
<?php
	if ( get_theme_mod( 'sticky_footer' ) ) {
		$page_class = ' class="trusted-sticky-footer"';
	} else {
		$page_class = '';
	}
?>
<div id="page"<?php echo $page_class; ?> >
	<?php
		$header_light = get_theme_mod( 'header_light', 'dark' );
		if ( $header_light == 'light' ) {
			$main_header_class = ' light';
		} else {
			$main_header_class = '';
		}
		$header_layout = get_theme_mod( 'header_layout', 'behind' );
		if ( $header_layout == 'below' ) {
			$masthead_layout_class = ' above';
		} else {
			$masthead_layout_class = '';
		}
	?>
	<header id="masthead" class="site-header<?php echo $main_header_class . $masthead_layout_class; ?>">

		<?php if(is_active_sidebar( 'trusted-top-bar' )): ?>
			<div id="top-bar">
				<div class="container">
					<?php 
						dynamic_sidebar( 'trusted-top-bar' );
					?>
				</div>
			</div>
		<?php endif; ?>

		<div class="container clearfix">
			<div id="site-branding">
				<?php if ( get_theme_mod( 'custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
					<?php if ( is_front_page() ) { ?>
						<h1 class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } else { ?>
						<p class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php } 
					} ?>

			</div><!-- #site-branding -->

			<!-- <div id="header-app"> -->
				<div id="top-info">
					<!-- Exibição do botão Voltar caso o usuario esteja em um mobile -->
					<div id="divBtnVoltar">
						<?php
							$home = "https://diamondnautica.com.br/";
							$linkAtual = get_permalink();
							
							if ($linkAtual === $home) {
								//echo "Mesmo link";
							} else {
								?>
									<a id="btnVoltar" onclick="history.back(-1)" ><i class="fa fa-arrow-circle-left"><span> Voltar</span></i></a>
								<?php
							}
						?>
					</div>
					<!-- Exibição do botão Voltar caso o usuario esteja em um mobile -->

					<!-- Mostra campo de telefone, logar e carrinho -->
					<?php trusted_tel_login_cart(); ?>
					<!-- Mostra campo de telefone, logar e carrinho -->
				</div>
				<!--Campo busca-->
				<div id="buscaNovo">
					<?php if ( class_exists( 'WooCommerce' ) ) {
						trusted_woocommerce_search_form();
					} else {
						get_search_form();
					}
					?>
				</div>
			<!-- </div> -->

	        <a href="#x" class="trusted-overlay" id="search"></a>
	        <div class="trusted-modal">
	            <div class="close-this"><a class="fa fa-close" href="#close"></a></div>
				<?php if ( class_exists( 'WooCommerce' ) ) {
					trusted_woocommerce_search_form();
				} else {
					get_search_form();
				}
				?>
	        </div>

			<?php if ( get_theme_mod( 'menu_center' ) ) {
				?>
		</div>

			<div class="site-navigation centered" role="navigation">
				<div class="container">
				<a class="toggle-nav" href="javascript:void(0);"><span></span></a>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'clearfix',
						'fallback_cb'    => 'trusted_primary_menu_fallback',
					)
				); ?>
				</div>
			</div>

			<?php } else {
				?>
			<div class="site-navigation" role="navigation">
				<a class="toggle-nav" href="javascript:void(0);"><span></span></a>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'clearfix',
						'fallback_cb'    => 'trusted_primary_menu_fallback',
					)
				); ?>
			</div>
		</div>
			<?php
				} ?>
			
			<?php
				//Verifica se o usuário está logado
				if ( is_user_logged_in() ) {
					//Exibe o nome
				?>	<div id="bemvindo">
						<?php
							$current_user = wp_get_current_user();
							
							printf( __( 'Ol&aacute;, %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';// Primeiro nome do usuário
						?>
					</div>
			<?php	}
				 else {
					 //Não exibe nada
				 }
			?>

	</header><!-- #masthead -->

	<div id="content" class="site-content clearfix">

<?php
if ( ! is_page_template( 'template-blank-canvas.php' ) && ! is_page_template( 'template-blank-canvas-full-width.php' ) ) {
	trusted_header_title();
}
?>