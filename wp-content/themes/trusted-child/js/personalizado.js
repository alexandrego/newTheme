/**
 * Funções para atualizar campos com ajax.
 */

/**
 * Função atualiza Sobrenome do usuario
 */

function atualiza_dados() {
    function callback(a){
        return function(){				
            jQuery(function($){

                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url( 'admin-ajax.php'); ?>',
                                                
                    data: {
                    action: 'editar_sobrenome',
                    novo_nome: a,
                    local_alterar: meta_key,
                    user_id: iduser
                    },

                    dataType: 'html',

                    success: function(data) {
                        console.log(data);

                        if (data == 'ok') {
                            var x = document.getElementById("sucess_toast")
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", "");}, 8000);
                        
                                var element = document.getElementById("myprogressBar"); 
                                var width = 1; 
                                var identity = setInterval(scene, 80); 
                                function scene() { 
                                    if (width >= 100) { 
                                    clearInterval(identity); 
                                    } else { 
                                    width++; 
                                    element.style.width = width + '%'; 
                                    } 
                                } 

                            document.getElementById("edita_sobrenome").innerHTML = ' <label>Sobrenome: </label> <span class="aparecer_suave">' + a + '</span> <sup> <i class="fas fa-edit" id="botao_editar" alt="Clique para editar" onclick="editar_sobrenome()" ></i> </sup> ';
                        } else {									
                            var x = document.getElementById("error_toast")
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

                            
                            var element = document.getElementById("error_myprogressBar"); 
                                var width = 1; 
                                var identity = setInterval(scene, 80); 
                                function scene() { 
                                    if (width >= 100) { 
                                    clearInterval(identity); 
                                    } else { 
                                    width++; 
                                    element.style.width = width + '%'; 
                                    } 
                                } 

                            document.getElementById("edita_sobrenome").innerHTML = ' <label>Sobrenome: </label> <span class="aparecer_suave">' + a + '</span> <sup> <i class="fas fa-edit" id="botao_editar" alt="Clique para editar" onclick="editar_sobrenome()" ></i> </sup> ';				
                        }								
                    }
                });
                    return false;
            });
        }
    }

    //var dado_alterado = document.getElementById("dado_alterado").value;
    var iduser = document.getElementById("id_user").value;
    var meta_key = document.getElementById("billing_last_name").value;
    var a = document.getElementById("dado_alterado").value;
    setTimeout(callback(a), 200);
    a = "Sobrenome";
    meta_key = document.getElementById("billing_last_name").value;
    iduser = document.getElementById("id_user").value;
    
    document.getElementById("edita_sobrenome").innerHTML = ' <label>Sobrenome: </label><img src="https://diamondnautica.com.br/wp-content/uploads/2021/01/icone_carregando_2.gif" width="30" id="loading" class="aparecer_suave"/> <span id="looding_name" class="aparecer_suave">Alterando o seu sobrenome ...</span> ';
}