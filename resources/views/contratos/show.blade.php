@extends('layouts.app')

@section('content')

<div class="container mx-auto space-y-4">

    <h2 class="text-2xl font-bold mb-4">Detalles del Contrato</h2>
    <a href="{{route('contratos.evento', $contrato->idcontrato) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mt-4">
        Registrar Eventos</a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="flex flex-col mb-4">
            <span class="font-bold">Descripción</span>
            <span>{{ $contrato->descripcion }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">Tipo</span>
            <span>{{ $contrato->tipocontrato->descripcion }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">Fecha de Firma</span>
            <span>{{ \Carbon\Carbon::parse($contrato->fechafirma)->format('d/m/y') }}</span>
        </div>
        <!-- Add more columns as needed -->
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="flex flex-col mb-4">
            <span class="font-bold">Monto Total</span>
            <span>{{ number_format($contrato->idmonto, 0, ',', '.') }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">Contratista</span>
            <span>{{ $contrato->contratista->descripcion }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">Administrador</span>
            <span>{{ $contrato->administrador->nombres }}</span>
        </div>
        <!-- Add more columns as needed -->
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="flex flex-col mb-4">
            <span class="font-bold">Año</span>
            <span>{{ $contrato->anho }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">ARTP</span>
            <span>{{ \Carbon\Carbon::parse($contrato->fecha_ARTP)->format('d/m/y') }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">ARTP</span>
            <span>{{ \Carbon\Carbon::parse($contrato->fecha_ARTD)->format('d/m/y') }}</span>
        </div>
        <!-- Add more columns as needed -->
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="flex flex-col mb-4">
            <span class="font-bold">ID</span>
            <span>{{ $contrato->idContrataciones }}</span>
        </div>
        <div class="flex flex-col mb-4">
            <span class="font-bold">AFiscales</span>
            <span>
                @foreach($contrato->fiscales as $fiscal)
                <p>{{ $fiscal->nombresyapellido }}</p>
                @endforeach
            </span>
        </div>
        <!-- Add more columns as needed -->
    </div>

    <!-- Contrato Items Table -->
    <h2 class="text-2xl font-bold mb-4 text-center">Contrato Items</h2>

    <table class="border border-gray-300 mb-4 w-full">
        <thead>
            <tr>
                <th class="px-6 py-2 border-b text-center">Item</th>
                <th class="px-4 py-2 border-b text-center">Descripción</th>
                <th class="px-4 py-2 border-b text-center">Precio</th>
                <th class="px-4 py-2 border-b text-center">Cantidad Mínima</th>
                <th class="px-4 py-2 border-b text-center">Cantidad Máxima</th>

                <th class="px-4 py-2 border-b text-center">Numero de provisiones</th>
                <th class="px-4 py-2 border-b text-center">Cantidad de Items</th>
                <th class="px-4 py-2 border-b text-center">Disponible</th>
            </tr>
        </thead>
        <tbody id="contratoItemsTableBody">
            <!-- List contratoitems -->
            @foreach($contrato->contratoItems as $contratoItem)
            <tr>
                <td class="px-2 py-2 border-b text-center">{{ $contratoItem->item->descripcionitem }}</td>
                <td class="px-4 py-2 border-b text-center">{{ $contratoItem->descripcion }}</td>
                <td class="px-2 py-2 border-b text-center">Gs {{ number_format($contratoItem->precio, 0, ',', '.')  }}</td>
                <td class="px-4 py-2 border-b text-center">{{ number_format($contratoItem->cantidad_minima , 0, ',', '.')  }}</td>
                <td class="px-4 py-2 border-b text-center">{{ number_format($contratoItem->cantidad_maxima , 0, ',', '.')  }}</td>

                <td class="px-4 py-2 border-b text-center"> {{$contratoItem->provisiones()->count() }} </td>
                <td class="px-4 py-2 border-b text-center">{{ $contratoItem->getCantidadProvisionesAttribute() }} </td>
                <td class="px-4 py-2 border-b text-center">{{$contratoItem->cantidad_maxima - $contratoItem->getCantidadProvisionesAttribute() }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


  <!-- Mostrar la tabla de provisiones solo si hay provisiones -->
  @if ($contrato->provisiones()->count() > 0)
<div class="mt-4 ">
  <h2 class="text-2xl font-bold mb-4 text-center ">Provisiones</h2>

  <table class="text-sm  text-black dark:text-gray-400 mx-auto ">
      <!-- Table Header -->
      <thead class="text-xs uppercase border-gray-300 mb-4 w-full">
          <tr>
              <th class="px-4 py-2 border-b text-center">Item</th>
              <th class="px-4 py-2 border-b text-center">descripcion</th>
              <th class="px-4 py-2 border-b text-center">Fecha Orden</th>
              <th class="px-4 py-2 border-b text-center">Cantidad</th>
          </tr>
      </thead>
      <tbody id="provisionesTableBody">
          @foreach($contrato->provisiones as $provision)
          <tr>
              <td class="px-2 py-2 border-b text-center">

                     {{ $provision->contratoItem->item->descripcionitem }}
              </td>
              <td class="px-4 py-2 border-b text-center">
                    {{ $provision->contratoItem->descripcion }}
              </td>
              <td class="px-4 py-2 border-b text-center">
                  {{ \Carbon\Carbon::parse($provision->fecha)->format('d/m/y') }}
              </td>
              <td class="px-4 py-2 border-b text-center">

                  {{number_format($provision->cantidad_provision, 0, ',', '.') }}
              </td>


          </tr>
          <!-- Add more rows as needed -->
          @endforeach
      </tbody>
  </table>


@else
<div class="text-center my-4">No hay provisiones para este contrato.</div>
</div>
@endif
@endsection
