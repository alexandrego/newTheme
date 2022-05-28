<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @//since 2.6.0
 */
//do_action( 'woocommerce_account_navigation' ); ?>

<!-- <div class="woocommerce-MyAccount-content">

	<?php
		/**
		 * My Account content.
		 *
		 * @//since 2.6.0
		 */
		//do_action( 'woocommerce_account_content' );
	?>
</div> -->

<div id="qr_code">
	<p id="texto_banner">
		Compartilhe nosso site enviando este Qr Code para seus amigos
	</p>	
	<img src="https://diamondnautica.com.br/wp-content/uploads/2020/11/qr-code.jpeg" id="img_qr">
</div>

<!-- <div id="contas_banco"> -->
	<p id="banner_contas">
		Transferência, Deposito Banc&aacute;rio ou PIX</br>
		<span id="escreve_contas">Nome das Contas: Pedro Henrique Matte-ME</span>
	</p>
	<div id="bancos">
		<p id="escreve_contas">
		CNPJ: 25.314.854/0001-73</br>
		Banco: Banco Cooperativo do Brasil S/A - 756</br>
		Número da Conta: 245472-6</br>
		Agência: 3069</p>
	</div>
	<div id="bancos">
		<p id="escreve_contas">
		CNPJ: 25.314.854/0001-73</br>
		Banco: Santander - 033</br>
		Número da Conta: 13003486-1</br>
		Agência: 3872</p>
	</div>
	<div id="bancos">
		<div id="infoPix">
			<p id="chavepix">Faça um PIX no valor do seu pedido</p>
		</div>
		
		<div id="mostraBancos">
			<img src="../wp-content/uploads/2021/05/santander.jpg" width="30" id="ajustaImgBanco" /><br><span id="infBanco">Santander</br>Chave PIX CNPJ</br><span id="numPix">25314854000173</span></span>
		</div>
		
		<div id="mostraBancos">
			<img src="../wp-content/uploads/2021/05/sicoob-1.jpg" width="30"  id="ajustaImgBanco" /><br><span id="infBanco">SICOOB</br>Chave PIX CELULAR</br><span id="numPix">47999202022</span></span>
		</div>
		
	</div>
<!-- </div> -->
</br><span id="pedidosAberto"></span>

<?php 
	if( current_user_can('administrator') ) {
		?>
			<div>
				<p id="titulobemvindo">Pedidos em aberto</p>
				<!-- Exibe mensagens de confirmação -->
				<?php
					/*************  Recebe dados da confirmação de pagamento do pedido  *****************/
					//Mensagem de Confirmação de pagamento
					//$pagamento=$_GET['pagamento'];
					//$numer_pedido=$_GET['pedidoid'];
					//if(empty($pagamento)){
					if(empty($_SESSION['pagamento'])){
						//Não mostra nada
					} else {
						//if($pagamento == 'ok'){
						session_start();
						if($_SESSION['pagamento'] == 'ok'){
							//echo "<script>alert('Status Atualizado com Sucesso!');</script>";
							echo "<div class='alerta sucesso' id='msg-success'><span id='alertaSucesso'>Sucesso!</span> Pagamento confirmado para o pedido #{$_SESSION['num_pedido']}</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";
								unset($_SESSION['pagamento']);
								unset($_SESSION['num_pedido']);	
						} else {
							//echo "<script>alert('Erro ao Atualizar Status!');</script>";
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Erro ao confirmar pagamento para o pedido #{$_SESSION['num_pedido']}, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";
								unset($_SESSION['pagamento']);
								unset($_SESSION['num_pedido']);	
						}						
					}
					/*************  Recebe dados da confirmação que o pedido já está preparado para envio ***********/
					if(empty($_SESSION['preparado'])){
						//Não mostra nada
					} else {	
						session_start();					
						if($_SESSION['preparado'] == 'ok'){
							echo "<div class='alerta sucesso' id='msg-success'><span id='alertaSucesso'>Sucesso!</span> Obrigado por ter preparado o pedido #{$_SESSION['num_pedido']}</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";
								unset($_SESSION['preparado']);
								unset($_SESSION['num_pedido']);
						} else {							
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Erro ao informar que o pedido #{$_SESSION['num_pedido']}, foi preparado, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";	
								unset($_SESSION['preparado']);
								unset($_SESSION['num_pedido']);	
						}
					}
					/*************  Recebe dados da confirmação de anexo da nota fiscal do pedido  *****************/
					//$recebe_nota=$_GET['nota'];
					//if(empty($recebe_nota)){
					if(empty($_SESSION['nota'])){
						//Não mostra nada
					} else {
						session_start();
						//echo "<script>alert('Nota Fiscal Anexada com Sucesso!');</script>";
						if($_SESSION['nota'] == 'ok') {
							echo "<div class='alerta sucesso' id='msg-success'><span id='alertaSucesso'>Sucesso!</span> Nota fiscal anexada com sucesso para o pedido #{$_SESSION['num_pedido']}</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";
								unset($_SESSION['nota']);
								unset($_SESSION['num_pedido']);	
						} else {
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Erro ao anexar nota fiscal para o pedido #{$_SESSION['num_pedido']}, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";	
								unset($_SESSION['nota']);
								unset($_SESSION['num_pedido']);	
						}
					}
					/*************  Recebe confirmação de adição de detalhes do frete  *****************/
					//$add=$_GET['frete'];
					//if(empty($add)){
					//session_start();
					if(empty($_SESSION['add'])){
						//Não mostra nada
					} else {
						session_start();
							//echo "<script>alert('Erro ao Adicionar detalhes do frete!</br>Por favor tente novamente! ');</script>";
						if($_SESSION['add'] == 'error'){
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Erro ao adicionar detalhes do frete para o pedido #{$_SESSION['num_pedido']}, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";	
								unset($_SESSION['add']);
								unset($_SESSION['num_pedido']);	
						}					
					}
					/*************  Recebe confirmação de atualização apos inserir detalhes do frete  *****************/
					//$update=$_GET['update'];
					//if(empty($update)){
					//session_start();
					if(empty($_SESSION['update'])){
						//Não mostra nada
					} else {
						session_start();
							//echo "<script>alert('Detalhes do frete inserido com sucesso!</br>Porém não consegui atualizar o status do pedido!</br>Por favor tente novamente! ');</script>";
						if($_SESSION['update'] == 'error'){
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Detalhes do frete inserido com sucesso!</br>Porém não consegui atualizar o status do pedido #{$_SESSION['num_pedido']}, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";	
								unset($_SESSION['update']);
								unset($_SESSION['num_pedido']);	
						}					
					}
					/*********  Recebe confirmação de atualização apos inserir data de alteração do frete  ************/
					//session_start();
					if(empty($_SESSION['frete'])){
						//Não mostra nada
					} else {
						session_start();
						if($_SESSION['frete'] == 'error'){
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Detalhes do frete inserido com sucesso!</br>
							Status do pedido atualizado com sucesso!</br>
							Porém não consegui salvar data de modificação do pedido #{$_SESSION['num_pedido']}, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";	
								unset($_SESSION['frete']);
								unset($_SESSION['num_pedido']);	
						} else {							
							echo "<div class='alerta sucesso' id='msg-success'><span id='alertaSucesso'>Sucesso!</span> Detalhes do frete adicionados com sucesso para o pedido #{$_SESSION['num_pedido']}</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";
								unset($_SESSION['frete']);
								unset($_SESSION['num_pedido']);	
						}					
					}
					/*************  Recebe confirmação se o pedido foi concluido com sucesso  *****************/		
					if(empty($_SESSION['concluido'])){
						//Não mostra nada
					} else {
						session_start();
						//echo "<script>alert('Nota Fiscal Anexada com Sucesso!');</script>";
						if($_SESSION['concluido'] == 'ok') {
							echo "<div class='alerta sucesso' id='msg-success'><span id='alertaSucesso'>Sucesso!</span> O pedido #{$_SESSION['num_pedido']}, foi entregue ao cliente, por este motivo ele não aparecerá mais nesta lista.</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";
								unset($_SESSION['concluido']);
								unset($_SESSION['num_pedido']);	
						} else {
							echo "<div class='alerta error' id='msg-success'><span id='alertaSucesso'>Erro!</span> Erro ao concluir o pedido #{$_SESSION['num_pedido']}, tente novamente</div>";
							echo "<script>
									setTimeout(function(){ 
										var msg = document.getElementById('msg-success');
										msg.parentNode.removeChild(msg);   
									}, 15000);
								</script>";	
								unset($_SESSION['concluido']);
								unset($_SESSION['num_pedido']);	
						}
					}
				?>
				<!-- Fim exibição de mensagens de confirmação -->

				<?php 
					//Busca pedidos
					global $wpdb;
					$todos_pedidos = $wpdb->get_results($wpdb->prepare(
					"SELECT * 
					FROM wp_wc_order_stats
					WHERE status = 'wc-processing'
					OR status = 'wc-invoice'
					OR status = 'wc-on-hold'
					OR status = 'wc-pending'
					OR status = 'wc-shipped'", ARRAY_A));
		
					//Inicia contador de pedido
					$count=1;
				?>				
				<table id="tabela_admin">
					<tr align="center">
						<td>
							
						</td>
						<td>
							Número do pedido
						</td>
						<td>
							Nome do Cliente
						</td>
						<td>
							Status do Pedido
						</td>
						<td>
							Valor Pago
						</td>
						<td>
							Ações
						</td>
					</tr>
					
					<!-- Resultados da consulta -->
					<?php
					if ($todos_pedidos){
						foreach ($todos_pedidos as $cliente) {
							//Prepara ID do cliente
							$id_cliente=$cliente->customer_id;
							//echo '<pre>'.print_r($id_cliente, true).'</pre>';
							//Consulta dados do pedido
							global $wpdb;
							/* $pedidos_abertos = $wpdb->get_results($wpdb->prepare(
								"SELECT * 
								FROM wp_users 
								WHERE ID = $id_cliente", ARRAY_A)); */

							$pedidos_abertos = $wpdb->get_results($wpdb->prepare(
								"SELECT first_name, last_name 
								FROM wp_wc_customer_lookup 
								WHERE customer_id = $id_cliente", ARRAY_A));
								//print_r ($pedidos_abertos);
								//echo '<pre>'.print_r($pedidos_abertos, true).'</pre>';
								//var_dump($pedidos_abertos);

								//Prepara nome do cliente
								//$nome_cliente=$pedidos_abertos['display_name'];
								
								if ($pedidos_abertos){
									foreach ($pedidos_abertos as $nome_cliente){	
										// Função para transformar a primeira letra em maiuscula.
										$primeiro_nome = ucwords(strtolower($nome_cliente->first_name));
										$segundo_nome = ucwords(strtolower($nome_cliente->last_name));									
					?>	
										<tr id="lista_pedidos" align="center">
											<td>
												<?php
													echo $count++;
												?>
											</td>
											<td>
												<?php
													echo '<a href="https://diamondnautica.com.br/detalhe-do-pedido/?pedido=' . $cliente->order_id . '"><span>#' . $cliente->order_id . '</span></a>';
												?>
											</td>
											<td>
												<?php
													echo $primeiro_nome.' '. $segundo_nome;
												?>
											</td>
											<td>
												<?php
													if ($cliente->status == 'wc-on-hold' || $cliente->status == 'wc-pending'){
														//Escreva
														echo 'Aguardando pagamento';
													} else if ($cliente->status == 'wc-processing') {
														//Escreva
														echo 'Preparando pedido para envio';
													} else if ($cliente->status == 'wc-invoice') {
														//Consulta dados do pedido
														global $wpdb;
														$consulta_nota = $wpdb->get_results($wpdb->prepare(
															"SELECT * 
															FROM wp_nota_fiscal 
															WHERE id_pedido = $cliente->order_id", ARRAY_A));
														
														//Verifica se tem Nota_Fiscal
														if ($consulta_nota){
															//Mostra OK
															echo 'Nota Fiscal Anexada &nbsp;&nbsp;'; ?>
																<img src="https://diamondnautica.com.br/wp-content/uploads/2020/09/ok.png" width="18" id="imgNotaFiscal" /> <?php
														} else {
															//Escreva
															echo 'Anexar Nota Fiscal&nbsp;&nbsp;'; ?>
															<img src="https://diamondnautica.com.br/wp-content/uploads/2020/09/aviso.png" width="18" id="imgNotaFiscal" /> <?php
														}
													} else if ($cliente->status == 'wc-shipped') {
														//Escreva
														echo 'Pedido Enviado';
													} else {
														echo '<span>' . $cliente->status . '</span>';
													}
												?>
											</td>
											<td>
												<?php
													echo '<span>R$ ' . number_format($cliente->total_sales,2,",",".") . '</span>';
												?>
											</td>
											<td>
												<!-- <a href="#">Mudar Status</a></br> -->
												<?php
													if($cliente->status == 'wc-pending' || $cliente->status == 'wc-on-hold'){
														//Muda Status para processamento
														?>
														<a href="https://diamondnautica.com.br/muda-status/?pedido_id=<?php echo $cliente->order_id; ?>" class="button">Confirmar Pagamento</a>
														</br>
														<!-- <button type="button" onclick="confirmar_pagamento()">Confirmar Pagamento</button>
															<script>
																function confirmar_pagamento() {
																	var txt;
																	var confirmacao = confirm ("Confirmar o pagamento do pedido?");
																		if(confirmacao == true) {
																			/* txt = "O pagamento do pedido #{$cliente->order_id} foi confirmado com sucesso!"; */
																			<?php
																			/* header('Location: https://diamondnautica.com.br/muda-status/?pedido_id= $cliente->order_id;'); */
																			?>
																		} else {
																			txt = "Ok, está tudo bem.";
																		}
																		window.alert(txt);
																}
															</script> -->
														<?php
														
													} else if ($cliente->status == 'wc-processing') {
														//Muda status para Nota Fiscal
														?><a href="https://diamondnautica.com.br/pedido-preparado/?pedido_id=<?php echo $cliente->order_id; ?>" class="button">Pedido Preparado</a><?php

													} else if ($cliente->status == 'wc-invoice') {
														//Consulta dados do pedido
														global $wpdb;
														$consulta_nota = $wpdb->get_results($wpdb->prepare(
															"SELECT * 
															FROM wp_nota_fiscal 
															WHERE id_pedido = $cliente->order_id", ARRAY_A));
														
														//Verifica se tem Nota_Fiscal
														if($consulta_nota){
															//Adicionar detalhes do frete
														?><a href="https://diamondnautica.com.br/frete/?pedido_id=<?php echo $cliente->order_id; ?>" class="button">Adicionar Detalhes do Frete</a><?php

														} else {
															//Escreve
															?> <a href="https://diamondnautica.com.br/nota-fiscal/?numpedido=<?php echo $cliente->order_id; ?>" class="button">Anexar Nota Fiscal</a></br><?php
														}
													} else if ($cliente->status == 'wc-shipped') {
														//Muda status para Concluido
														?><a href="https://diamondnautica.com.br/pedido-entregue-2/?pedido_id=<?php echo $cliente->order_id; ?>" class="button">Pedido Entregue</a><?php

													}
												?>
											</td>
										</tr>
						<?php 
									}
								} else {
									echo 'Nenhum nome encontrado';
								}
						}	
					} else {
						echo 'Nada encontrado';
					}
					?>
				</table>
			</div>
		<?php
	}
?>

