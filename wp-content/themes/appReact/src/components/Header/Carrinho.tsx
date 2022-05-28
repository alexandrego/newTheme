import { ShoppingCart } from "phosphor-react";

export function Carrinho() {
  return (
    <div className="w-24 my-2 flex space-x-2 justify-center text-menuText-300 font-semibold">
      <ShoppingCart className="w-9 h-9 text-icons-300 items-center" />
      
      <div className="w-36 mt-10 absolute flex justify-center">
        <span>
          Carrinho
        </span>
      </div>
    </div>
  )
}