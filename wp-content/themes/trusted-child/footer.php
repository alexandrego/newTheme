<?php
/**
 * The template for displaying the footer
 *
 * @package Trusted
 */

?>
	</div><!-- .container -->

	</div><!-- #content -->
		<script type="text/javascript">
			function ShowLoading(e) {
				var div = document.createElement('div');
				var img = document.createElement('img');
				img.src = 'https://diamondnautica.com.br/wp-content/uploads/2021/01/icone-carregando.gif';
				div.innerHTML = "Aguarde...<br />";
				div.style.cssText = 'position: fixed; flex: 1; top: 40%; left: 30%; z-index: 5000; width: 42%; padding: 2%; border-radius: 4px; text-align: center; font-weight: bold; background: rgb(255, 255, 255);';
				div.appendChild(img);
				document.body.appendChild(div);
				return true;
				// These 2 lines cancel form submission, so only use if needed.
				//window.event.cancelBubble = true;
				//e.stopPropagation();
			}
		</script>		

	<!-- Pinterest Tag -->
<script>
!function(e){if(!window.pintrk){window.pintrk = function () {
window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
  n=window.pintrk;n.queue=[],n.version="3.0";var
  t=document.createElement("script");t.async=!0,t.src=e;var
  r=document.getElementsByTagName("script")[0];
  r.parentNode.insertBefore(t,r)}}("https://s.pinimg.com/ct/core.js");
pintrk('load', '2613738886955', {em: '<user_email_address>'});
pintrk('page');
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt=""
  src="https://ct.pinterest.com/v3/?event=init&tid=2613738886955&pd[em]=<hashed_email_address>&noscript=1" />
</noscript>
<script>
pintrk('track', 'pagevisit');
</script>
<!-- end Pinterest Tag -->

<!-- Exibe alerta de segurança no Console -->
<script type="text/javascript" src="/wp-content/themes/trusted-child/js/alerta.js"></script>

<?php
	if ( get_theme_mod( 'sticky_footer' ) ) {
		$footer_class = ' trusted-sticky-footer';
	} else {
		$footer_class = '';
	}
?>
	<footer id="colophon" class="site-footer<?php echo $footer_class; ?>">
		<?php if(is_active_sidebar( 'trusted-footer1' ) || is_active_sidebar( 'trusted-footer2' ) || is_active_sidebar( 'trusted-footer3' ) ): ?>
		<div id="top-footer">
			<div class="container">
				<div class="top-footer clearfix">
					<div class="footer footer1<?php trusted_sidebar_reveal( 'fadeInRight' ); ?>">
						<?php if(is_active_sidebar( 'trusted-footer1' )): 
							dynamic_sidebar( 'trusted-footer1' );
						endif;
						?>	
					</div>

					<div class="footer footer2<?php trusted_sidebar_reveal( 'fadeInDown' ); ?>">
						<?php if(is_active_sidebar( 'trusted-footer2' )): 
							dynamic_sidebar( 'trusted-footer2' );
						endif;
						?>	
					</div>

					<div class="footer footer3<?php trusted_sidebar_reveal( 'fadeInLeft' ); ?>">
						<?php if(is_active_sidebar( 'trusted-footer3' )): 
							dynamic_sidebar( 'trusted-footer3' );
						endif;
						?>	
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if(is_active_sidebar( 'trusted-about-footer' )): ?>
		<div id="middle-footer">
			<div class="container<?php trusted_sidebar_reveal( 'fadeInUp' ); ?>">
				<?php 
					dynamic_sidebar( 'trusted-about-footer' );
				?>
			</div>
		</div>
		<?php endif; ?>

		<div id="bottom-footer">
			<div class="container clearfix">
				<?php trusted_powered_by(); ?>

				<?php wp_nav_menu( array( 
                	'theme_location' => 'footer',
                	'container_id' => 'footer-menu',
                	'menu_id' => 'footer-menu', 
                	'menu_class' => 'trusted-footer-nav',
                	'depth' => 1,
                	'fallback_cb' => '',
				) ); ?>

			</div>
		</div>

	<!-- Toast de sucesso -->
	<!-- <div id="sucess_toast">
		<div id="desc">
		<span id="float_icon"><i class="fas fa-check-circle"></i></span><p>Dados alterados com sucesso !</p>
		</div>
		<div id="Progress_Status"> 
		<div id="myprogressBar"></div> 
		</div>
	</div> -->

	<!-- Toast de error -->
	<!-- <div id="error_toast">
		<div id="desc">
		<span id="float_icon"><i class="fas fa-exclamation-circle"></i></span><p>Erro ao alterar seus dados !</p>
		</div>
		<div id="Progress_Status"> 
		<div id="error_myprogressBar"></div> 
		</div> 
	</div> -->

	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-171472588-1"></script>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
