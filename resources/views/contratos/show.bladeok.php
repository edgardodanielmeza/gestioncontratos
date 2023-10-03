@extends('layouts.app')

@section('content')

<div class="container mx-auto space-y-4">


    <h2 class="text-2xl font-bold mb-4">Detalles del Contrato</h2>

    <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="flex flex-col">
            <span class="font-bold">Descripción</span>
            <span>{{ $contrato->descripcion }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">Tipo</span>
            <span>{{ $contrato->tipocontrato->descripcion }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">Fecha de Firma</span>
            <span>{{\Carbon\Carbon::parse($contrato->fechafirma)->format('d/m/y') }}</span>
        </div>

        <div class="flex flex-col">
            <span class="font-bold">Monto Total</span>
            <span>{{ number_format($contrato->idmonto, 0, ',', '.')}}</span>
        </div>





        <div class="flex flex-col">
            <span class="font-bold">Contratista</span>
            <span>{{  $contrato->contratista->descripcion}}</span>
        </div>

        <div class="flex flex-col">
            <span class="font-bold">Administrador </span>
            <span>{{ $contrato->administrador->nombres }}</span>
        </div>


        <div class="flex flex-col">
            <span class="font-bold">Año</span>
            <span>{{ $contrato->anho }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">ARTP</span>
            <span>{{ \Carbon\Carbon::parse($contrato->fecha_ARTP)->format('d/m/y')  }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">ARTP</span>
            <span>{{ \Carbon\Carbon::parse($contrato->fecha_ARTD )->format('d/m/y')  }}</span>
        </div>



        <div class="flex flex-col">
            <span class="font-bold"> ID</span>
            <span>{{ $contrato->idContrataciones }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">AFiscales</span>
            <span
            >@foreach($contrato->fiscales as $fiscal)
                <p>{{ $fiscal->nombresyapellido }}</p>
            @endforeach
        </span>
        </div>

    </div>

     <!-- Agrega esta tabla en tu HTML para mostrar los Contrato Items -->
     <h2 class="text-2xl font-bold mb-4">Contrato Items</h2>

     <table class="border border-gray-300 mb-4 w-full">
         <thead>
             <tr>
                 <th class="px-6 py-2 border-b text-center">Item</th>
                 <th class="px-4 py-2 border-b text-center">Descripción</th>
                 <th class="px-4 py-2 border-b text-center">Precio</th>
                 <th class="px-4 py-2 border-b text-center">Cantidad Mínima</th>
                 <th class="px-4 py-2 border-b text-center">Cantidad Máxima</th>
             </tr>
         </thead>
         <tbody id="contratoItemsTableBody">
             <!-- Aquí se listarán los contratoitems -->
             @foreach($contrato->contratoItems as $contratoItem)
                 <tr>
                     <td class="px-2 py-2 border-b text-center">
                     {{   $contratoItem->item->descripcionitem }}

                     </td>
                     <td class="px-4 py-2 border-b text-center"> {{ $contratoItem->descripcion }}</td>
                     <td class="px-4 py-2 border-b text-center">{{ $contratoItem->precio }}</td>
                     <td class="px-4 py-2 border-b text-center">{{ $contratoItem->cantidad_minima }}</td>
                     <td class="px-4 py-2 border-b text-center">{{ $contratoItem->cantidad_maxima }}</td>

                 </tr>
             @endforeach
         </tbody>
     </table>



</div>
@endsection
