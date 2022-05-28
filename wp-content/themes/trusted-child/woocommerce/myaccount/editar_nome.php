<?php
// Cria as variáveis com os posts enviados
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
	endif;
	?>