import logoImg from '../../assets/logo.svg'

const logo = {
  logoSVG: {
    title: 'Logo da loja',
    image: {
      source: logoImg,
      alt: 'Imagem eliptica de um barco com uma imagem de diamante e o nome Diamond Náutica centralizados'
    }
  }
}

export function Logo() {
  return (
    <div className="xl:w-32 sm:w-25">
      { Object.entries(logo).map(([key, value]) => {
        return (
          <a href='#' title={value.title}>
            <img src={value.image.source} alt={value.image.alt} />
          </a>
        )
      }) }

      <div className="w-32 my-3 flex justify-center text-menuText-300 font-semibold">
        <span>Olá, Visitante</span>
      </div>
    </div>
  )
}