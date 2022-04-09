<?php 
  if(current_user_can('administrator')) { //Mostrar apenas para administrador

  get_header();
?>

<div id="divBody"> 
  <!-- Efeito Skeleton -->
  <div id="divShimmerEffect">
    <?php
      $productEffect = 1;
      while ( $productEffect <= 5 ) {
        ?>
          <div id="shimmerEffect">
            <div id="box" class="shine"></div>
              <?php
                $lineEffect = 1;
                while ( $lineEffect <= 2 ) {
                  ?>
                    <p id="line" class="shine"></p>
                  <?php
                  $lineEffect++;
                }
              ?>
          </div>
        <?php
        $productEffect++;
      };
    ?>
  </div>
  <!-- Fim do efeito Skeleton -->
</div>

<script type="text/javascript">
  function pagina_inicial() {
    document.getElementById("divBody").innerHTML = `
      <div id="showProducts">
        <div id="organizeProducts">
          <?php
            echo do_shortcode( '[recent_products per_page="20" columns="5" orderby="rand" paginate="true"]' );
          ?>
        </div>
      </div>
    `;
  }

  //const teste = document.querySelector("#divBody");

  function showShimmerEffect() {
    document.getElementById("divBody").innerHTML = `      
      <!-- Efeito Skeleton -->
      <div id="divShimmerEffect">
        <?php
          $productEffect = 1;
          while ( $productEffect <= 5 ) {
            ?>
              <div id="shimmerEffect">
                <div id="box" class="shine"></div>
                  <?php
                    $lineEffect = 1;
                    while ( $lineEffect <= 2 ) {
                      ?>
                        <p id="line" class="shine"></p>
                      <?php
                      $lineEffect++;
                    }
                  ?>
              </div>
            <?php
            $productEffect++;
          };
        ?>
      </div>
      <!-- Fim do efeito Skeleton -->
    `;
  }
</script>

<?php 
  get_footer();

} else {
  ?><!DOCTYPE html>
  <!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
  <!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
  <!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title><?php wp_title('«', true, 'right'); ?> <?php bloginfo('name'); ?></title>
      <meta name="description" content="">      
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width">
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />  
      
      <?php wp_head(); ?>
  </head>

    <div id="divBodyConstruction">

      <!-- Logo do site -->
      <div id="backgroundLogo">
        <div id="showLogo">          
          <img src="/wp-content/themes/boatplace/assets/logo.svg" id="showLogoSvg" alt="boatplace" title="boatplace" />          
        </div>
      </div>

      <!-- Informativo -->
      <div id="backgroundInfo">
        <div id="showInfo">          
          <p>Tudo na Linha Náutica.</p></br>
          <p>Novidades para você logista e para você consumidor.</p></br>       
          <p>Em breve.</p>
        </div>
      </div>

    </div>

  <?php
}
?>