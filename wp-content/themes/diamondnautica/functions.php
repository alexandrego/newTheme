<?php
function trusted_child_enqueue_styles() {
    $parent_style = 'trusted-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css', array( $parent_style ),
        wp_get_theme()->get('Version')
    );  
		wp_enqueue_style( 'dashicons' );	
}
add_action( 'wp_enqueue_scripts', 'trusted_child_enqueue_styles' );
/* write custom functions below here */
// Suporte para os recursos da galeria de produtos WooCommerce
// Desabilita o supporte para zoom do produto na página simples.
add_action( 'after_setup_theme', 'remove_pgz_theme_support', 100 );
function remove_pgz_theme_support() { 
remove_theme_support( 'wc-product-gallery-zoom' );
}    
/**
 * Desenvolvido por Diamond Náutica
 */
if(!function_exists( 'trusted_powered_by' )){
	function trusted_powered_by(){
		?>
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'diamondnautica.com.br', ' ' ) ); ?>"><?php printf( esc_html__( 'Desenvolvido por %s', ' ' ), 'Pedro Henrique Matte ME' ); ?></a>
					<span class="sep"> | <?php printf( esc_html__( 'CNPJ: %2$s  %1$s', ' ' ), '', '25.314.854/0001-73' ); ?></span>
				</div>
		<?php
	}
}
/*==================================================================
 	Manipular inserção de quantidade por uma select box.
 ==================================================================*/
 function woocommerce_quantity_input($data = null) {
    global $product;

  $defaults = array(
    'input_name'    => $data['input_name'],
    'input_value'   => $data['input_value'],
    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
    'step'    => apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
    'style'   => apply_filters( 'woocommerce_quantity_style', 'float:left; margin-right:10px;', $product )
  );
  if ( ! empty( $defaults['min_value'] ) )
    $min = $defaults['min_value'];
  else $min = 1;

  if ( ! empty( $defaults['max_value'] ) )
    $max = $defaults['max_value'];
  else $max = 99;

  if ( ! empty( $defaults['step'] ) )
    $step = $defaults['step'];
  else $step = 1;

  $options = '';
  for ( $count = $min; $count <= $max; $count = $count+$step ) {
    $selected = $count === $defaults['input_value'] ? 'selected' : '';
    $options .= '<option value="' . $count . '"'.$selected.'>' . $count . '</option>';
  }
  echo '<div class="quantity_select" style="' . $defaults['style'] . '"><span class="selecQuant">Quantidade:</span> <select name="' . esc_attr( $defaults['input_name'] ) . '" title="' . _x( 'Quantidade', 'Product quantity input tooltip', 'woocommerce' ) . '" class="qty" id="pegaQty" onchange="mudaQty()">' . $options . '</select></div>';
}
/*==================================================================
	 Se oferecer frete grátis, mostrar apenas frete grátis
==================================================================*/
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );
/*==================================================================
	 Botões Paypal
==================================================================
add_filter ('woocommerce_paypal_express_checkout_use_legacy_checkout_js', '__return_true');*/
/*==================================================================
	 Teste de carrinho e checkout
==================================================================*/
add_action( 'woocommerce_before_cart', 'process_a');
function process_a() {
echo '<ul class="breadcrumb-checkout">
		<li class="active">
			<a href="#">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
					<span class="breadcrumb_text">Carrinho</span>
			</a>
		</li>
		<li>
			<a href="https://diamondnautica.com.br/checkout/">
				<i class="fa fa-credit-card" aria-hidden="true"></i> 
					<span class="breadcrumb_text">Pagar Carrinho</span>
			</a>
		</li>
		<li>
			<a href="#">
				<i class="fa fa-check" aria-hidden="true"></i> 
					<span class="breadcrumb_text">Pagamento</span>
			</a>
		</li>
	</ul>';
}
add_action( 'woocommerce_before_checkout_form', 'process_b');
function process_b() {
echo '<ul class="breadcrumb-checkout">
		<li>
			<a href="https://diamondnautica.com.br/cart/">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
					<span class="breadcrumb_text">Carrinho</span>
			</a>
		</li>
		<li class="active">
			<a href="#">
				<i class="fa fa-credit-card" aria-hidden="true"></i> 
					<span class="breadcrumb_text">Pagar Carrinho</span>
			</a>
		</li>
		<li>
			<a href="#">
				<i class="fa fa-check" aria-hidden="true"></i> 
					<span class="breadcrumb_text">Pagamento</span>
			</a>
		</li>
	</ul>';
}
/*==================================================================
	 Inclusão do link Compra Segura depois do botão comprar na página do produto
==================================================================*/
add_action( 'woocommerce_after_add_to_cart_button', 'after_add_to_cart_btn' );  
function after_add_to_cart_btn(){
    echo '</br></br><img src="/wp-content/uploads/2020/07/icone_seguranca.png" width="50" /><a href="https://diamondnautica.com.br/compra-garantida/" target="_blank"> Compra Garantida</a>, receba seu produto com segurança.';
}
/*==================================================================
	adicionar coração de favoritos no menu
==================================================================*/
if ( function_exists( 'YITH_WCWL' ) ) {
	if ( ! function_exists( 'yith_wcwl_add_counter_shortcode' )  ) {
		function yith_wcwl_add_counter_shortcode() {
			add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_print_counter_shortcode' );
		}
	}

	if ( ! function_exists( 'yith_wcwl_print_counter_shortcode' )  ) {
		function yith_wcwl_print_counter_shortcode() {
			?>
			<div class="yith-wcwl-counter">
				<i class="yith-wcwl-icon fa fa-heart"></i>
				<span class="count"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></span>
			</div>
			<?php
		}
	}
	add_action( 'init', 'yith_wcwl_add_counter_shortcode' );
}
/*==================================================================
	Aumentar tamanho do cache Autoptimize
==================================================================*/
add_filter('autoptimize_filter_cachecheck_maxsize','change_maxsize');
function change_maxsize() {
	return 10*1024*1024*1024;
}
/*==================================================================
	 Criando shortcode para exibir o nome do usúario.
==================================================================*/
function give_profile_name($atts){
	$user=wp_get_current_user();
	$name=$user->display_name; 
	return $name;
}
add_shortcode('nome_usuario', 'give_profile_name');
/*==================================================================
	 Shortcode para listar dados do usúario logado.
==================================================================*/
if( current_user_can('administrator') ) {
	
	function listar_cliente_logado($atts) {
		$user=wp_get_current_user();
		$id=$user->ID;
		$user_info = get_userdata( $id ); // 1 is user ID here (required)
		echo 'Nome de Login: ' . $user_info->user_login . "\n";
		echo 'Nível do Cliente: ' . $user_info->user_level . "\n";
		echo 'ID do Cliente: ' . $user_info->ID . "\n";
		echo 'Primeiro Nome: ' . $user_info->first_name . "\n";
		echo 'CPF: ' . $user_info->billing_cpf . "\n";
		echo 'E-mail do cliente: ' . $user_info->user_email . "\n";	
		echo 'Telefone: ' . $user_info->billing_phone . "\n";	
	}
	add_shortcode('info_cliente_logado', 'listar_cliente_logado');
}
/*==================================================================
	 Criando shortcode para listar usúarios. (Ok)
==================================================================*/
if( current_user_can('administrator') ) {

	function listar_clientes($atts) {
		$list_all = get_users( [ 'user_id' => ['ID'] ] );
		$count = 1;
		?>
		<table>
			<tr>
				<td></td>
				<td>Nível</td>
				<td>Nome:</td>				
				<td>CPF:</td>				
				<td>E-mail:</td>								
				<td>Telefone:</td>
			</tr>
		<?php
		// Array of WP_User objects.
		foreach ( $list_all as $user ) {
			?>				
					<tr>
						<td><?php echo $count++; ?></td>
						<td><?php echo '<span>' . esc_html( $user->wp_user_level ) . '</span>'; ?></td>
						<td>
							<?php
								if (empty($user->first_name)){
									echo  '<span>' . esc_html( $user->nickname ) . '</span>';
								} else {
									echo '<span>' . esc_html( $user->first_name, $user->last_name ) . '</span>'; 
								}
							?>
						</td>								
						<td><?php echo '<span>' . esc_html( $user->billing_cpf ) . '</span>'; ?></td>
						<td><?php echo '<span>' . esc_html( $user->user_email ) . '</span>'; ?></td>
						<td><?php echo '<span>' . esc_html( $user->billing_phone ) . '</span>'; ?></td>
					</tr>
			<?php
		//echo '<span></br>' . esc_html( $user->first_name ) . '</span>';
		}
		?>
			</table>
		<?php
	}
	add_shortcode('listar_todos_clientes', 'listar_clientes');
}
/*==================================================================
	 Criando shortcode para verificar se está logado. (Ok)
==================================================================*/
function valida_login ($atts){
	//verifica se o usuário está logado
	if ( is_user_logged_in() ){
	//se o usuário estiver logado, não retorna nada
	return;
	}
	else{
	//se o usuário estiver logado, retorna o conteúdo
	header ("location: https://diamondnautica.com.br/my-account/");
	}
	}
	//criação do shortcode
	add_shortcode('valida_login', 'valida_login' );
	
/*==================================================================
	 Criando shortcode para listar todos os pedidos do cliente.
==================================================================*/
	function listar_pedido($atts) {

		//Pega pedidos do cliente
		$pedidos = get_posts( array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_type'   => wc_get_order_types(),
			'post_status' => array_keys( wc_get_order_statuses() ),
		) );


		//Pega ID do cliente
		$user=wp_get_current_user();
		$id_cliente=$user->ID;
		$count =1;

		//Lista pedidos		
		?>
		<table id="tabela_admin">
			<tr align="center">
				<td></td>
				<td>Nº do pedido</td>
				<td>Data de compra</td>
				<td>Valor pago</td>
				<td>Status</td>
				<td>Ações</td>
			</tr>
			<tr>
				
			</tr>
			<?php
				foreach ( $pedidos as $pedido ) {
					//Pega ID do pedido
					$id_pedido=$pedido->ID;
					$order=$pedido->ID;
					//Consulta dados do pedido
					global $wpdb;
					$total_pedido = $wpdb->get_row( "SELECT * FROM wp_wc_order_stats WHERE order_id = $id_pedido", ARRAY_A );
					//Prepara valor do pedido 
					$preco=$total_pedido['total_sales'];
					//Prepara Status do pedido
					$status_atual=$total_pedido['status'];
			?>				
					<tr id="lista_pedidos" align="center">
						<td style="text-align: center;"><?php echo $count++; ?></td>
						
						<td><?php echo '<span>#' . $pedido->ID . '</span>'; ?></td>

						<td><?php echo '<span>' . date('d/m/Y - H:i', strtotime($pedido->post_date)) . '</span>'; ?></td>

						<td>R$ <?php echo number_format($preco,2,",","."); ?></td>

						<td>
							<?php
								if($status_atual=='wc-completed')	{
									echo 'Seu pedido foi entrgue';
								} else if($status_atual=='wc-processing') {
									echo 'Estamos separando e preparando o seu pedido';
								} else if($status_atual=='wc-on-hold') {
									echo 'Aguardando confirmação do pagamanto';
								} else if($status_atual=='wc-pending') {
									echo 'Aguardando a confirmação do pagamento';
								} else if($status_atual=='wc-cancelled') {
									echo 'O seu pedido foi cancelado';
								} else if($status_atual=='wc-invoice') {
									echo 'Emitindo a nota fiscal';
								} else if($status_atual=='wc-shipped') {
									echo 'Enviamos seu pedido';
								} else {
									echo '<span>' . $total_pedido['status'] . '</span>'; 
								}
							?>
						</td>
					
						<td>
							<a href="https://diamondnautica.com.br/detalhe-do-pedido/?pedido=<?php echo $id_pedido; ?>" class="button">Detalhes</a>

						</td>
					</tr>
					
			<?php	}
				?>
					
		</table>
		<?php
	}
	add_shortcode('listar_pedido_cliente_logado', 'listar_pedido');
/*==================================================================
	 Criando shortcode para pedido selecionado
==================================================================*/
	function pega_numero_pedido() {

		//Pega pedido selecionado
		$numero_pedido=$_GET[ 'pedido' ];


		//Escreve número do pedido		
		return $numero_pedido;
	}
	add_shortcode('numero_pedido', 'pega_numero_pedido');
/*==================================================================
	 Criando shortcode para recuperar valor total do pedido selecionado
==================================================================*/
function pega_valor_pedido() {

	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido' ];
		
	//Consulta dados do pedido
	global $wpdb;
	$total_pedido = $wpdb->get_row( "SELECT * FROM wp_wc_order_stats WHERE order_id = $numero_pedido", ARRAY_A );
	//Prepara valor do pedido 
	$preco=$total_pedido['total_sales'];


	//Escreve número do pedido		
	return '<span>R$ ' . number_format($preco,2,",",".") . '</span>';
}
add_shortcode('valor_pedido', 'pega_valor_pedido');
/*==================================================================
	 Criando shortcode para recuperar data do pedido selecionado
==================================================================*/
function pega_data_pedido() {

	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido' ];
	
	//Consulta dados do pedido
	global $wpdb;
	$total_pedido = $wpdb->get_row( "SELECT * FROM wp_wc_order_stats WHERE order_id = $numero_pedido", ARRAY_A );
	//Prepara valor do pedido 
	$data=$total_pedido['date_created'];


	//Escreve número do pedido		
	return date('d/m/Y - H:i', strtotime($data));

}
add_shortcode('data_pedido', 'pega_data_pedido');
/*==================================================================
	 Criando shortcode para recuperar a quantidade de produtos do pedido selecionado
==================================================================*/
function pega_quant_produtos() {

	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido' ];
	
	//Consulta dados do pedido
	global $wpdb;
	$total_pedido = $wpdb->get_row( "SELECT * FROM wp_wc_order_stats WHERE order_id = $numero_pedido", ARRAY_A );
	
	//Prepara valor do pedido 
	$quant_produtos=$total_pedido['num_items_sold'];

	//Escreve número do pedido		
	return $quant_produtos;
	
}
add_shortcode('quant_produtos', 'pega_quant_produtos');
/*==================================================================
	 Criando shortcode para calcular previsão de entrega do pedido selecionado
==================================================================*/
function entrega_prevista() {

	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido' ];
	
	//Consulta dados do pedido
	global $wpdb;
	$total_pedido = $wpdb->get_row( "SELECT * FROM wp_wc_order_stats WHERE order_id = $numero_pedido", ARRAY_A );

	//Prepara valor do pedido 
	$data=$total_pedido['date_created'];

	//Observa status do pedido
	$status=$total_pedido['status'];

	if ($status == 'wc-cancelled') {
		return '<spam style="color:red;">Pedido Cancelado</spam>';
	} else {
		//Escreve número do pedido		
		return date('d/m/Y', strtotime('+19 days', strtotime($data)));
	}
}
add_shortcode('entrega_prevista', 'entrega_prevista');
/*==================================================================
	 Criando shortcode para listar produtos do pedido selecionado
==================================================================*/
function retorna_produtos() {
	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido' ];
	
	//Consulta dados do pedido
	global $wpdb;
	$sqlSelect  = "SELECT ID 
	FROM wp_posts 
	WHERE post_type = 'shop_order' 
	AND ID = $numero_pedido";

	/* Buscando os IDS da Compra */
	 $pid = array();    
	foreach ($wpdb->get_results($sqlSelect) as $dados) {
		$pid[] .= $dados->ID;
	}

	/* Buscando os produtos comprados pelo ID */
	foreach ($pid as $uid) {
		/* echo '<strong>Número do pedido: ' . $uid . "</strong><br>"; */
		$sqlDados = "SELECT * 
		FROM wp_woocommerce_order_items 
		WHERE order_id = '$uid'		
		AND order_item_type = 'line_item'";
		foreach ($wpdb->get_results($sqlDados) as $itens) {
			echo  '<span style="font-size:0.9em;">->  ' .$itens->order_item_name . '</span><br>';
		}
	}

}
add_shortcode('produtos', 'retorna_produtos');
/*==================================================================
	 Criando shortcode para barra de progresso do pedido selecionado
==================================================================*/
function barra_status () {
	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido' ];
	
	//Consulta dados do pedido
	global $wpdb;
	$total_pedido = $wpdb->get_row( "SELECT * FROM wp_wc_order_stats WHERE order_id = $numero_pedido", ARRAY_A );

	//Prepara Status do pedido
	$status_atual=$total_pedido['status'];

	//Prepara valor do pedido 
	$data=$total_pedido['date_created'];

	//Escreve número do pedido		
	//return date('d/m/Y', strtotime('+19 days', strtotime($data)));

	/* echo $status_atual ; */

	if ($status_atual == 'wc-cancelled') {
		?>
			<table>
				<tr>
					<p style="text-align: center; color:red;">Seu pedido foi cancelado</p>
				</tr>
				<tr>
					<div class="progresso progresso-pai ativa">
						<div class="progresso-barra-cancelada"></div>
					</div>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/compra_cancelada.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos"></td>
					<td id="coluna_detalhe_pedidos" style="color:red;">
						<p style="font-size:11px;">Pedido Cancelado</br></p>
					</td>
				</tr>
			</table>
		<?php
	} elseif ($status_atual == 'wc-completed') {
		//conexão com o banco
		global $wpdb;
		//Consulta nota fiscal
		$consulta_nota=$wpdb->get_row("SELECT * 
										FROM wp_nota_fiscal 
										WHERE id_pedido = $numero_pedido", ARRAY_A );
		$data_nota=$consulta_nota['data'];//Recupera data que a nota foi anexada
		$nome_nota=$consulta_nota['nota'];//Recupera a nota fiscal 

		//Consulta se tem detalhes do frete
		$consulta_frete=$wpdb->get_row("SELECT * 
										FROM wp_frete 
										WHERE id_pedido = $numero_pedido", ARRAY_A );
		$nome_transportadora=$consulta_frete['nome_transportadora'];
		$rastreio=$consulta_frete['rastreio'];
		//Verifica se retornou informação de frete
		if($consulta_frete){
		 ?>
			<table class="juntar_colunas">
				<tr>
					<p style="text-align: center; color:green;">Seu pedido foi entregue</p>
					<p style="text-align: center; color:green;">Enviado por: <spam style="font-size:13px; color:blue;"><?php echo $nome_transportadora;?></spam></p>
					<?php
						//Verifica se foi enviado por correios
						if($nome_transportadora == 'Correios') {
							//Escreve o código de rastreio
							?>
								<p style="text-align: center; color:green;">C&oacute;digo de Rastreio: <spam style="font-size:17px; color:blue;"><?php echo $rastreio;?></spam></p>
							<?php
						}
					?>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pagamento Confirmado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pagamento = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-processing'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pagamento=$consulta_data_pagamento['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pagamento));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Preparado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_preparado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-invoice'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_preparado=$consulta_data_pedido_preparado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_preparado));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Nota Fiscal Emitida</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_nota));?></spam></br><spam style="font-size:11px;"><a href="../notas/<?php echo $nome_nota; ?>" target='_blank'>Ver Nota Fiscal</a></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Enviado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_enviado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-shipped'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_enviado=$consulta_data_pedido_enviado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_enviado));?></spam></br>
							<?php
								//Verifica a transportadora
								if($nome_transportadora == 'Correios') {
									//Mostra link para a página de rastreio dos correios
									?>
										<spam style="font-size:11px;"><a href="https://www2.correios.com.br/sistemas/rastreamento/default.cfm" target="_blank">Rastrei seu pedido</a></spam></br>
									<?php
								} else {
									?>
										<spam style="font-size:11px;"><a href="<?php echo $rastreio;?>" target="_blank">Rastrei seu pedido</a></spam></br>
									<?php
								}
							?>
						</p>					
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Entregue</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_entregue = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-completed'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_entregue=$consulta_data_pedido_entregue['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_entregue));?></spam>
						</p>
					</td>
				</tr>
			</table>
		<?php }
	} elseif ($status_atual == 'wc-pending' || $status_atual == 'wc-on-hold') {		
		?>
			<table>
				<tr>
					<p style="text-align: center; color:green;">Aguardando confirmação de pagamento</p>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-atual"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:#a39422;">
						<p style="font-size:11px;">Aguardando Pagamento</br></p>						
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando preparo do pedido</br></p>						
					</td>
					<td id="coluna_detalhe_pedidos" >
						<p style="font-size:11px;">Aguardando emissão da Nota Fiscal</br></p>						
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando envio</br></p>					
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando entrega</br></p>
					</td>
				</tr>
			</table>
		<?php
	} elseif ($status_atual == 'wc-processing') {		
		?>
			<table>
				<tr>
					<p style="text-align: center; color:green;">Estamos preparando o seu pedido</p>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-atual"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pagamento Confirmado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_status_atual = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-processing'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pagamento=$consulta_data_status_atual['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pagamento));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:#a39422;">
						<p style="font-size:11px;">Preparando pedido</br></p>						
					</td>
					<td id="coluna_detalhe_pedidos" >
						<p style="font-size:11px;">Aguardando emissão da Nota Fiscal</br></p>						
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando envio</br></p>					
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando entrega</br></p>
					</td>
				</tr>
			</table>
		<?php
	} elseif ($status_atual == 'wc-invoice') {	
		//Consultar se já existe nota anexada
		global $wpdb;
		$consulta_nota=$wpdb->get_row("SELECT * 
										FROM wp_nota_fiscal 
										WHERE id_pedido = $numero_pedido", ARRAY_A );
		$data_nota=$consulta_nota['data'];
		$nome_nota=$consulta_nota['nota'];
		//Verifica se retornou alguma nota fiscal
		if($consulta_nota){
		 ?>
			<table>
				<tr>
					<p style="text-align: center; color:green;">Nota Fiscal Emitida</p>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-atual"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pagamento Confirmado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pagamento = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-processing'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pagamento=$consulta_data_pagamento['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pagamento));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Preparado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_preparado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-invoice'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_preparado=$consulta_data_pedido_preparado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_preparado));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Nota Fiscal Emitida</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_nota));?></spam></br><spam style="font-size:11px;"><a href="../notas/<?php echo $nome_nota; ?>" target='_blank'>Ver Nota Fiscal</a></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:#a39422;">
						<p style="font-size:11px;">Aguardando envio</br></p>					
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando entrega</br></p>
					</td>
				</tr>
			</table>
		<?php } else {
		 ?>
			<table>
				<tr>
					<p style="text-align: center; color:green;">Emitindo Nota Fiscal do pedido</p>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-atual"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pagamento Confirmado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pagamento = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-processing'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pagamento=$consulta_data_pagamento['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pagamento));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Preparado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_preparado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-invoice'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_preparado=$consulta_data_pedido_preparado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_preparado));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:#a39422;">
						<p style="font-size:11px;">Emitindo Nota Fiscal</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando envio</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>					
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando entrega</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>
					</td>
				</tr>
			</table>
		<?php }
	} elseif($status_atual == 'wc-shipped') {
		//conexão com o banco
		global $wpdb;
		//Consulta nota fiscal
		$consulta_nota=$wpdb->get_row("SELECT * 
										FROM wp_nota_fiscal 
										WHERE id_pedido = $numero_pedido", ARRAY_A );
		$data_nota=$consulta_nota['data'];//Recupera data que a nota foi anexada
		$nome_nota=$consulta_nota['nota'];//Recupera a nota fiscal 

		//Consulta se tem detalhes do frete
		$consulta_frete=$wpdb->get_row("SELECT * 
										FROM wp_frete 
										WHERE id_pedido = $numero_pedido", ARRAY_A );
		//$nome_transportadora=$consulta_frete['nome_transportadora'];
		//$rastreio=$consulta_frete['rastreio'];
		//echo '<pre>'.print_r($consulta_frete, true).'</pre>';
		//Verifica se retornou informação de frete
		if($consulta_frete){
		 ?>
			<table>
				<tr>
					<p style="text-align: center; color:green;">Seu pedido está a caminho</p>
					<p style="text-align: center; color:green;">Enviado por: <spam style="font-size:13px; color:blue;"><?php echo $consulta_frete['nome_transportadora'];?></spam></p>
					<?php
						//Verifica se foi enviado por correios
						if(trim($consulta_frete['nome_transportadora']) == 'Correios') {
							//Escreve o código de rastreio
							?>
							<p style="text-align: center; color:green;">C&oacute;digo de Rastreio: <spam style="font-size:17px; color:blue;"><?php echo $consulta_frete['rastreio'];?></spam></p>
						<?php

						}/*  else {
							//Escreve o código de rastreio
						} */
					?>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-atual"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pagamento Confirmado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pagamento = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-processing'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pagamento=$consulta_data_pagamento['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pagamento));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Preparado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_preparado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-invoice'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_preparado=$consulta_data_pedido_preparado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_preparado));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Nota Fiscal Emitida</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_nota));?></spam></br><spam style="font-size:11px;"><a href="../notas/<?php echo $nome_nota; ?>" target='_blank'>Ver Nota Fiscal</a></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Enviado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_enviado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-shipped'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_enviado=$consulta_data_pedido_enviado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_enviado));?></spam></br>
							<?php
								//Verifica a transportadora
								if(trim($consulta_frete['nome_transportadora']) == 'Correios') {
									//Mostra link para a página de rastreio dos correios
									?>
										<spam style="font-size:11px;"><a href="https://www2.correios.com.br/sistemas/rastreamento/default.cfm" target="_blank">Rastrei seu pedido</a></spam></br>
									<?php
								} else {
									?>
									<spam style="font-size:11px;"><a href="<?php echo $consulta_frete['rastreio'];?>" target="_blank">Rastrei seu pedido</a></spam></br>
									<?php
								}
							?>
						</p>					
					</td>
					<td id="coluna_detalhe_pedidos" style="color:#a39422;">
						<p style="font-size:11px;">Aguardando entrega</br></p>
					</td>
				</tr>
			</table>
		<?php } else {
		 ?>
			<table>
				<tr>
					<p style="text-align: center; color:green;">Aguardando envio</p>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai ativa">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-entregue"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra-atual"></div>
						</div>
					</td>
					<td id="coluna_detalhe_pedidos">
						<div class="progresso progresso-pai">
							<div class="progresso-barra"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_recebido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pagamento_confirmado3.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/preparando_pedido.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/nota_fiscal.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido_enviado.png" width="50" class="ajustaImgStatusPedido" />
					</td>
					<td id="coluna_detalhe_pedidos">
						<img src="../wp-content/uploads/2020/09/pedido-entregue.png" width="50" class="ajustaImgStatusPedido" />
					</td>
				</tr>
				<tr>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Realizado</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data));?></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pagamento Confirmado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pagamento = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-processing'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pagamento=$consulta_data_pagamento['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pagamento));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Pedido Preparado</br>							
							<?php
								//Consulta quando se mudou o status
								$consulta_data_pedido_preparado = $wpdb->get_row(
									"SELECT * 
									FROM wp_atualizacao_status 
									WHERE id_pedido = $numero_pedido
									AND status_atual = 'wc-invoice'", ARRAY_A );
									//Prepara Data que foi mudado
									$data_pedido_preparado=$consulta_data_pedido_preparado['data_atualizada'];
							?>
							<spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_pedido_preparado));?></spam>
						</p>						
					</td>
					<td id="coluna_detalhe_pedidos" style="color:green;">
						<p style="font-size:11px;">Nota Fiscal Emitida</br><spam style="font-size:9px;"><?php echo date('d/m/Y', strtotime($data_nota));?></spam></br><spam style="font-size:11px;"><a href="../notas/<?php echo $nome_nota; ?>" target='_blank'>Ver Nota Fiscal</a></spam></p>						
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando envio</br></p>					
					</td>
					<td id="coluna_detalhe_pedidos">
						<p style="font-size:11px;">Aguardando entrega</br></p>
					</td>
				</tr>
			</table>
		<?php }
	}
}
add_shortcode('status', 'barra_status');
/*==================================================================
	 Criando novos status para pedidos
==================================================================*/
// New order status AFTER woo 2.2
add_action( 'init', 'register_my_new_order_statuses' );
function register_my_new_order_statuses() {
    register_post_status( 'wc-invoice', array(
        'label'                     => _x( 'Invoice', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Invoice <span class="count">(%s)</span>', 'Invoice<span class="count">(%s)</span>', 'woocommerce' )
	) );
}
add_filter( 'wc_order_statuses', 'my_new_wc_order_statuses' );
// Register in wc_order_statuses.
function my_new_wc_order_statuses( $order_statuses ) {
    $order_statuses['wc-invoice'] = _x( 'Nota Fiscal', 'Order status', 'woocommerce' );
    return $order_statuses;
}
/*==================================================================
	 Criando novos status para pedidos
==================================================================*/
// New order status AFTER woo 2.2
add_action( 'init', 'register_meu_new_order_statuses' );
function register_meu_new_order_statuses() {
    register_post_status( 'wc-shipped', array(
        'label'                     => _x( 'Shipped', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Shipped <span class="count">(%s)</span>', 'Shipped<span class="count">(%s)</span>', 'woocommerce' )
	) );
}
add_filter( 'wc_order_statuses', 'meu_new_wc_order_statuses' );
// Register in wc_order_statuses.
function meu_new_wc_order_statuses( $order_statuses ) {
    $order_statuses['wc-shipped'] = _x( 'Enviado', 'Order status', 'woocommerce' );
    return $order_statuses;
}
/*==================================================================
	 Shortcode para anexar nota fiscal do pedido
==================================================================*/
add_shortcode('anexa_nota', 'anexar_nota_fiscal');
function anexar_nota_fiscal() {
	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'numpedido' ];
	//Formulario para upload da nota fiscal
	?>
		<div id="formnota">
			<p id="tituloNota">Anexar Nota Fiscal</p>

			<form enctype="multipart/form-data" method="post" action="../nota-fiscal/">
				
				<input type="hidden" name="num_nota" id="num_nota" value="<?php echo $numero_pedido; ?>" />
				
				Clique abaixo para carregar a Nota Fiscal </br></br> 
				<input type="file" name="arquivo" required placeholder="Upload" />
					</br>
					</br>
				<input type="submit" value="Anexar Nota" />
				
				<!-- Processamento apos clicar no botão para anexar nota -->
				<?php

				if(isset($_FILES['arquivo'])){
					
					$numero_do_pedido = $_POST['num_nota'];//Pega o número do pedido selecionado
					$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));//Pega extensão do arquivo
					$novo_nome = md5(time()) . $extensao;//Define o nome do arquivo
					$diretorio = "notas/";//Define o diretorio para onde sera enviado o arquivo
					
					mkdir($diretorio, 0777);//Criar pasta de notas

					move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);//Efetua o upload

					//Inserir no banco
					global $wpdb;
					$anexa_nota = $wpdb->query(
						"INSERT INTO wp_nota_fiscal (id, id_pedido, nota, data) 
						VALUES ('', '$numero_do_pedido', '$novo_nome', NOW())");

					if($anexa_nota){
						
						/* "<script id='alinha_alerta'>
							window.alert('Nota Fiscal Anexada com Sucesso!');
						</script>";	 */					
						session_start();
						$_SESSION['nota']='ok';
						$_SESSION['num_pedido']=$numero_do_pedido;
						header('Location: ../my-account/#pedidosAberto');
						//Direciona para inicio						
						//header('Location: https://diamondnautica.com.br/my-account/');
						//header('Location: https://diamondnautica.com.br/my-account/?nota=$nota_ok');
					} else {
						//echo "<script>alert('Erro ao inserir Nota Fiscal !');</script>";				
						session_start();
						$_SESSION['nota']='no_ok';
						$_SESSION['num_pedido']=$numero_do_pedido;
						header('Location: ../my-account/#pedidosAberto');
					}
				}
				?>
			</form>
		</div>
	<?php	
}
/*==================================================================
	 Shortcode para adicionar detalhes do frete
==================================================================*/
add_shortcode('detalhe_frete', 'adicionar_detalhes_frete');
function adicionar_detalhes_frete() {
	//Pega pedido selecionado
	$numero_pedido=$_GET[ 'pedido_id' ];
	//Formulario para upload da nota fiscal
	?>
		<div id="formfrete">
			<p id="titulobemvindo">Adicionar detalhes do envio</p>

			<form name="adiciona_frete" method="post" action="../processa-frete/">
				
				<label>Número do pedido: <strong><?php echo $numero_pedido; ?></strong></label>
					<input type="hidden" name="num_pedido" id="num_pedido" value="<?php echo $numero_pedido; ?>" /></br></br>

				<label>Nome da transportadora: </label><input type="text" name="nome_transportadora" required placeholder="Informe o nome da empresa que entregar&aacute; o pedido" /></br></br>
				
				<label>Código de Rastreio ou link: </label><input type="text" name="codigo_rastreio" required placeholder="Informe o c&oacute;digo de rastreio ou o link da transportadora" /></br></br></br>
				
				<input type="submit" name="adicionar_frete" value="Adicionar detalhes do frete" /></br>
			</form>
		</div>
	<?php	
}
/*==================================================================
	 Shortcode para processar detalhes do frete
==================================================================*/
add_shortcode('processa_frete', 'recebe_detalhes_frete');
function recebe_detalhes_frete() {
	//se tiver post
	$numero_do_pedido = $_POST['num_pedido'];//Pega o número do pedido selecionado
	$transpo_name = $_POST['nome_transportadora'];//Pega nome da transportadora
	$rastreio_code = $_POST['codigo_rastreio'];//Pega código de rastreio

	/* echo $numero_do_pedido;
	echo $transpo_name;
	echo $rastreio_code; */
	//Inserir dados no banco
	global $wpdb;
	$adiciona_frete = $wpdb->query(
		"INSERT INTO wp_frete (id, id_pedido, nome_transportadora, rastreio) 
		VALUES ('', '$numero_do_pedido', '$transpo_name', '$rastreio_code')");

	//Verifica se adicionou no banco
	if($adiciona_frete){
		//Atualiza o Status para Enviado na tabela wp_wc_order_stats
		$atualiza_status = $wpdb->query(
			"UPDATE wp_wc_order_stats 
			SET status = 'wc-shipped'
			WHERE order_id = $numero_do_pedido");

		//Atualiza o Status para Enviado na tabela wp_posts
		$atualiza_status = $wpdb->query(
			"UPDATE wp_posts 
			SET post_status = 'wc-shipped'
			WHERE ID = $numero_do_pedido");

		//Se atualizado, insere na nova tabela para salvar datas
		if($atualiza_status){
			$salva_data = $wpdb->query(
				"INSERT INTO wp_atualizacao_status (id, id_pedido, data_atualizada, status_atual) 
				VALUES ('', '$numero_do_pedido', NOW(), 'wc-shipped')");
			
			//Se insere data na nova tabela
			if($salva_data){		
				//Direciona para inicio			
				//$frete = 'ok';			
				//header('Location: https://diamondnautica.com.br/my-account/?enviado='. $frete .'');		
				session_start();
				$_SESSION['frete']='ok';
				$_SESSION['num_pedido']=$numero_do_pedido;
				header('Location: ../my-account/#pedidosAberto');
			} else {
				//Se inseriu detalhes do frete na tabela e atualizou o status mais não salvou detalhes do dia que foi feito		
				//$frete = 'no_ok';			
				//header('Location: https://diamondnautica.com.br/my-account/?enviado='. $frete .'');		
				session_start();
				$_SESSION['frete']='error';
				$_SESSION['num_pedido']=$numero_do_pedido;
				header('Location: ../my-account/#pedidosAberto');
			}
		} else {
			//Se não atualizar status do pedido direciona para página de inicio			
			//$update = 'error';			
			//header('Location: https://diamondnautica.com.br/my-account/?update='. $update .'');		
			session_start();
			$_SESSION['update']='error';
			$_SESSION['num_pedido']=$numero_do_pedido;
			header('Location: ../my-account/#pedidosAberto');
		}
	} else {
		//Se não adicionar detalhes do frete na tabela direciona para página de inicio			
		//$add = 'error';			
		//header('Location: https://diamondnautica.com.br/my-account/?frete='. $add .'');		
		session_start();
		$_SESSION['add']='error';
		$_SESSION['num_pedido']=$numero_do_pedido;
		header('Location: ../my-account/#pedidosAberto');
	}
}
/*==================================================================
	Shortcode para trocar Status para Pagamento Confirmado
==================================================================*/
add_shortcode('confirma_pagamento', 'confirmar_pagamento');
function confirmar_pagamento() {
	//Recebe o número do pedido
	$numero_pedido=$_GET[ 'pedido_id' ];

	//Consulta no banco e faz alteração do Status
	global $wpdb;
	$consulta_pedido = $wpdb->get_results($wpdb->prepare(
		"SELECT * 
		FROM wp_wc_order_stats 
		WHERE order_id = $numero_pedido", ARRAY_A));
	
	//Confirma se tem pedido e atualiza
	if($consulta_pedido){
		//Atualiza Status
		$atualiza_status = $wpdb->query(
			"UPDATE wp_wc_order_stats 
			SET status = 'wc-processing'
			WHERE order_id = $numero_pedido");

		//Atualiza o Status para Enviado na tabela wp_posts
		$atualiza_status = $wpdb->query(
			"UPDATE wp_posts 
			SET post_status = 'wc-processing'
			WHERE ID = $numero_pedido");

		//Se atualizado, insere na nova tabela para salvar datas
		if($atualiza_status){
			$salva_data = $wpdb->query(
				"INSERT INTO wp_atualizacao_status (id, id_pedido, data_atualizada, status_atual) 
				VALUES ('', '$numero_pedido', NOW(), 'wc-processing')");
			
			//Se insere data na nova tabela
			if($salva_data){		
				//Direciona para inicio			
				//$pagamento = 'ok';
				//$nu_ped = $numero_pedido;
				session_start();
				$_SESSION['pagamento']='ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
				//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'&pedidoid='. $nu_ped .'&#pedidosAberto');
			} else {
				//Direciona para inicio			
				//$pagamento = 'no_ok';	
				session_start();
				$_SESSION['pagamento']='no_ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');		
				//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
			}
		} else {
			//Direciona para inicio			
			//$pagamento = 'no_ok';
			session_start();
			$_SESSION['pagamento']='no_ok';
			$_SESSION['num_pedido']=$numero_pedido;
			header('Location: ../my-account/#pedidosAberto');			
			//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
		}
	} else {
		//Direciona para inicio			
		//$pagamento = 'no_ok';
		session_start();
		$_SESSION['pagamento']='no_ok';
		$_SESSION['num_pedido']=$numero_pedido;
		header('Location: ../my-account/#pedidosAberto');			
		//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
	}	
}
/*==================================================================
	 Shortcode para trocar Status para pedido preparado
==================================================================*/
add_shortcode('pedido_preparado', 'pedido_preparado');
function pedido_preparado() {
	//Recebe o número do pedido
	$numero_pedido=$_GET[ 'pedido_id' ];

	//Consulta no banco e faz alteração do Status
	global $wpdb;
	$consulta_pedido = $wpdb->get_results($wpdb->prepare(
		"SELECT * 
		FROM wp_wc_order_stats 
		WHERE order_id = $numero_pedido", ARRAY_A));
	
	//Confirma se tem pedido e atualiza
	if($consulta_pedido){
		//Atualiza Status
		$atualiza_status = $wpdb->query(
			"UPDATE wp_wc_order_stats 
			SET status = 'wc-invoice'
			WHERE order_id = $numero_pedido");

		//Atualiza o Status para Enviado na tabela wp_posts
		$atualiza_status = $wpdb->query(
			"UPDATE wp_posts 
			SET post_status = 'wc-invoice'
			WHERE ID = $numero_pedido");

		//Se atualizado, insere na nova tabela para salvar datas
		if($atualiza_status){
			$salva_data = $wpdb->query(
				"INSERT INTO wp_atualizacao_status (id, id_pedido, data_atualizada, status_atual) 
				VALUES ('', '$numero_pedido', NOW(), 'wc-invoice')");
			
			//Se insere data na nova tabela
			if($salva_data){	
				//Direciona para inicio			
				//$pagamento = 'ok';			
				//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
				session_start();
				$_SESSION['preparado']='ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
			} else {
				//Direciona para inicio			
				//$pagamento = 'no_ok';			
				//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
				session_start();
				$_SESSION['preparado']='no_ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
			}
			//Direciona para o inicio
			//header('Location: https://diamondnautica.com.br/my-account/');
		} else {
			//Direciona para inicio			
			//$pagamento = 'no_ok';			
			//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
				session_start();
				$_SESSION['preparado']='no_ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
		}
	} else {
		//Direciona para inicio			
		//$pagamento = 'no_ok';			
		//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
				session_start();
				$_SESSION['preparado']='no_ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
	}	
}
/*==================================================================
	 Shortcode para trocar Status para pedido entregue
==================================================================*/
add_shortcode('pedido_entregue_concluido', 'pedido_entregue_concluido');
function pedido_entregue_concluido() {
	//Recebe o número do pedido
	$numero_pedido=$_GET[ 'pedido_id' ];

	//Consulta no banco e faz alteração do Status
	global $wpdb;
	$consulta_pedido = $wpdb->get_results($wpdb->prepare(
		"SELECT * 
		FROM wp_wc_order_stats 
		WHERE order_id = $numero_pedido", ARRAY_A));
	
	//Confirma se tem pedido e atualiza
	if($consulta_pedido){
		//Atualiza Status
		$atualiza_status = $wpdb->query(
			"UPDATE wp_wc_order_stats 
			SET status = 'wc-completed'
			WHERE order_id = $numero_pedido");

		//Atualiza o Status para Enviado na tabela wp_posts
		$atualiza_status = $wpdb->query(
			"UPDATE wp_posts 
			SET post_status = 'wc-completed'
			WHERE ID = $numero_pedido");

		//Se atualizado, insere na nova tabela para salvar datas
		if($atualiza_status){
			$salva_data = $wpdb->query(
				"INSERT INTO wp_atualizacao_status (id, id_pedido, data_atualizada, status_atual) 
				VALUES ('', '$numero_pedido', NOW(), 'wc-completed')");
			
			//Se insere data na nova tabela
			if($salva_data){		
				//Direciona para inicio			
				//$pagamento = 'ok';			
				//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
				session_start();
				$_SESSION['concluido']='ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
			} else {
				//Direciona para inicio			
				//$pagamento = 'no_ok';			
				//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
				session_start();
				$_SESSION['concluido']='no_ok';
				$_SESSION['num_pedido']=$numero_pedido;
				header('Location: ../my-account/#pedidosAberto');
			}
		} else {
			//Se não atualizou Status direciona para inicio			
			//$pagamento = 'no_ok';			
			//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
			session_start();
			$_SESSION['concluido']='no_ok';
			$_SESSION['num_pedido']=$numero_pedido;
			header('Location: ../my-account/#pedidosAberto');
		}
	} else {
		//Se não atualizou Status direciona para inicio		
		//$pagamento = 'no_ok';			
		//header('Location: https://diamondnautica.com.br/my-account/?pagamento='. $pagamento .'');
		session_start();
		$_SESSION['concluido']='no_ok';
		$_SESSION['num_pedido']=$numero_pedido;
		header('Location: ../my-account/#pedidosAberto');
	}	
}
/**
 * Teste adicionado no dia 08/12/2020 - 11:22hs para resolver um problema com sessões php
 * Grave a sessão no disco para evitar o tempo limite de cURL que pode ocorrer com
 * WordPress (since 4.9.2, see ),
 * ou plug-ins como "Verificação de saúde".
 */
function custom_wp_fix_pre_http_request($preempt, $r, $url){
    // CUSTOM_WP_FIX_DISABLE_SWC pode ser definido em wp-config.php (não documentado):
    if ( !defined('CUSTOM_WP_FIX_DISABLE_SWC ') && isset($_SESSION)) {
        if (function_exists('get_site_url')) {
            $parse = parse_url(get_site_url());
            $s_url = @$parse['scheme'] . "://{$parse['host']}";
            if (strpos($url, $s_url) === 0) {
                @session_write_close();
            }
        }
    } 
    return false;
}
add_filter('pre_http_request', 'custom_wp_fix_pre_http_request', 10, 3);
/**
 * Teste atualização de dados do cliente com AJAX para que não seja necessário atualizar a página completa
 */add_action('wp_ajax_editar_nome', 'edita_nome');
function edita_nome() {
	//Recebe o ID do usuario
	$id_user=$_POST[ 'user_id' ];
	$name_user=$_POST[ 'novo_nome' ];
	$meta_first_name= 'first_name';
	$meta_billing_first_name = 'billing_first_name';
	$meta_shipping_first_name = 'shipping_first_name';

	if(empty($id_user)) {
		echo 'nok';
		wp_die();
	} else {
		//echo 'Ola '. $name_user .' Seu ID no sistema é '. $id_user .' e você quer alterar seu '. $meta .'.';
		$salvar_first_name = update_user_meta ($id_user, $meta_first_name, $name_user);	
		$salvar_billing_first_name = update_user_meta ($id_user, $meta_billing_first_name, $name_user);
		$salvar_shipping_first_name = update_user_meta ($id_user, $meta_shipping_first_name, $name_user);

		if ($salvar_first_name && $salvar_billing_first_name && $salvar_shipping_first_name) {
			echo 'ok';
		} else {
			echo 'nok';
		}
		
		wp_die();
	}
}
add_action('wp_ajax_editar_sobrenome', 'edita_sobrenome');
function edita_sobrenome() {
	//Recebe o ID do usuario
	$id_user=$_POST[ 'user_id' ];
	$name_user=$_POST[ 'novo_nome' ];
	$meta=$_POST[ 'local_alterar' ];
	$meta_last_name = 'last_name';
	$meta_shipping = 'shipping_last_name';

	if(empty($id_user)) {
		echo 'nok';
		wp_die();
	} else {
		//echo 'Ola '. $name_user .' Seu ID no sistema é '. $id_user .' e você quer alterar seu '. $meta .'.';
		$salvar = update_user_meta ($id_user, $meta, $name_user);	
		$salvar_last_name = update_user_meta ($id_user, $meta_last_name, $name_user);
		$salvar_shipping = update_user_meta ($id_user, $meta_shipping, $name_user);

		/* global $wpdb;
		$atualiza_sobrenome = $wpdb->query(
			"UPDATE wp_usermeta 
			SET meta_value = $meta
			WHERE order_id = $numero_pedido"); */

		if ($salvar && $salvar_last_name && $salvar_shipping) {
			echo 'ok';
		} else {
			echo 'nok';
		}
		
		wp_die();
	}
}
/**
 * Enfileirando os scripts manipulados com Ajax
 */
function enqueue_scripts_back_end(){
	wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/my_query.js', array('jquery'));	
	wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );	
}
add_action('admin_enqueue_scripts','enqueue_scripts_back_end');
/************************************************************************************
 * Torna o campo Bairro no Checkout um campo obrigatorio 
 ************************************************************************************/
add_filter( 'woocommerce_billing_fields', function( $fields ) {
    $fields['billing_neighborhood']['required'] = true;
    //$fields['billing_cellphone']['required'] = true;
    return $fields;
}, 20 );
/************************************************************************************
 *Criando página de leaders para Bomba de porão 
 ************************************************************************************/
add_shortcode('leader_bomba_porao', 'ld_bomba_porao');
function ld_bomba_porao() {
	?>
		<div id="body_bomba_porao">
			<div id="header_bomba_porao">
				<img src="../wp-content/uploads/2020/10/LOGO-DIAMOND-NAUTICA.png" id="leader_logo"/>
				<p id="titulo_diamond">Diamond Náutica</p>
			</div>

			<div id="utiliza_bomba_porao">
				<h1 id="pq_utilizar_bomba">Por que devo utilizar uma Bomba de Porão ?</h1>
				<p id="texto_bomba">Elas são pequenas, silenciosas, ficam escondidas no fundo do casco e, por isso, muitas vezes acabam negligenciadas pelos donos dos barcos.
					
					</br>Mas poucos equipamentos de segurança são tão fundamentais num barco – qualquer barco! – quanto as bombas de porão. 
					
					</br>Elas podem ser a diferença entre um passeio tranquilo e o completo desastre. Estatísticas mostram que boa parte dos naufrágios de barcos de passeios poderiam ter sido evitados apenas se o sistema de bombeamento de água do porão tivesse funcionando.
				</p>
				<img src="../wp-content/uploads/2021/03/bomba-de-porao.jpg" id="imagem_bomba_de_porao" />
			</div>

			<div id="evita_naufragio">
				<p id="pq_utilizar_bomba">Somente a Bomba de Porão evita que a minha embarcação vá para o fundo ?</p>
				<p id="texto_bomba_direito">Situações como esta, acontecem com mais frequencia do que imaginamos.
					
					</br>Muitas das vezes acontecem porque o dono da embarcação não tem o devido conhecimento sobre o que realmente pode levar a sua embarcação a sofrer com um naufragio.
					
					</br>Existem várias maneiras que podem auxiliar o marinheiro ou até mesmo o dono da embarcação no momento de identificar que sua lancha está com indicios de uma possível inundação, veremos os três equipamentos mais utilizados:

					</br>1. A própria bomba de porão.
					</br>2. Automatico da bomba de porão.
					</br>3. Alarme de inundação.
				</p>
				<img src="../wp-content/uploads/2021/03/lancha-naufragando.jpg" id="imagem_lancha_afundando" />
				<p id="texto_evita_naufragio">1. Como já vimos acima a bomba de porão tem a função de tirar todo o excesso de água que começa a se acumular no porão do 	seu barco, lancha e etc ...
					</br>É aconselhavel que você tenha sempre uma bomba de porão reserva, já dizia os mais antigos - “Quem tem dois, tem um !”, ou “É melhor previnir a remediar !“. Quando se trata da segurança dos tripulantes ou até mesmo da sua família, toda a atenção com a intenção de evitar um possivel naufragio é valida. Sem contar os pontos que você ganha com a sua seguradora, rsrss.
					</br>A bomba de porão pode ser acionada de duas formas, através de uma chave no painel de comandos do marinheiro ou através de um automatico de bomba de porão, veremos este item mais abaixo.
					</br>As bombas de porão possuem algumas nomeclaturas que vale apena conhecermos e nos atentarmos a essas nomeclaturas hora de adquirmos uma bomba de porão, são elas( GPH - GPM - LPH - LPM ), de 12 ou 24 Volts.
					</br>GPH, significa quantos galões por hora essa bomba tem a capacidade de encher.
					</br>GPM, significa quantos galões por minuto essa bomba tem a capacidade de encher.
					</br>LPH, significa quantos litros por hora essa bomba tem a capacidade de fornecer.
					</br>LPM, significa quantos litros por minuto essa bomba tem a capacidade de fornecer.
					</br></br>Quantos litros representa um galão ?
					</br>Galão (abreviação: gal) é uma unidade de medida de volume de líquidos, utilizada na comunidade anglo-saxónica, e representa aproximadamente 3,8 litros.
				</p>
			</div>

			<div id="automatico_bomba">
				<p id="pq_utilizar_automatico_bomba">2. Automatico da Bomba de Porão</p>
				
				<p id="texto_bomba">Trabalhando em conjunto com a bomba de porão o automatico tem a função de acionar a bomba quando a água chega a um determinado nível dentro do porão da embarcação, fazendo isso de forma automatica, sem que o marinheiro ou o dono embarcação notem que a bomba está trabalhando.
					
					</br>Por este e outros motivos que é sempre bom, o ideal é que isso se torne um habito na rotina do marinho, sempre se certificar do perfeito funcionamento do conjunto, automatico e bomba, evitando assim um possivel naufragio por excesso de confiança no sistema. Lembre-se de sempre que possivel ter uma bomba reserva já instalada.
				</p>
				<img src="../wp-content/uploads/2021/03/automatico-e-bomba-de-porao.jpg" id="imagem_bomba_de_porao" />
			</div>

			<div id="alarme_inundacao">
				<p id="pq_utilizar_alarme">3. Alarme de Inundação</p>
				<p id="texto_bomba_direito">O alarme de inundação tem a função de alertar ao marinheiro sobre uma possivel inundação no porão da embarcação o que pode 		levar a um naufragio.
					
					</br>O Alarme de Inundação utiliza técnologia de efeito de campo para detectar a presença de líquido. A técnologia de efeito de campo patenteada pode sentir líquidos sem eles se movimentarem. O detector é altamente confiável, durável e tira proveito da avançada técnologia de sensores. O detector ativa um alarme de 100 db após um atraso de oito segundos após a exposição à água. O detector opera em uma fonte de 12V:20A e 24V:10A.
				</p>
				<img src="../wp-content/uploads/2021/03/alarme-de-inundacao.jpg" id="imagem_lancha_afundando" />
			</div>

			<div id="livre_naufragio">
				<p id="pq_utilizar_bomba">Seguindo estas dicas estou livre de sofrer um naufragio ?</p>
				<p id="texto_evita_naufragio">Gostariamos de poder afirmar isso, porem um naufragio pode ocorrer por diversos fatores, mais temos certeza que seguindo 		essas dicas as chances de você ou sua embarcação sofrerem com um naufragio se reduem a 98%.
					</br></br>Então fique atento a esses pequenos equipamentos que podem salvar e manter seu patrimonio sempre seguro.
					</br></br>Esperamos ter sanado algumas dúvidas que você pudesse ter sobre esses equipamentos, caso ainda tenha ficado com alguma dúvida, fique a vontade para nos contactar através dos seguintes canais de atendimento:

					<div id="contatos_bomba_de_porao">
						<div id="contatos_internos_bomba_de_porao">
							<img src="../wp-content/uploads/2021/03/telephone.png" id="img_tel" /> 
							<p>Telefone comercial</p>
							<p> <a href="tel:+554733616518">+55 (47) 3361-6518</a> </p>
						</div>

						<div id="contatos_internos_bomba_de_porao">
							<img src="../wp-content/uploads/2021/03/whatsapp.png" id="img_tel" />
							<p> WhatsApp </p>
							<p> <a href="https://api.whatsapp.com/send?phone=554733616518&text=Bem%20Vindo%20a%20Diamond%20N%C3%A1utica%2C%20qual%20sua%20d%C3%BAvida%20sobre%20bombas%20de%20por%C3%A3o%20%3F" target="_blank">Basta clicar aqui </a> para ser direcionado a um de nossos consultores. </p>
						</div>

						<div id="contatos_internos_bomba_de_porao">
							<img src="../wp-content/uploads/2021/03/email.png" id="img_tel" />
							<p> Nos enviando um e-mail para: </p>
							<p> <a href="mailto:vendas@diamondnautica.com.br">vendas@diamondnautica.com.br</a> </p>
						</div>
					</div>
				</p>

				<p id="pq_utilizar_bomba">Participe da nossa comunidade no Facebook</p>
				<p><img src="../wp-content/uploads/2021/03/comunidade_facebook.jpg" id="comunidade_facebook" /></p>
				<p id="chamada_facebook"><a href="https://www.facebook.com/groups/191527975419849">Clique aqui</a> para participar de nosso Grupo no Facebook!</p>

				<p id="pq_utilizar_bomba">Buscando algum desses equipamentos ?</p>
				<div id="equipamentos">
					<p> <a href="../page/1/?product_cat=0&s=Bomba+de+Por%C3%A3o+de+12+Volts&post_type=product">Bombas de Porão de 12 Volts</a> </p>
					<p> <a href="../?product_cat=0&s=Bomba+de+Por%C3%A3o+24+Volts&post_type=product">Bombas de Porão de 24 Volts</a> </p>
					<p> <a href="../?product_cat=0&s=Autom%C3%A1tico+da+Bomba+de+Por%C3%A3o&post_type=product">Automaticos de Bomba de Porão</a> </p>
					<p> <a href="../?product_cat=0&s=Alarme+de+Inunda%C3%A7%C3%A3o&post_type=product">Alarmes de Inundação</a> </p>
					<p> <a href="../?product_cat=0&s=Painel+de+Bomba+de+Por%C3%A3o&post_type=product">Painel de Bomba de Porão</a> </p>
				</div>

				<div id="equipamentos_por_marca">
					<p> <a href="../?product_cat=0&s=Bomba+de+Por%C3%A3o+Seaflo&post_type=product">Bomba de Porão Seaflo</a> </p>
					<p> <a href="../?product_cat=0&s=Life&post_type=product">Bomba de Porão Life</a> </p>
					<p> <a href="../?product_cat=0&s=Bomba+de+Por%C3%A3o+Rule&post_type=product">Bomba de Porão Rule</a> </p>
					</br>
					<p> <a href="../?product_cat=0&s=Autom%C3%A1tico+Seaflo&post_type=product">Automatico Seaflo</a> </p>
					<p> <a href="../product/automatico-da-bomba-de-porao-life-src-float-switch/">Automatico Life</a> </p>
					<p> <a href="../product/automatico-da-bomba-de-porao-ocean-float-switch/">Automatico Ocean</a> </p>
					<p> <a href="">Automatico Rule</a> </p>
				</div>
			</div>

			<div id="comentarios_ld_bomba_porao">
			</div>
		</div>
	<?php
}
/******************************************************************
 * Iniciando o novo painel de cliente
 ******************************************************************/
add_shortcode('home', 'painel_novo');
function painel_novo() {
	?>
	<!-- Novo SLider -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<div class="div-slider">
			<ul class="slides-front">
				<input type="radio" name="radio-btn" id="img-1" checked="">
				<li class="slide-container">
					<div class="slide">
						<img src="../wp-content/uploads/2021/11/todo-site-em-12-x-sem-juros-2.webp" loading="lazy">
					</div>

					<div class="nav">
						<label for="img-3" class="prev">‹</label>
						<label for="img-2" class="next">›</label>
					</div>
				</li>

				<input type="radio" name="radio-btn" id="img-2">
				<li class="slide-container">
					<div class="slide">
						<img src="../wp-content/uploads/2021/08/banner_frete_gratis-2.webp" loading="lazy">
					</div>

					<div class="nav">
						<label for="img-1" class="prev">‹</label>
						<label for="img-3" class="next">›</label>
					</div>
				</li>

				<input type="radio" name="radio-btn" id="img-3">
				<li class="slide-container">
					<div class="slide">
						<img src="../wp-content/uploads/2021/08/5-de-desc-a-vista-2.webp" loading="lazy">
					</div>

					<div class="nav">
						<label for="img-2" class="prev">‹</label>
						<label for="img-4" class="next">›</label>
					</div>
				</li>

				<input type="radio" name="radio-btn" id="img-4">
				<li class="slide-container">
					<div class="slide">
						<img src="../wp-content/uploads/2021/11/baixar-app.webp" loading="lazy">
					</div>

					<div class="nav">
						<label for="img-3" class="prev">‹</label>
						<label for="img-1" class="next">›</label>
					</div>
				</li>

				<li class="nav-dots">
					<label for="img-1" class="nav-dot" id="img-dot-1"></label>
					<label for="img-2" class="nav-dot" id="img-dot-2"></label>
					<label for="img-3" class="nav-dot" id="img-dot-3"></label>
					<label for="img-4" class="nav-dot" id="img-dot-4"></label>
				</li>
			</ul>
		</div>

		<script>
			$(document).ready(function(){
		
				var slids = $(".div-slider [type=radio]"); // busca os radios na div
				var slids_len = slids.length; // conta o número de radios
				var intervalo = 4; // intervalo em segundos
				
				function rodar(){
						var slids_ativo = $(".div-slider [type=radio]:checked")
						.attr("id")
						.match(/\d+/)[0]; // pega o valor numérico do id do radio checado

						if(slids_ativo == slids_len) slids_ativo = 0; // se estiver no último slide, volta pro primeiro

						slids.eq(slids_ativo).prop("checked", true); // checa o radio da vez
				}
				
				var tempo = setInterval(rodar, intervalo*1000); // inicia o temporizador
				
				$(".div-slider").hover(
						function(){ // função quando entra o mouse
							clearInterval(tempo); // cancela o temporizador
						},
						function(){ // função quando retira o mouse
							tempo = setInterval(rodar, intervalo*1000); // reinicia o temporizador
						}
				);
				
			});
		</script>
	<!-- Fim novo Slider -->
	
	<!-- Bloco principal -->

		<div id="mostrarcerto"></div>

		<!-- <a href="../page/1/?product_cat=0&s=esporte&post_type=product"> -->
		<a href="../product/furadeira-e-parafusadeira-bosch-gsr-120-li-2-baterias-12-volts/">
			<div id="banner_esporte_aquatico">
				<?php //wc_add_to_cart_message() ?>
				<?php	
					//$user_id = get_current_user_id();			
				//	if( $user_id == 1 ) {
						?>
							<div id="wrapperContentBannerEsporteAquatico">
								<!-- <img src="../wp-content/uploads/2022/01/banner-esporte-aquatico-1.webp" id="imgEsporteAquatico" /> -->
								<img src="../wp-content/uploads/2022/04/parafusadeira-bosch-duas-baterias-4.webp" id="imgEsporteAquatico" />
								<div id="textosBannerEsporteAquatico">
									<p id="nomeVerao">Furadeira e Parafusadeira</p>
									<p id="nomeCombina">Bosch GSR 120.LI</p>
									<p id="subtituloGarante">Com duas baterias 12 volts</p>
								</div>
							</div>
						<?php
					//}
				?>
			</div>
		</a>

		<div id="barco">
			<?php echo do_shortcode( '[recent_products per_page="10" columns="5" orderby="rand" lazy_load="true"]' ); ?>
		</div>
		
		<!-- Mostra Banner Volantes e Alto Falantes -->
		<div id="banner_principal">
			<div id="banner_volante">
				<a href="../?product_cat=0&s=volante&post_type=product">
					<img src="../wp-content/uploads/2021/12/banner-volante-1.webp" alt="Volantes" style="width:100%;border-radius:8px;"/>
				</a>
			</div>
			
			<div id="banner_volante">
				<a href="../?product_cat=0&s=alto+falante&post_type=product">
					<img src="../wp-content/uploads/2021/12/alto-falantes.webp" alt="Alto Falantes" style="width:100%;border-radius:8px;" />
				</a>
			</div>
		</div>
		
		<!-- Mostra produtos da categoria de iluminação -->
		<div id="barco">
			<div id="mostraTituloCategorias">
				<p id="tituloCategorias">Iluminação <span id="linkVerMais"><a href="../product-category/iluminacao/">Ver mais</a></span> </p>
			</div>
			<?php echo do_shortcode( '[products limit="5" columns="5" category="iluminacao" orderby="rand" lazy_load="true"]' ); ?>
		</div>
		
		<!-- Mostra produtos da categoria de acessorios -->
		<div id="barco">
			<div id="mostraTituloCategorias">
				<p id="tituloCategorias">Acessórios <span id="linkVerMais"><a href="../product-category/nauticos-acessorios/">Ver mais</a></span> </p>
			</div>
			<?php echo do_shortcode( '[products limit="5" columns="5" category="nauticos-acessorios" orderby="rand" lazy_load="true"]' ); ?>
		</div>

	<?php
}
/******************************************************************
 * Corta título dos produtos
 ******************************************************************/
add_filter( 'the_title', 'shorten_woo_product_title', 10, 2 );
function shorten_woo_product_title( $title, $id ) {
    if ( ! is_singular( array( 'product' ) ) && get_post_type( $id ) === 'product' ) {
        return wp_trim_words( $title, 10, '...' ); // change last number to the number of words you want 4
    } else {
        return $title;
    }
}
/******************************************************************
 * Clientes que possuem Betoneira
 ******************************************************************/
add_shortcode('concrete_mixer_client', 'concrete_client');
function concrete_client() {
	if( current_user_can('administrator') ) {

		global $wpdb;
		$find_client = $wpdb->get_results("SELECT * FROM wp_concrete_mixer_client", ARRAY_A);
		?>
			<div id="geral">
				<div>
					<p id="tituloDaPagina">Possíveis Clientes de Caminhões Betoneiras</p>
				</div>
				<?php
					if($find_client) {
						foreach ($find_client as $client) {
							?>
							<div id="listaClientes">
								<p><?php echo $client['nome_empresa']; ?><span style="float:right;">Editar</span></br>
								<span style="font-size:12px;"><?php echo $client['tipo_servico']; ?></span></br>
								<?php echo $client['rua']; ?> - <?php echo $client['cidade']; ?> - <?php echo $client['estado']; ?> - CEP <?php echo $client['cep']; ?></br>
								Telefone: +55 <?php echo $client['telefone']; ?></br>
								WhatsApp: +55 <?php echo $client['whats']; ?></br>
								E-mail: <?php echo $client['email']; ?></br>
								Possui caminhão betoneira? <?php echo $client['tem_betoneira']; ?></br>
								Faz manutenção própria nos caminhões? <?php echo $client['faz_manutencao']; ?></br>
							</div>
			<?php		}
					} else {
						?>
							<div id="listaClientes">
								<p>Nenhum cliente cadastrado ainda.</p>
							</div>
						<?php
					}
			?>

				<div id="adicionar_novo">
					<a onclick="adiciona_novo();" id="btn_add_client">Adicionar novo cliente</a>
				</div>

				<script>
					function adiciona_novo() {
						document.getElementById('adicionar_novo').innerHTML=`
							<div id="listaClientes" class="aparecer_suave">
								<form id="form_add_client" action="../add-concrete-mixer-client/" method="POST">

									<div id="new_client_1">
										<label id="add_label">Nome da Empresa: </label></br>
										<input type="text" name="nomeDaEmpresa" id="nomeDaEmpresa" class="input_new_client" placeholder="Nome da Empresa" onkeypress="doNothing()" autofocus>
									</div>

									<div id="new_client_2">
										<label id="add_label">Tipo de Serviço: </label></br>
										<input type="text" name="tipoDeServico" id="tipoDeServico" class="input_new_client" placeholder="Tipo de Serviço" onkeypress="doNothing()">
									</div>

									<div id="new_client_1">
										<label id="add_label">Rua: </label></br>
										<input type="text" name="rua" id="rua" class="input_new_client" placeholder="Rua e Número" onkeypress="doNothing()">
									</div>

									<div id="new_client_2">
										<label id="add_label">Bairro: </label></br>
										<input type="text" name="bairro" id="bairro" class="input_new_client" placeholder="Bairro" onkeypress="doNothing()">
									</div>

									<div id="new_client_1">
										<label id="add_label">Cidade: </label></br>
										<input type="text" name="cidade" id="cidade" class="input_new_client" placeholder="Cidade" onkeypress="doNothing()">
									</div>

									<div id="new_client_2">
										<label id="add_label">Estado: </label></br>
										<input type="text" name="estado" id="estado" class="input_new_client" placeholder="Estado" onkeypress="doNothing()">
									</div>

									<div id="new_client_1">
										<label id="add_label">CEP: </label></br>
										<input type="text" name="cep" id="cep" class="input_new_client" placeholder="00000-000" onkeypress="doNothing()">
									</div>

									<div id="new_client_2">
										<label id="add_label">Telefone: </label></br>
										<input type="tel" name="telefone" id="telefone" class="input_new_client" placeholder="(xx) xxxx-xxxx" onkeypress="doNothing()">
									</div>

									<div id="new_client_1">
										<label id="add_label">WhatsApp: </label></br>
										<input type="tel" name="whats" id="whats" class="input_new_client" placeholder="(xx) x xxxx-xxxx" onkeypress="doNothing()">
									</div>

									<div id="new_client_2">
										<label id="add_label">E-mail: </label></br>
										<input type="email" name="email" id="email" class="input_new_client" placeholder="exemplo@diamondnautica.com.br" onkeypress="doNothing()">
									</div>

									<div id="new_client_1">
										<label id="add_label">Possui caminhão Betoneira? </label></br>
										<span id="input_radio"><input type="radio" name="tem_betoneira" id="tem_betoneira" value="1"/> Sim </span>
										<input type="radio" name="tem_betoneira" id="tem_betoneira" value="0"/> Não
									</div>

									<div id="new_client_2">
										<label id="add_label">Faz manutenção própria nos caminhões? </label></br>								
										<span id="input_radio"><input type="radio" name="faz_manutencao" id="faz_manutencao" value="1"/> Sim </span>
										<input type="radio" name="faz_manutencao" id="faz_manutencao" value="0"/> Não
									</div>

									<input type="submit" name="submit" id="submit" class="btn_add_client" value="Adicionar Cliente"">
								</form>
							</div>
						`;
					}

					function doNothing() {  
						var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
						if( keyCode == 13 ) {


							if(!e) var e = window.event;

								e.cancelBubble = true;
								e.returnValue = false;

								if (e.stopPropagation) {
									e.stopPropagation();
									e.preventDefault();
								}
						}
					} 
				</script>

			</div>
		<?php
	} else {
		?>
			<script>
				window.location.href='../my-account/';
			</script>
		<?php
	}
}
/**
 * Adiciona novo cliente de caminhão betoneira
 */
add_shortcode('concrete_mixer', 'concrete_mixer_client');
function concrete_mixer_client() {	
	$nome_empresa		= $_POST[ 'nomeDaEmpresa' ];
	$tipoDeServico		= $_POST[ 'tipoDeServico' ];
	$rua				= $_POST[ 'rua' ];
	$bairro				= $_POST[ 'bairro' ];
	$cidade				= $_POST[ 'cidade' ];
	$estado				= $_POST[ 'estado' ];
	$cep				= $_POST[ 'cep' ];
	$telefone			= $_POST[ 'telefone' ];
	$whats				= $_POST[ 'whats' ];
	$email				= $_POST[ 'email' ];
	$tem_betoneira		= $_POST[ 'tem_betoneira' ];
	$faz_manutencao		= $_POST[ 'faz_manutencao' ];

	if(is_user_logged_in()) {
		global $wpdb;
		$add_concrete_mix = $wpdb->query("INSERT INTO wp_concrete_mixer_client(id, nome_empresa, tipo_servico, rua, bairro, cidade, estado, cep, telefone, whatsapp, email, tem_betoneira, faz_manutencao) VALUES('', '$nome_empresa', '$tipoDeServico', '$rua', '$bairro', '$cidade', '$estado', '$cep', '$telefone', '$whats', '$email', '$tem_betoneira', '$faz_manutencao')");

		if($add_concrete_mix) {
			echo 'ok';
			?>
				<script>
					window.location.href='https://diamondnautica.com.br/concrete-mixer-client?result=ok';
				</script>
			<?php
			wp_die();
		} else {
			echo 'nok';
			?>
				<script>
					window.location.href='https://diamondnautica.com.br/concrete-mixer-client?result=nok';
				</script>
			<?php
			wp_die();
		}
	} else {
		?>
			<script>
				window.location.href='https://diamondnautica.com.br/my-account/';
			</script>
		<?php
	}
}
/**
 * Novo painel do cliente
 */
add_shortcode('dashboard', 'add_dashboard');
function add_dashboard() {
	if( current_user_can('administrator') ) {
	?>
		<div id="container_dashboard">

			<input type="checkbox" id="check">
			<label class="icone" for="check"><i class="fa fa-bars" aria-hidden="true"></i> </label>

			<div id="add_lateral_icones">

				<div id="add_btn_painel_active">
					<i class="fa fa-home" id="img_painel"></i>
				</div>

				<a href="../dados-pessoais/">
					<div id="add_btn_painel">
						<i class="fa fa-id-card" id="img_painel"></i>
					</div>
				</a>

				<div id="add_btn_painel">
					<i class="fa fa-map" id="img_painel"></i>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-cart-arrow-down" id="img_painel"></i>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-book" id="img_painel"></i>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-sign-out" id="img_painel"></i>
				</div>

				<!-- Configurações para Administrador -->
				<?php
					if( current_user_can('administrator') ) {
				?>
				<div id="add_btn_painel">
					<i class="fa fa-opencart" id="img_painel"></i>
				</div>

				<?php
					}
				?>
			</div>

			<div id="add_lateral">

				<div id="add_btn_painel_active">
					<i class="fa fa-home" id="img_painel"></i> <span id="label_painel"> Painel</span>
				</div>

				<div id="add_btn_painel" onclick="chama_dados_pessoais();">
					<i class="fa fa-id-card" id="img_painel"></i> <span id="label_painel"> Dados Pessoais</span>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-map" id="img_painel"></i> <span id="label_painel"> Endereço</span>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-cart-arrow-down" id="img_painel"></i> <span id="label_painel"> Pedidos</span>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-book" id="img_painel"></i> <span id="label_painel"> Manuais</span>
				</div>

				<div id="add_btn_painel">
					<i class="fa fa-sign-out" id="img_painel"></i> <span id="label_painel"> Sair</span>
				</div>

				<!-- Configurações para Administrador -->
				<?php
					if( current_user_can('administrator') ) {
				?>
				<div id="add_btn_painel">
					<i class="fa fa-opencart" id="img_painel"></i> <span id="label_painel"> Pedidos em Aberto</span>
				</div>

				<?php
					}
				?>
			</div>

			<div id="add_corpo" class="aparecer_suave">
				<div id="nome_cliente"> <!-- Div nome do cliente -->
					<p id="centraliza_nome_cliente">
						<?php
							$current_user = wp_get_current_user(); 
							printf( __( 'Ol&aacute;, %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
						?>
					</p>
				</div> <!-- Div nome do cliente -->

				<div id="mostraTelaBoasVindas"> <!--Mostra tela de boas vindas-->
					<div id="novo_qr_code"> <!-- Div qr code -->
						<img src="../wp-content/uploads/2021/07/img-sharing.jpg" id="img_background"/>
						<p id="texto_qr_code">
							Compartilhe nosso site enviando este Qr Code para seus amigos
						</p>	

						<img src="../wp-content/uploads/2020/11/qr-code.jpeg" id="img_qr_code">

					</div> <!-- Div qr code -->

					<div id="contas_bancarias"> <!-- Div contas -->
						
						<div id="novo_banner_contas">
							<p>
								Transferência ou Deposito Banc&aacute;rio ?
							</p>
						</div>

						<div id="novo_mostra_bancos"> <!-- Div qr code -->
							<img src="../wp-content/uploads/2021/07/img-banking-santander-2.jpg" id="img_background"/>
							<p id="texto_qr_code">
								Banco Santander
							</p>	

							<div id="novo_bancos">
								<p id="escreve_contas">Nome da Conta: Pedro Henrique Matte-ME</br>
								CNPJ: 25.314.854/0001-73</br>
								Banco: Santander - 033</br>
								Número da Conta: 13003486-1</br>
								Agência: 3872</p>
								<p id="escreve_pix">Pix</p>
								<p id="escreve_contas"><img src="../wp-content/uploads/2021/07/pix.png" width="30"/> <strong>CNPJ: </strong>25.314.854/0001-73</p>
							</div>

						</div> <!-- Div qr code -->	

						<div id="novo_mostra_bancos"> <!-- Div qr code -->
							<img src="../wp-content/uploads/2021/07/img-banking-sicoob-1.jpg" id="img_background"/>
							<p id="texto_qr_code">
								Banco Sicoob
							</p>					

							<div id="novo_bancos">
								<p id="escreve_contas">Nome da Conta: Pedro Henrique Matte-ME</br>
								CNPJ: 25.314.854/0001-73</br>
								Banco: Banco Cooperativo do Brasil S/A - 756</br>
								Número da Conta: 245472-6</br>
								Agência: 3069</p>
								<p id="escreve_pix">Pix</p>
								<p id="escreve_contas"><img src="../wp-content/uploads/2021/07/pix.png" width="30"/> <strong>Celular: </strong>(47) 9.9920-2022</p>
							</div>

						</div> <!-- Div qr code -->	

						
					</div> <!-- Div contas -->
				</div> <!--Fim tela de boas vindas-->
			</div>
		</div>
	<?php
	} else {
		?>
			<script>
				window.location.href='../my-account/';
			</script>
		<?php
	}
}
/**
 * Mostra dados pessoais
 */
add_shortcode('dados-pessoais', 'dados_pessoais');
function dados_pessoais() {
	if( current_user_can('administrator') ) {
	?>
	<div id="container_dashboard">

		<input type="checkbox" id="check">
		<label class="icone" for="check"><i class="fa fa-bars" aria-hidden="true"></i> </label>

		<div id="add_lateral_icones">

			<a href="../dashboard/">
				<div id="add_btn_painel">
					<i class="fa fa-home" id="img_painel"></i>
				</div>
			</a>

			<div id="add_btn_painel_active">
				<i class="fa fa-id-card" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-map" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-cart-arrow-down" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-book" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-sign-out" id="img_painel"></i>
			</div>

			<!-- Configurações para Administrador -->
			<?php
				if( current_user_can('administrator') ) {
			?>
			<div id="add_btn_painel">
				<i class="fa fa-opencart" id="img_painel"></i>
			</div>

			<?php
				}
			?>
		</div>

		<div id="add_lateral">

			<div id="add_btn_painel" onclick="chama_inicio();">
				<i class="fa fa-home" id="img_painel"></i> <span id="label_painel"> Painel</span>
			</div>

			<div id="add_btn_painel_active">
				<i class="fa fa-id-card" id="img_painel"></i> <span id="label_painel"> Dados Pessoais</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-map" id="img_painel"></i> <span id="label_painel"> Endereço</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-cart-arrow-down" id="img_painel"></i> <span id="label_painel"> Pedidos</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-book" id="img_painel"></i> <span id="label_painel"> Manuais</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-sign-out" id="img_painel"></i> <span id="label_painel"> Sair</span>
			</div>

			<!-- Configurações para Administrador -->
			<?php
				if( current_user_can('administrator') ) {
			?>
			<div id="add_btn_painel">
				<i class="fa fa-opencart" id="img_painel"></i> <span id="label_painel"> Pedidos em Aberto</span>
			</div>

			<?php
				}
			?>
		</div>

		<div id="add_corpo" class="aparecer_suave">
			<div id="nome_cliente"> <!-- Div nome do cliente -->
				<p id="centraliza_nome_cliente">
					<?php
						$current_user = wp_get_current_user(); 
						printf( __( 'Ol&aacute;, %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
					?>
				</p>
			</div> <!-- Div nome do cliente -->

			<div id="mostraTelaBoasVindas"> <!--Mostra tela de boas vindas-->
				<div id="form_dados_pessoais">
					<p>Para que você tenha uma melhor experiência ao utilizar o nosso sistema, é importante que seus dados estejam completos e atualizados.</p>
				</div>

				<div id="mostra_caixas">
					<p id="mostra_login">Dados pessoais</p>								
					<?php
						global $wpdb;
						$user = wp_get_current_user();
						$id = $user->ID;

						$dados_login = $wpdb->get_results("SELECT * FROM wp_users WHERE ID = '$id'", ARRAY_A);

						foreach($dados_login as $dados_entrar) {
							// Não faz nada por enquanto
						}

						$first_name_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'billing_first_name'", ARRAY_A);

						foreach($first_name_cliente as $primeiro_nome) {
							//Não faz nada por enquanto
						}

						$last_name_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'billing_last_name'", ARRAY_A);

						foreach($last_name_cliente as $ultimo_nome) {
							//Não faz nada por enquanto
						}

						$cpf_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'billing_cpf'", ARRAY_A);

						foreach($cpf_cliente as $cpf) {
							//Não faz nada por enquanto
						}

						$telefone_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'billing_phone'", ARRAY_A);

						foreach($telefone_cliente as $telefone_residencial) {
							//Não faz nada por enquanto
						}

						$celular_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'billing_cellphone'", ARRAY_A);

						foreach($celular_cliente as $celular) {
							//Não faz nada por enquanto
						}

						$facebook_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'facebook'", ARRAY_A);

						foreach($facebook_cliente as $face_cliente) {
							//Não faz nada por enquanto
						}

						$instagram_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'instagram'", ARRAY_A);

						foreach($instagram_cliente as $insta) {
							//Não faz nada por enquanto
						}

						$linkedin_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'linkedin'", ARRAY_A);

						foreach($linkedin_cliente as $linkedin) {
							//Não faz nada por enquanto
						}

						$twitter_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'twitter'", ARRAY_A);

						foreach($twitter_cliente as $twitter) {
							//Não faz nada por enquanto
						}

						$youtube_cliente = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = '$id' AND meta_key = 'youtube'", ARRAY_A);

						foreach($youtube_cliente as $youtube) {
							//Não faz nada por enquanto
						}
					?>
					<form action="../atualiza-dados-pessoais/" method="post">
						<label id="dados_login">Nome de Exibição</label>
						<input type="text" name="nomeExibicao" id="nomeExibicao" class="input_new_client" placeholder="Digite o nome que será exibido em nosso site" value="<?php echo $dados_entrar['display_name']; ?>" />

						<label id="dados_login">Primeiro Nome</label>
						<input type="text" name="primeiroNome" id="primeiroNome" class="input_new_client" placeholder="Digite seu primeiro nome" value="<?php echo $primeiro_nome['meta_value']; ?>" />

						<label id="dados_login">Último Nome</label>
						<input type="text" name="ultimoNome" id="ultimoNome" class="input_new_client" placeholder="Digite o seu último nome" value="<?php echo $ultimo_nome['meta_value']; ?>" />									

						<label id="dados_login">CPF</label>
						<input type="text" name="cpf" id="cpf" class="input_new_client" placeholder="Digite o seu CPF" value="<?php echo $cpf['meta_value']; ?>" />		

						<label id="dados_login">Telefone Residencial</label>
						<input type="text" name="telefoneResidencial" id="telefoneResidencial" class="input_new_client" placeholder="Digite o telefone de contato" value="<?php echo $telefone_residencial['meta_value']; ?>" />								

						<label id="dados_login">Celular</label>
						<input type="text" name="celular" id="celular" class="input_new_client" placeholder="Digite o seu celular" value="<?php echo $celular['meta_value']; ?>" />

						<label id="dados_login">Facebook</label>
						<input type="text" name="facebook" id="facebook" class="input_new_client" placeholder="Cole aqui a URL do seu perfil no Facebook" value="<?php echo $face_cliente['meta_value']; ?>" />								

						<label id="dados_login">Instagram</label>
						<input type="text" name="instagram" id="instagram" class="input_new_client" placeholder="Cole aqui a URL do seu perfil no Instagram" value="<?php echo $insta['meta_value']; ?>" />								

						<label id="dados_login">Linkedin</label>
						<input type="text" name="linkedin" id="linkedin" class="input_new_client" placeholder="Cole aqui a URL do seu perfil no Linkedin" value="<?php echo $linkedin['meta_value']; ?>" />								

						<label id="dados_login">Twitter</label>
						<input type="text" name="twitter" id="twitter" class="input_new_client" placeholder="Cole aqui a URL do seu perfil no Twitter" value="<?php echo $twitter['meta_value']; ?>" />								

						<label id="dados_login">Youtube</label>
						<input type="text" name="youtube" id="youtube" class="input_new_client" placeholder="Cole a URL do seu Canal no Youtube" value="<?php echo $youtube['meta_value']; ?>" />
						
						<input type="submit" name="btn_atualizar_dados_pessoais" id="btn_atualizar_dados_pessoais" class="input_new_client" value="Atualizar dados"/>
					</form>
				</div>

				<div id="mostra_caixas">
					<p id="mostra_login">Dados para login</p>							
					<?php
						global $wpdb;
						$user = wp_get_current_user();
						$id = $user->ID;

						$dados_login = $wpdb->get_results("SELECT * FROM wp_users WHERE ID = '$id'", ARRAY_A);

						foreach($dados_login as $dados_entrar) {
							// Não faz nada por enquanto
						}
					?>
					<form action="#" method="post">
						<label id="dados_login">Nome de Usuário</label>
						<input type="text" name="nomeDeUsuario" id="nomeDeUsuario" placeholder="Digite o seu nome de usuário" value="<?php echo $dados_entrar['user_login']; ?>" readonly/>

						<label id="dados_login">E-mail</label>
						<input type="text" name="email" id="email" placeholder="Digite o seu melhor e-mail" value="<?php echo $dados_entrar['user_email']; ?>" readonly/>

						<label id="dados_login">Senha atual</label>
						<input type="password" name="senhaAtual" id="senhaAtual" class="input_new_client" placeholder="Digite a sua senha atual" />									
						<label id="dados_login">Nova senha</label>
						<input type="password" name="novaSenha" id="novaSenha" class="input_new_client" placeholder="Digite a nova senha" />		

						<label id="dados_login">Confirme a nova senha</label>
						<input type="password" name="confirmeSenha" id="confirmeSenha" class="input_new_client" placeholder="Repita a nova senha" />
						
						<input type="submit" name="btn_atualizar_dados_pessoais" id="btn_atualizar_dados_pessoais" class="input_new_client" value="Atualizar senha"/>
					</form>
				</div>

			</div> <!--Fim tela de boas vindas-->
		</div>
	</div>

	<?php
	} else {
		?>
			<script>
				window.location.href='../my-account/';
			</script>
		<?php
	}

}
/**
 * Atualiza dados pessoais
 */
add_shortcode('atualiza-dados-pessoais', 'atualiza_dados_pessoais');
function atualiza_dados_pessoais() {
	if( current_user_can('administrator') ) {
		global $wpdb;
		$nome_exibição	= $_POST['nomeExibicao'];
		$primeiro_nome	= $_POST['primeiroNome'];
		$ultimo_nome	= $_POST['ultimoNome'];
		$cpf			= $_POST['cpf'];
		$fone_casa		= $_POST['telefoneResidencial'];
		$fone_movel		= $_POST['celular'];
		$face			= $_POST['facebook'];
		$insta			= $_POST['instagram'];
		$linkedin		= $_POST['linkedin'];
		$twitter		= $_POST['twitter'];
		$youtube		= $_POST['youtube'];
	?>

		<input type="checkbox" id="check">
		<label class="icone" for="check"><i class="fa fa-bars" aria-hidden="true"></i> </label>

		<div id="add_lateral_icones">

			<a href="../dashboard/">
				<div id="add_btn_painel">
					<i class="fa fa-home" id="img_painel"></i>
				</div>
			</a>

			<a href="../dados-pessoais/">
				<div id="add_btn_painel_active">
					<i class="fa fa-id-card" id="img_painel"></i>
				</div>
			</a>

			<div id="add_btn_painel">
				<i class="fa fa-map" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-cart-arrow-down" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-book" id="img_painel"></i>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-sign-out" id="img_painel"></i>
			</div>

			<!-- Configurações para Administrador -->
			<?php
				if( current_user_can('administrator') ) {
			?>
			<div id="add_btn_painel">
				<i class="fa fa-opencart" id="img_painel"></i>
			</div>

			<?php
				}
			?>
		</div>

		<div id="add_lateral">

			<div id="add_btn_painel_active">
				<i class="fa fa-home" id="img_painel"></i> <span id="label_painel"> Painel</span>
			</div>

			<div id="add_btn_painel" onclick="chama_dados_pessoais();">
				<i class="fa fa-id-card" id="img_painel"></i> <span id="label_painel"> Dados Pessoais</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-map" id="img_painel"></i> <span id="label_painel"> Endereço</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-cart-arrow-down" id="img_painel"></i> <span id="label_painel"> Pedidos</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-book" id="img_painel"></i> <span id="label_painel"> Manuais</span>
			</div>

			<div id="add_btn_painel">
				<i class="fa fa-sign-out" id="img_painel"></i> <span id="label_painel"> Sair</span>
			</div>

			<!-- Configurações para Administrador -->
			<?php
				if( current_user_can('administrator') ) {
			?>
			<div id="add_btn_painel">
				<i class="fa fa-opencart" id="img_painel"></i> <span id="label_painel"> Pedidos em Aberto</span>
			</div>

			<?php
				}
			?>
		</div>

		<div id="add_corpo_atualiza" class="aparecer_suave">
			<div id="mostraTelaBoasVindas"> <!--Mostra tela de boas vindas-->
				<div>
					<img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone-carregando.gif" id="mostraloading" />
					<?php 
						echo $nome_exibição . "\n" . $primeiro_nome . "\n" . $ultimo_nome . "\n" . $cpf . "\n" . $fone_casa . "\n" . $fone_movel . "\n" . $face . "\n" . $insta . "\n" . $linkedin . "\n" . $twitter . "\n" . $youtube;
					?>
				</div>
			</div> <!--Fim tela de boas vindas-->
		</div>

	<?php
	} else {
		?>
			<script>
				window.location.href='../my-account/';
			</script>
		<?php
	}
}
/**
 * Mostrar imagem em link de compartilhamento
 */
// Open Graph nos atributos de linguagem
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Meta info
function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) { //se não é post ou página
		return;
		/* echo ''; */
		echo '';
		echo '';
		echo '';
		echo '';
		if ( !has_post_thumbnail( $post->ID ) ) { //se o post não tiver uma imagem destacada, usar a imagem padrão
			$default_image = "./wp-content/uploads/2020/05/logo_2-1.png"; //substitua por uma imagem do seu site (geralmente uma imagem de logo)
			echo '';
		}
		else {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
			echo '';
		}
	}
	echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

/**
 * This is our callback function that embeds our phrase in a WP_REST_Response
 */
function prefix_get_endpoint_phrase() {
	// rest_ensure_response() wraps the data we want to return into a WP_REST_Response, and ensures it will be properly returned.
	return rest_ensure_response( 'Iniciando testes com API! Diamond Náutica!' );
}

/**
* This function is where we register our routes for our example endpoint.
*/
function prefix_register_example_routes() {
	// register_rest_route() handles more arguments but we are going to stick to the basics for now.
	register_rest_route( 'hello-world/v1', '/phrase', array(
			// By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
			'methods'  => WP_REST_Server::READABLE,
			// Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
			'callback' => 'prefix_get_endpoint_phrase',
	) );
}

add_action( 'rest_api_init', 'prefix_register_example_routes' );