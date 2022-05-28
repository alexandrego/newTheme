

				<div id="nome_cliente"> <!-- Div nome do cliente -->
					<?php
						$current_user = wp_get_current_user(); 
						printf( __( 'Ol&aacute;, %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
					?>
				</div> <!-- Div nome do cliente -->

				<div id="novo_qr_code"> <!-- Div qr code -->
					<p id="texto_qr_code">
						Compartilhe nosso site enviando este Qr Code para seus amigos
					</p>	

					<img src="https://diamondnautica.com.br/wp-content/uploads/2020/11/qr-code.jpeg" id="img_qr_code">

				</div> <!-- Div qr code -->

				<div id="contas_bancarias"> <!-- Div contas -->
					
					<div id="novo_banner_contas">
						<p>
							Transferência ou Deposito Banc&aacute;rio ?
						</p>
					</div>					

					<div id="novo_bancos">
						<p id="escreve_contas">Nome da Conta: Pedro Henrique Matte-ME</br>
						<span style="font-weight: bold;"> CNPJ: 25.314.854/0001-73  <- Chave PIX</span></br>
						Banco: Banco Cooperativo do Brasil S/A - 756</br>
						Número da Conta: 245472-6</br>
						Agência: 3069</p>
					</div>

					<div id="novo_bancos">
						<p id="escreve_contas">Nome da Conta: Pedro Henrique Matte-ME</br>
						<span style="font-weight: bold;"> CNPJ: 25.314.854/0001-73  <- Chave PIX</span></br>
						Banco: Santander - 033</br>
						Número da Conta: 13003486-1</br>
						Agência: 3872</p>
					</div>
				</div> <!-- Div contas -->