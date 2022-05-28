<?php

/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $product;
$precoLoop = $product->get_price(); // Pega preço do produto !
?>

<?php
if ($price_html = $product->get_price_html()) :
?>

	<!-- Escrevendo código para mostrar preço sem juros apenas no catalogo do produto -->
	<?php
	if (current_user_can('administrator')) { ?>
		<span class="price">
			<span id="mostraPrecoSemJuros">				
			<?php 
				echo get_woocommerce_currency_symbol(); 
			?>
				<?php
					$dividendo = 5;
					$limite_parcela = 12;

					$quant_parcela = intdiv($precoLoop, $dividendo);

					if($quant_parcela >= $limite_parcela){
						$quant_parcela = $limite_parcela;  

						$preco_pego = $precoLoop/$quant_parcela;

					} else if($quant_parcela <= 1){
						$quant_parcela = 1;

						$preco_pego = $precoLoop*$quant_parcela;
					} else {
						$quant_parcela;

						$preco_pego = $precoLoop/$quant_parcela;
					}
					echo ' ' . number_format($precoLoop, 2, ",", ".") . ' em ' . $quant_parcela . 'x Sem Juros';
				?>
			</span>
		</span>
	<?php
	} else {
	?>
		<!-- FIM - Escrevendo código para mostrar preço sem juros apenas no catalogo do produto -->

		<!-- Código Original -->
			<!-- <span class="price">
				<?php //echo $price_html; ?>
			</span> -->
		<!-- FIM Código Original -->

		<span class="price">
			<span id="mostraPrecoSemJuros">				
			<?php 
				echo get_woocommerce_currency_symbol(); 
			?>
				<?php
					$dividendo = 5;
					$limite_parcela = 12;

					$quant_parcela = intdiv($precoLoop, $dividendo);

					if($quant_parcela >= $limite_parcela){
						$quant_parcela = $limite_parcela;  

						$preco_pego = $precoLoop/$quant_parcela;

					} else if($quant_parcela <= 1){
						$quant_parcela = 1;

						$preco_pego = $precoLoop*$quant_parcela;
					} else {
						$quant_parcela;

						$preco_pego = $precoLoop/$quant_parcela;
					}
					echo ' ' . number_format($precoLoop, 2, ",", ".") . ' em ' . $quant_parcela . 'x Sem Juros';
				?>
			</span>
		</span>
	<?php
	}
	?>
<?php endif; ?>