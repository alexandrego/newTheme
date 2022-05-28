<?php

/**
 * Preço único produto
 *
 * Esse modelo pode ser substituído, copiando-o para o seu tema / woocommerce / single-product / price.php.
 *
 * NO ENTANTO, ocasionalmente, o WooCommerce precisará atualizar os arquivos de modelo e você
 * (o desenvolvedor do tema) precisará copiar os novos arquivos no seu tema para
 * manter a compatibilidade. Tentamos fazer isso o menos possível, mas funciona
 * acontecer. Quando isso ocorre, a versão do arquivo de modelo será colidida e
 * o leia-me listará quaisquer alterações importantes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
	exit; // Sair se acessado diretamente
}
global $product;
$preco = $product->get_price(); // Pega preço do produto
$currencySymbol = get_woocommerce_currency(); //Pega simbolo da moeda atual

?>

<p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
	<!-- Formata a exibição do preço -->
	<?php
	$product_id = $product->get_id(); // Pega ID do produto

	$product_par = array(3767, 3768); // Adicionar ID dos produtos que são vendidos por unidade
	$product_metro = array(5574, 5581, 10317, 10321, 10322, 10327, 10328, 11158, 11162, 11305); // Adicionar ID dos produtos que são vendidos por metro
	$product_quilo = array(9251); // Adicionar ID dos produtos que são vendidos por quilo
	$product_3_metros = array(5606, 5605); // Adicionar ID dos produtos que são vendidos a cada 3 metros

	if (in_array($product_id, $product_par)) {
		$texto = ' Referente a 1 par';
	} else if (in_array($product_id, $product_metro)) {
		$texto = ' Referente a 1 metro';
	} else if (in_array($product_id, $product_3_metros)) {
		$texto = ' Referente a 3 metros';
	} else if (in_array($product_id, $product_quilo)) {
		$texto = ' Referente a 1.400 kg';
	} else {
		$texto = ' Referente a 1 unidade';
	}
	?>
	<span id="valorCheio">
		<span id="precoProduto">
			<?php echo get_woocommerce_currency_symbol(); ?>
			<?php echo number_format($preco, 2, ",", "."); ?>
		</span>
</p>
</span>
<span id="adicionaDescri">
	<span id="msgRef">
		<!--var msgRef = 'Referente a '; -->
		<span id="ind">
			<?php echo $texto; ?>
		</span>
	</span>
	<span id="tes"></span>
	<span id="msgUni"></span>
</span>

<!-- Ínicio do código para mostrar formas de pagamento!
		Prepara variaveis para trabalhar os preços! -->
<div id="ajusta-altura-preco">
	<?php
	// Pega preço do produto !
	$preco = $product->get_price();

	$desconto = 5 / 100;
	$preco_a_vista = $preco - ($preco * $desconto);

	$dividendo = 5;
	$limite_parcela = 12;

	$quant_parcela = intdiv($preco, $dividendo);
	
	if ($quant_parcela >= $limite_parcela) {
		$quant_parcela = $limite_parcela;

		$preco_pego = $preco / $quant_parcela;
	} else if ($quant_parcela <= 1) {
		$quant_parcela = 1;

		$preco_pego = $preco * $quant_parcela;
	} else {
		$quant_parcela;

		$preco_pego = $preco / $quant_parcela;
	}
	?>
	<div>
		<p>Em <?php echo $quant_parcela; ?>x de
			<span class="valores" id="seisVezesForm">
				<?php echo get_woocommerce_currency_symbol(); ?>
				<!-- Escreve Simbolo Monetario de acordo com a localização do cliente -->
				<?php echo number_format($preco_pego, 2, ",", "."); ?>
				<!-- Escreve Preço Manipulado -->
			</span>
			<sup id="off">(
				<span id="mudaPrecoCheio">
					<?php echo get_woocommerce_currency_symbol(); ?>
					<!-- Escreve Simbolo Monetario de acordo com a localização do cliente -->
					<?php echo number_format($preco, 2, ",", "."); ?>
					<!-- Escreve Preço Manipulado -->
				</span>)
			</sup>
		</p>
	</div>
</div>

<p id="mostraPrecosAVista">Ou
	<span id="descontoParaQuantidadesDiferentes">
		<?php
		echo get_woocommerce_currency_symbol(); //<!-- Escreve Simbolo Monetario de acordo com a localização do cliente -->
		echo number_format($preco_a_vista, 2, ",", "."); //<!-- Escreve Preço Manipulado -->
		echo (get_woocommerce_currency() == 'BRL') ? ' a vista por Pix ou Boleto Bancário' : ' a vista';
		?>
	</span>
</p>

<script type="text/javascript">
	var precoJava = "<?= $preco ?>";
	var productId = "<?= $product_id ?>";
</script>


<script type="text/javascript" src="/wp-content/themes/trusted-child/js/modificaValor.js"></script>

	
<!--==========Script para manipular a mudança de preço em função da quantidade================-->
<!-- <script type="text/javascript">
	function mudaQty() {

		var qtyEscolhido = document.getElementById("pegaQty").value; //<--Pega quantidade do selectBox

		var precoJava = <?//= $preco ?>; //Pega preço do produto
		var precoReal = precoJava.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}); //<--Formata preço para moeda Real

		const productID = <?//= $product_id ?>; //Pega ID do Produto

		var valorGeral = precoJava * qtyEscolhido; //<--Calcula preço vezes a quantidade escolhida
		var valorGeralForm = valorGeral.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}); //<--Formata preço geral para moeda real

		var msgRef = 'Referente a ';
		var msgUni = ' unidade(s)';

		var msgRefPar = 'Referente a ';
		var msgPar = 'par(es)';

		var descBol = 0 / 100; //<--12% de desconto para pagamento com boleto ou debito
		var descTransDep = 0 / 100; //<--15% de desconto para pagamento via transferência ou deposito
		var descCred = 0 / 100; //<--8% de desconto para a vista no cartão de crédito

		var valorBol = valorGeral - (valorGeral * descBol); //<--Aplicando 12% de desconto
		var valorBolForm = valorBol.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}); //<--Formatando o valor para moeda Real

		var valorTransDep = valorGeral - (valorGeral * descTransDep); //<--Aplicando 15% de desconto
		var valorTransDepForm = valorTransDep.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}); //<--Formatando o valor para moeda Real

		const descontoMaximo = 5 / 100; //Prepara 5% de desconto no valor total
		let descontoMaximoPorQuantidade = valorGeral - (valorGeral * descontoMaximo); //Aplica 5% de desconto no valor total
		let formataDescontoMaximoPorQuantidade = descontoMaximoPorQuantidade.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		});

		var valorCred = valorGeral - (valorGeral * descCred);
		var valorCredForm = valorCred.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		});

		var seisVezes = valorGeral / 12;
		var seisVezesForm = seisVezes.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		});
		var mudaValorCheio = seisVezes * 12;
		var mudaValorCheioForm = mudaValorCheio.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		});

		document.getElementById("res").innerHTML = "" + valorTransDepForm; //<--Resultado do calculo preço vezes quantidade
		document.getElementById("descontoParaQuantidadesDiferentes").innerHTML = "" + formataDescontoMaximoPorQuantidade; //Mostra desconto quando muda a quantidade
		document.getElementById("msgRef").innerHTML = "" + msgRef; //<--Exibe mensagem ao lado do preço
		document.getElementById("msgUni").innerHTML = "" + msgUni; //<--Exibe final da mensagem
		document.getElementById("tes").innerHTML = "" + qtyEscolhido; //<--Mostra a quantidade escolhida
		document.getElementById("seisVezesForm").innerHTML = "" + seisVezesForm; //<--Mostra valor parcelado em 6x
		document.getElementById("mudaPrecoCheio").innerHTML = "" + mudaValorCheioForm;
	}
</script> -->