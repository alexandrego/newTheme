// const hello = 'Alexandre';

// document.getElementById('testeJS').innerHTML = hello;

// console.log('Moeda atual ' + currencySymbol);
// console.log(typeof(currencySymbol));

// console.log('Moeda atual ' + isBRL);
// console.log(typeof(isBRL));

// console.log('Valor R$ ' + precoJava);
// console.log(typeof(precoJava));

// console.log('************************************');

// var precoNumber = parseInt(precoJava)
// console.log('Valor R$ ' + precoNumber);
// console.log(typeof(precoNumber));

// console.log('************************************');

// console.log('ID do Produto = '+productId);
// console.log(typeof(productId));

function mudaQty() {
  var qtyEscolhido = document.getElementById("pegaQty").value; //<--Pega quantidade do selectBox
  var quantEscolhido = parseInt(qtyEscolhido);

  var showPairOrOdd = quantEscolhido;
  var showResult = showPairOrOdd % 2 === 0 ? 'Pair' : 'Odd';
  const isPair = 'Pair';
  const isOdd = 'Odd';

  const isOne = 1;
  const isTwo = 2;
  const isThree = 3;
  
  const isTrue = new Boolean(true);
  const yes = isTrue.valueOf();

  function verificaCondicaoVenda(Id) {
    // Seta combinações de produtos vendidos de acordo com suas regras
    const produtoPar = [3767, 3768];
    const produtoMetro = [5574, 5581, 10317, 10321, 10322, 10327, 10328, 11158, 11162, 11305];
    const produtoQuilo = [9251];
    const produto3Metros = [5606, 5605,13];

    // Verifica se é vendido em Par
    const isPar = produtoPar.includes(JSON.parse(Id));
    const yesIsPar = isPar.valueOf();
    // Verifica se é vendido em Metro
    const isMetro = produtoMetro.includes(JSON.parse(Id));
    const yesIsMetro = isMetro.valueOf();
    // Verifica se é vendido em Quilo
    const isQuilo = produtoQuilo.includes(JSON.parse(Id));
    const yesIsQuilo = isQuilo.valueOf();
    // Verifica se é vendido em 3 Metros
    const is3Metros = produto3Metros.includes(JSON.parse(Id));
    const yesIs3Metros = is3Metros.valueOf();
    
    // console.log(isPar.valueOf());
    // console.log(isMetro.valueOf());
    // console.log(isQuilo.valueOf());
    // console.log(is3Metros.valueOf());

    if(yesIsPar === yes) {
      return 'isPar';
    } else if(yesIsMetro === yes) {
      return 'isMetro';
    } else if(yesIsQuilo === yes) {
      return 'isQuilo';
    } else if(yesIs3Metros === yes) {
      return 'is3Metros';
    } else {
      return 'unidade';
    }

  }

  function adicionaFrasePar(string) {
    const recebeCondicaoVenda = string;
    // console.log('Condição recebida pela função? ' +recebeCondicaoVenda);

    if(recebeCondicaoVenda === 'isPar') {
      if(quantEscolhido === isOne) {        
        return 'Referente a ' +quantEscolhido+ ' par';
      } else {
        return 'Referente a ' +quantEscolhido+ ' pares';
      }
    } else if(recebeCondicaoVenda === 'isMetro') {
        if(quantEscolhido === isOne) {        
          return 'Referente a ' +quantEscolhido+ ' metro';
        } else {
          return 'Referente a ' +quantEscolhido+ ' metros';
        }
    } else if(recebeCondicaoVenda === 'isQuilo') {
      // if(quantEscolhido === isOne) {     
        let pesoBase = 1.400;
        let pesoReal = pesoBase*quantEscolhido;
        let pesoCorrigido = pesoReal.toFixed(2);

        return 'Referente a ' +pesoCorrigido+ ' Kg';
      // } else {
      //   return 'Referente a ' +quantEscolhido+ ' quilos';
      // }
    } else if(recebeCondicaoVenda === 'is3Metros') {
      if(quantEscolhido === isOne) {     

        return 'Referente a ' +quantEscolhido+ ' barra de 3 metros';

      } else if(quantEscolhido === isTwo) {

        return 'Referente a 1 barra de 6 metros';

      } else if(quantEscolhido === isThree) {

        return 'Referente a 1 barra de 6 metros e 1 Barra de 3 metros';

      } else if(isOdd === showResult) {
        var makeCalc = quantEscolhido-1;
        var makeResult = makeCalc/2;

        return 'Referente a ' +makeResult+ ' barras de 6 metros e 1 Barra de 3 metros';

      } else if(isPair === showResult) {
        var makeCalc = quantEscolhido/2;
        var makeResult = makeCalc;
        
        return 'Referente a ' +makeResult+ ' barras de 6 metros';
      }
    } else {
      if(quantEscolhido === isOne) { 

        return 'Referente a ' + quantEscolhido + ' unidade';
      } else {

        return 'Referente a ' + quantEscolhido + ' unidades';
      }
    }
    
  }

  function formatPrice(price) {
    let formatedPrice = price.toLocaleString('pt-BR', {
      style: 'currency',
      currency: 'BRL',
      minimumFractionDigits: 2
    }); //<--Formata preço para moeda Real

    return formatedPrice;
  }

  function calculaParcelamento(price, quantity) {
    const dividendo = 5 ;
    const limiteParcela = 12 ;
    
    let Finalprice = price*quantity;
    let precoDivido = Finalprice/dividendo;
    let divisorPrice = Math.trunc(precoDivido);
    let precoParcela = Finalprice/divisorPrice;
    let priceMult = quantity*precoParcela;

    
    let FinalpriceReal = formatPrice(Finalprice);

    if(precoDivido < limiteParcela) {
      let showPriceOffReal = formatPrice(precoParcela);

      return 'Em '+divisorPrice+'x de ' + showPriceOffReal + '<sup id="off">('+FinalpriceReal+')</sup>';

    } else {
      let precoDivido12 = Finalprice/limiteParcela;
      // let divisorPrice = Math.trunc(precoDivido12);
      // let finalPrice2 = Finalprice/divisorPrice
      
      let showPriceOffReal = formatPrice(precoDivido12);      
      console.log('Valor recebido na Função -> '+Finalprice);
      console.log('Valor dividido por 12 -> '+precoDivido12);

      return 'Em '+limiteParcela+'x de ' + showPriceOffReal + '<sup id="off">('+FinalpriceReal+')</sup>';
    }
  }

  function descontoAVista(price, quantity) {
    let off = 5/100;
    let finalPrice = price*quantity;
    let valorComDesconto = finalPrice-(finalPrice*off);
    const showPriceOffReal = formatPrice(valorComDesconto);

    return 'Ou ' + showPriceOffReal + ' a vista por Pix ou Boleto Bancário';
  }

  let condicaoVenda = verificaCondicaoVenda(productId); 
  
  let fullPrice = precoJava*quantEscolhido;
  let fullPriceReal = formatPrice(fullPrice);
  console.log('Preço cheio '+fullPriceReal);

  let escreve = adicionaFrasePar(condicaoVenda);
  console.log('-> ' +escreve);

  let showPriceOff = descontoAVista(precoJava, quantEscolhido);
  console.log('-> ' +showPriceOff);

  let showDividendo = calculaParcelamento(precoJava, quantEscolhido);
  console.log('-> ' +showDividendo);

  document.getElementById('precoProduto').innerHTML = fullPriceReal;
  document.getElementById('adicionaDescri').innerHTML = escreve;
  document.getElementById('ajusta-altura-preco').innerHTML = showDividendo;
  document.getElementById('mostraPrecosAVista').innerHTML = showPriceOff;
  

  // console.log('Mostra Quantidade = '+quantEscolhido);

  // console.log(typeof(quantEscolhido));
  // console.log(typeof(qtyEscolhido));
  // console.log(typeof(isOne));
  // console.log(typeof(yes));

  // console.log(condicaoVenda.valueOf());
  // console.log(yes.valueOf());

  // console.log(isFive);
  // console.log(typeof(isFive));
}