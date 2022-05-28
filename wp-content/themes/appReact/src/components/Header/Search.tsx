import { MagnifyingGlass } from "phosphor-react";

function showSearch() {
  document.getElementById('showSearch').innerHTML = `<p id="showSearch" className="font-regular">Vamos mostrar o resultado da busca.</p>`;
}

export function Search() {
  return (
    <div className="my-5 h-10 rounded-md">
      <form role="search" method="get" onClick={() => showSearch()}>
        <button className="mx-1 w-8 rounded-md h-10 absolute flex justify-center items-center">
          <MagnifyingGlass className="text-2xl text-icons-300 font-bold" alt="Botão para solicitar uma busca" />
        </button>

        <input
          type="search"
          name="s"
          placeholder="Pesquise o produto que deseja..."
          className="lg:w-96 md:w-75 pl-9 rounded-md bg-backgroundInput-300 text-slate-800 border-none focus:border-icons-300"
          alt="Pesquise o produto que deseja"
        />
      </form>
    </div>
  )
}