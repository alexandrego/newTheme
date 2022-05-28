import { SignIn } from "phosphor-react";

export function Logar() {
  return (
    <div className="w-24 my-2 flex space-x-2 justify-center text-menuText-300 font-semibold">
      <SignIn className="w-9 h-9 text-icons-300 items-center" />
      
      <div className="w-36 mt-10 absolute flex justify-center">
        <span>
          Entrar
        </span>
      </div>
    </div>
  )
}