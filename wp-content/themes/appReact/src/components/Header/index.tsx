import { Logo } from './Logo'
import { Search } from './Search'
import { Contato } from './Contato'
import { Logar } from './Logar'
import { Carrinho } from './Carrinho'
import { Menu } from './Menu'

export function Header() {
  return (
    // <header className="w-full bg-backgroundHeader-300">
      <div className="lg:space-x-9 md:space-x-5 flex justify-center bg-backgroundHeader-300 pt-4">
        <Logo />
        <Search />
        <Contato />
        <Logar />
        <Carrinho />
        <Menu />
      </div>
    // </header>
  )
}