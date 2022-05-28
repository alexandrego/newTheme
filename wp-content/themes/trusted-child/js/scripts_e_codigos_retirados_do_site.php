$(document).ready(function() {
					$('#submit').click(function(){
						var novo_nome = $('input_editar_nome').val();
						
						//document.getElementById('edita_nome').innerHTML = '<label>Nome: </label> <img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span> ';

						/* $('#input_editar_nome').html('');
						if (novo_nome != '<?php echo $user_info->nickname ?>') {
							$('#input_editar_nome').html('<img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span>');
							return false;
						} */
					})
				});




/** Retirado do header */
				<script>
		//function mensagem() {		
		
			/* var valorNome = document.getElementById("input_editar_nome").value;
			var iduser = document.getElementById("id_user").value; */
			//var meta_key = 'nickname';

			/* var funcs_bt1 = {
				func1: function() { */
					//document.getElementById("edita_nome").innerHTML = ' Nome: <img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span> ';
			/* 	}
			}; */

			/* var txt;
			var r = confirm("Deseja alterar seu nome para:" + valorNome);
			if (r == true) {
			txt = "Alteramos seu nome" + valorNome;
			} else {
			txt = "Ok, não alteramos nada!";
			} */

			/* if (window.confirm("Deseja realmente mudar seu nome para " + valorNome + " ?")) {
				document.getElementById("edita_nome").innerHTML = ' Nome: <img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span> ';
				header('Location: https://diamondnautica.com.br/teste/?nome=' + valorNome + '&iduser=' +iduser + '');
				//header('Location: https://diamondnautica.com.br/my-account/#pedidosAberto');
			}else{
				alert("Cancelou Alexandre");
			} */
			

			// Exibir mensagem em caixa de alerta:
			//alert("Bem-vindo, " + valorNome + iduser);

			//$('edita_nome').html(' Nome: <img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span>');
			
			// Will return false if the previous value is the same as $new_value.
			//$updated = update_user_meta( + iduser , + meta_key , + valorNome );
			
			// So check and make sure the stored value matches $new_value.
			//if ( + valorNome != get_user_meta( + iduser , + meta_key , true ) ) {
			//	wp_die( __( 'An error occurred', 'textdomain' ) );
			//}

			// Copiar valor de uma caixa de texto para outra:
			//document.getElementById("idNomeDigitado").value = document.getElementById("idNome").value;

			// Escrever na página (usando conteiner span):
			//document.getElementById("edita_nome").innerHTML = ' Nome: <img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span> ';

			//document.getElementById("edita_nome").innerHTML = " printf( __( 'Nome: %s', 'textdomain' ), esc_html( " + valorNome + ") ) . '</br>'; <sup> <i class='fas fa-edit' id='botao_editar' alt='Clique para editar' onclick='editar_nome()' ></i> </sup> ";

			//$('#edita_nome').html('Nome: <img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu nome ...</span>');

			/* $.ajax( {
				url : 'https://diamondnautica.com.br/teste/',
				type: 'POST', 
				data: {  
					nome  : document.getElementById("input_editar_nome").value(),
					iduser : document.getElementById("id_user").value() 
				},
				beforeSend:function(){
					$("#input_editar_nome").html("<img src='https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif' width='30' id='loading'/> <span id='looding_name'>Alterando o seu nome ...</span>");
				},
				success:function(data) {

					$('#edita_nome').html("data");
						/* var result = html(result);
						if( result == 'ok'){
							$('#edita_nome').html(?php printf( __( 'Nome: %s', 'textdomain' ), esc_html( $user_info->nickname ) ) . '</br>';	?> <sup> <i class="fas fa-edit" id="botao_editar" alt="Clique para editar" onclick="editar_nome()" ></i> </sup>'');

							//document.getElementById('edita_nome').innerHTML = ' ?php printf( __( 'Nome: %s', 'textdomain' ), esc_html( $user_info->nickname ) ) . '</br>';	?> <sup> <i class="fas fa-edit" id="botao_editar" alt="Clique para editar" onclick="editar_nome()" ></i> </sup> ';

							var x = document.getElementById("toast")
							x.className = "show";
							setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
						} *
				},
				error:function(data){
					$('#edita_nome').html("Algo deu errado :(");
				}
			
			}); */
		//}		
	</script>

	##############################################
	
/** retirado do header */
<!-- Exibi o busca CEP em popup na página do produto -->
       <!--  <script languague="javascript"> 

            function popup(){ window.open('http://www.buscacep.correios.com.br/sistemas/buscacep/','popup','width=900,height=480,scrolling=auto,top=50,left=50') }
        </script> -->


        <?php
				//Verifica se o usuário está logado
				if ( is_user_logged_in() ) {
					//Exibe o nome
				?>	<div id="bemvindo">
						<?php
							$current_user = wp_get_current_user();
							//$user_info = get_userdata($current_user->ID);						
							
							/*
							* @example Uso seguro: $current_user = wp_get_current_user();
							* if ( ! ( $current_user instanceof WP_User ) ) {
							*     return;
							* }
							*/
							//printf( __( 'Usuário: %s', 'textdomain' ), esc_html( $current_user->user_login ) ) . '<br />'; //Login do usuário
							//printf( __( 'E-mail: %s', 'textdomain' ), esc_html( $current_user->user_email ) ) . '<br />';// E-mail do usuário
							printf( __( 'Ol&aacute;, %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';// Primeiro nome do usuário
							//printf( __( 'Função: %s', 'textdomain'), esc_html( $user_info->$meta_value ) ) . '<br />';// Exibir função
							//printf( __( 'Sobrenome: %s', 'textdomain' ), esc_html( $current_user->user_lastname ) ) . '<br />';// Segundo nome do usuário
							//printf( __( 'Nome Completo: %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';// Nome completo do usuário
							//printf( __( 'ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );// ID do usuário

							if( current_user_can('administrator') ) {
								//ações a tomar se usuário é adiministrador
								//echo "  Sou Administrador";
							} else {
								//echo "Sou cliente";
							}
						?>
					</div>
			<?php	}
				 else {
					 //Não exibe nada
				 }
			?>

/** Retirado do header */



	<!-- Inserindo Toast -->
	<!-- <script>
		window.onload = function() {
			launch_toast();
		}

		function launch_toast() {
			var x = document.getElementById("toast")
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
		}
	</script> -->


	<!-- Inserir Banner Flutuante -->
	<!-- <meta>
		<script type='text/javascript'>
			$(document).ready(function() {$(&#39;img#closed&#39;).click(function(){$(&#39;#bl_banner&#39;).hide(90);});});
		</script>
	</meta> -->


    
<?php
	/* // Cria as variáveis com os posts enviados
	$nome = $_POST['nome'];

	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;

	// Conecta ao banco
	global $wpdb;

	// Envia os dados pelo método query
	$salvar = $wpdb->query(
		"UPDATE wp_usermeta 
		SET meta_value = $nome
		WHERE meta_key = 'nickname' AND user_id = $user_id");

	// Valida se as informações foram enviadas com sucesso
	if($salvar):
		echo true;
	else:
		echo 'Erro ao salvar sua mensagem';
	endif; */
/* } */

/* add_action( 'woocommerce_single_product_summary', 'pointcomunicacao_single_product_out_of_stock', 20 );
function pointcomunicacao_single_product_out_of_stock(){

     global $product;

     if( !$product->is_in_stock() ){

         echo '<div class="pointcomunicacao-message-out-of-stock">Fora de Estoque</div>';

     }

 } */

 /* add_filter( 'woocommerce_loop_add_to_cart_link', 'pointcomunicacao_message_after_prices', 10, 3 );

function pointcomunicacao_message_after_prices( $add_to_cart_html, $product, $args ){

    if( !$product->is_in_stock() ){
        $add_to_cart_html = '<div class="pointcomunicacao-message-out-of-stock">Fora de Estoque</div>' . $add_to_cart_html;
    }

    return $add_to_cart_html;

} */

?>

/** Retirado da função edita_nome */


 ?>
		<div id="looding">
			<span id="looding_interno">
				<img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone-carregando.gif" width="50" />
				<p id="looding_name">Alterando o seu nome ...</p>
			</span>
		</div>
	<?php 



/**Script que funcionou muito bem */


<script>
function atualiza_dados() {
	function callback(a){
		return function(){
			function callback(){
				var x = document.getElementById("sucess_toast")
				x.className = "show";
				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
			}
			//alert("Olá " + a + meta_key + iduser);				
			//var salvar = update_user_meta ( iduser, meta_key, a );
			
			//if(salvar) {

			//	function sucess_toast() {
			//		var x = document.getElementById("sucess_toast")
			//		x.className = "show";
			//		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
			//	}

			//	document.getElementById("edita_sobrenome").innerHTML = ' <label>Sobrenome: </label> ' + a + ' <sup> <i class="fas fa-edit" id="botao_editar" alt="Clique para editar" onclick="editar_sobrenome()" ></i> </sup> ';	
			//}else {
			//	function error_toast() {
			//		var x = document.getElementById("error_toast")
			//		x.className = "show";
			//		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
			//	}

				document.getElementById("edita_sobrenome").innerHTML = ' <label>Sobrenome: </label> ' + a + ' <sup> <i class="fas fa-edit" id="botao_editar" alt="Clique para editar" onclick="editar_sobrenome()" ></i> </sup> ';
			//}
		}
	}

	//var dado_alterado = document.getElementById("dado_alterado").value;
	var iduser = document.getElementById("id_user").value;
	var meta_key = document.getElementById("last_name").value;
	var a = document.getElementById("dado_alterado").value;
	setTimeout(callback(a), 2000);
	a = "Sobrenome";
	meta_key = document.getElementById("last_name").value;
	iduser = document.getElementById("id_user").value;
	
	document.getElementById("edita_sobrenome").innerHTML = ' <label>Sobrenome: </label><img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading"/> <span id="looding_name">Alterando o seu sobrenome ...</span> ';
	
	/* setTimeout(func, 2000);
	function func() {
	var dado_alterado = document.getElementById("dado_alterado").value;
	var iduser = document.getElementById("id_user").value;
	var meta_key = document.getElementById("last_name").value;
		
		alert('Olá' + dado_alterado);
	} */
}		
</script>