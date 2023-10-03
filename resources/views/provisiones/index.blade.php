@extends('layouts.app')

@section('content')
<div class="container mx-auto space-y-10">
    <h1 class="text-2xl font-bold mb-4 text-center">Provisiones de Contrato</h1>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-min mx-auto">
        <!-- Search Bar -->
        <div class="flex items-center justify-end p-4">
            <input type="text" id="search" placeholder="Buscar..." class="rounded-l-md p-2 w-80 focus:outline-none">
            <button onclick="searchContracts()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">Buscar</button>
        </div>


    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <!-- Table Header -->
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">ID</th>
                <th scope="col" class="px-4 py-3">Descripción</th>
                <th scope="col" class="px-4 py-3">Tipo</th>
                <th scope="col" class="px-4 py-3">Fecha Firma</th>
                <th scope="col" class="px-4 py-3">Items</th>

                <!-- Add more headers as needed -->
                <th scope="col" class="px-2 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody id="contractTableBody">
            <!-- Contracts will be displayed here -->
            @foreach($contratos as $contrato)
                <!-- Contract row -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-4">{{ $contrato->idContrataciones }}</td>
                    <td class="px-4 py-4">{{ $contrato->descripcion }}</td>
                    <td class="px-4 py-4">{{ $contrato->tipocontrato->descripcion }}</td>
                    <td class="px-4 py-4"> {{ \Carbon\Carbon::parse($contrato->fechafirma)->format('d/m/y') }}</td>
                    <td class="px-4 py-4">
                            <!-- List contratoitems -->
                            @foreach($contrato->contratoItems as $contratoItem)

                            <div class=" ">{{ $contratoItem->item->descripcionitem }}  -    {{ $contratoItem->descripcion }}
                                 -   {{ $contratoItem->cantidad_maxima }}
                            </div>
                        @endforeach
                        </div>

                    <!-- Add more data fields as needed -->
                    <td class="px-2 py-2">
                       <div class="mb-2">
                        <a href="{{ route('provisiones.create', $contrato->idcontrato) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mx-1">Povision</a>
                       </div><div class="mb-2 ">
                        <a href="{{ route('provisiones.edit', $contrato->idcontrato) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Editar</a>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
     <!-- Show a message if there are fewer than 10 items -->
     @if(count($contratos) < 10)
     <div class="px-4 py-3 text-gray-500 dark:text-gray-400">
         Mostrando {{ count($contratos) }} contrato(s).
     </div>
    @endif

</div>

<script>
    function searchContracts() {
        const searchText = document.getElementById('search').value;
        window.location.href = `{{ route('contratos.index') }}?search=${searchText}`;
    }
</script>

@endsection
