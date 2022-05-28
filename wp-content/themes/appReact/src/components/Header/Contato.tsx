import { Phone } from "phosphor-react";

export function Contato() {
  return (
    <div className="w-24 my-2 flex space-x-2 justify-center text-menuText-300 font-semibold">
      <Phone className="w-9 h-9 text-icons-300 items-center" />
      <span>
        Contato
      </span>
      
      <div className="w-36 mt-10 absolute flex justify-center">
        <span>
          (47) 3361-6518
        </span>
      </div>
    </div>
  )
}