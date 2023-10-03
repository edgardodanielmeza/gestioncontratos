@extends('layouts.app')

@section('content')

<div class="container mx-auto space-y-4">
    <h2 class="text-2xl font-bold mb-4">Editar Contrato</h2>

    <div class="relative overflow-x-auto shadow-md ax-w-screen-sm mx-auto">
        <form action="{{ route('contratos.update', $contrato->idcontrato) }}" method="POST" class="gap-4 mb-4 max-w-screen-sm mx-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-3 gap-4 max-w-screen-sm mx-auto">
                <div class="mb-4">
                    <label class="block mb-1" for="descripcion">Descripción Contrato:</label>
                    <input type="text" class="border rounded w-full py-2 px-3" id="descripcion" name="descripcion" value="{{ $contrato->descripcion }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1" for="idContrataciones">ID Contrataciones:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="idContrataciones" name="idContrataciones" value="{{ $contrato->idContrataciones }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1" for="idtipocontrato">Tipo Contrato:</label>
                    <select name="idtipocontrato" id="idtipocontrato" class="border rounded w-full py-2 px-3">
                        @foreach($tipocontrato as $tipocontratos)
                        <option value="{{ $tipocontratos->idtipocontrato }}" {{ $contrato->idtipocontrato == $tipocontratos->idtipocontrato ? 'selected' : '' }}>
                            {{ $tipocontratos->descripcion .' - '.$tipocontratos->valorduracion.' '.$tipocontratos->duracion}}
                        </option>
                        @endforeach
                    </select>
                    <a href="{{ route('contratos.index') }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Crear Tipo</a>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 max-w-screen-sm mx-auto">
                <div class="mb-4">
                    <label class="block mb-1" for="fechafirma">Fecha de Firma:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fechafirma" name="fechafirma" value="{{ $contrato->fechafirma }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1" for="anho">Año:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="anho" name="anho" value="{{ $contrato->anho }}" required>
                </div>

                <div class="mb-4">
                    <label for="idmonto">Monto:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="idmonto" name="idmonto" value="{{ $contrato->idmonto }}" required>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 max-w-screen-sm mx-auto">
                <div class="mb-4">
                    <label class="block mb-1" for="alias">Alias:</label>
                    <input type="text" class="border rounded w-full py-2 px-3" id="alias" name="alias" value="{{ $contrato->alias }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1" for="idadministrador">Administrador:</label>
                    <select name="idadministrador" id="idadministrador" class="border rounded w-full py-2 px-3">
                        @foreach($administradores as $administrador)
                        <option value="{{ $administrador->idadministrador }}" {{ $contrato->idadministrador == $administrador->idadministrador ? 'selected' : '' }}>
                            {{ $administrador->nombres }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1" for="idcontratista">Contratista:</label>
                    <select name="idcontratista" id="idcontratista" class="border rounded w-full py-2 px-3">
                        @foreach($contratistas as $contratista)
                        <option value="{{ $contratista->idcontratista }}" {{ $contrato->idcontratista == $contratista->idcontratista ? 'selected' : '' }}>
                            {{ $contratista->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 max-w-screen-sm mx-auto">
                <div class="mb-4">
                    <label for="fechainicio">Fecha de Inicio:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fechainicio" name="fechainicio" value="{{ $contrato->fechainicio }}" required>
                </div>

                <div class="mb-4">
                    <label for="fecha_ARTP">Fecha ARTP:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fecha_ARTP" name="fecha_ARTP" value="{{ $contrato->fecha_ARTP }}">
                </div>

                <div class="mb-4">
                    <label for="fecha_ARTD">Fecha ARTD:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fecha_ARTD" name="fecha_ARTD" value="{{ $contrato->fecha_ARTD }}">
                </div>
            </div>

            <div class="mb-4">
                @php
                    $fiscalesContratoIds = $contrato->fiscales->pluck('idfiscal')->toArray();
                @endphp
                <label class="block mb-1" for="fiscales">Fiscales asignados:</label>
                <select multiple class="border rounded w-full py-2 px-3" id="fiscales" name="fiscales[]">
                    @foreach($fiscales as $fiscal)
                    <option value="{{ $fiscal->idfiscal }}"
                         {{ in_array($fiscal->idfiscal,  $fiscalesContratoIds ) ? 'selected' : '' }}
                    >
                        {{ $fiscal->nombresyapellido }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Sección para agregar contrato items -->
            <div class="mb-4">
                <input type="hidden" id="contratoItems" name="contratoItems">
                <h2>Agregar Contrato Item</h2>

                <label for="item">Selecciona un item:</label>
                <div class="grid grid-cols-3 gap-4 max-w-screen-sm mx-auto">
                    <div>
                        <select name="item" id="item" class="border rounded w-full py-2 px-3">
                            @foreach($item as $items)
                            <option value="{{ $items->iditem }}">{{ $items->descripcionitem }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcionitem" name="descripcionitem" class="border rounded w-full py-2 px-3">
                    </div>
                    <div>
                        <label for="accesorios">Accesorios:</label>
                        <input type="text" id="accesorios" name="accesorios" class="border rounded w-full py-2 px-3">
                    </div>
                    <div>
                        <label for="cantidad_minima">Cantidad Mínima:</label>
                        <input type="number" id="cantidad_minima" name="cantidad_minima" class="border rounded w-full py-2 px-3">
                    </div>
                    <div>
                        <label for="cantidad_maxima">Cantidad Máxima:</label>
                        <input type="number" id="cantidad_maxima" name="cantidad_maxima" class="border rounded w-full py-2 px-3">
                    </div>
                    <div>
                        <button type="button" onclick="agregarContratoItem()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <h2>Contrato Items</h2>
            <table class="table-auto w-full mb-4 border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b p-2 text-center">Item</th>
                        <th class="px-4 py-2 border-b p-2 text-center">Descripción</th>
                        <th class="px-4 py-2 border-b p-2 text-center">Accesorios</th>
                        <th class="px-4 py-2 border-b p-2 text-center">Cantidad Mínima</th>
                        <th class="px-4 py-2 border-b p-2 text-center">Cantidad Máxima</th>
                    </tr>
                </thead>
                <tbody id="contratoItemsTableBody">
                    <!-- Aquí se listarán los contratoitems -->
                    @foreach($contrato->contratoItems as $contratoItem)
                    <tr>
                        <td class="px-4 py-2 border-b p-2 text-center">{{ $contratoItem->item->descripcionitem }}</td>
                        <td class="px-4 py-2 border-b p-2 text-center">{{ $contratoItem->descripcion}}</td>
                        <td class="px-4 py-2 border-b p-2 text-center">{{ $contratoItem->accesorios }}</td>
                        <td class="px-4 py-2 border-b p-2 text-center">{{ $contratoItem->cantidad_minima }}</td>
                        <td class="px-4 py-2 border-b p-2 text-center">{{ $contratoItem->cantidad_maxima }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar Contrato
            </button>

        </form>
    </div>

</div>

<!-- Script para manejar los contrato items en el cliente -->
<script>
    //var contratoItemsw = [];
    var contratoItems ={!! json_encode($contrato->contratoItems->toArray()) !!};
    console.log(contratoItems);


    function agregarContratoItem() {
        var select = document.getElementById("item");
        var iditem = parseInt(document.getElementById("item").value);
        var itemseleccionado = select.options[select.selectedIndex].text
        var descripcion = document.getElementById("descripcionitem").value;
        var accesorios = document.getElementById("accesorios").value;
        var cantidad_minima = document.getElementById("cantidad_minima").value;
        var cantidad_maxima = document.getElementById("cantidad_maxima").value;

        var itemIndex = contratoItems.findIndex(function(element) {
        return element.iditem === iditem;
    });

    if (itemIndex !== -1) {
        // Si el iditem ya existe, actualiza la información
        contratoItems[itemIndex] = {
            iditem: iditem,
            descripcion: descripcion,
            accesorios: accesorios,
            cantidad_minima: cantidad_minima,
            cantidad_maxima: cantidad_maxima,
            itemseleccionado: itemseleccionado
        };
        }else{

                    var nuevoContratoItem = {
                        iditem: iditem,
                        descripcion: descripcion,
                        accesorios: accesorios,
                        cantidad_minima: cantidad_minima,
                        cantidad_maxima: cantidad_maxima,
                        itemseleccionado: itemseleccionado
                    };

                    contratoItems.push(nuevoContratoItem);
            }
        console.log(contratoItems);
        document.getElementById("item").value = '';
        document.getElementById("descripcionitem").value = "";
        document.getElementById("accesorios").value = "";
        document.getElementById("cantidad_minima").value = "";
        document.getElementById("cantidad_maxima").value = "";

        document.getElementById("contratoItems").value = JSON.stringify(contratoItems);

        actualizarTablaContratoItems();
    }


    function actualizarTablaContratoItems() {
        var tableBody = document.getElementById("contratoItemsTableBody");
        tableBody.innerHTML = '';

        for (var i = 0; i < contratoItems.length; i++) {
            var contratoItem = contratoItems[i];

            var row = tableBody.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            cell1.innerHTML = `<div class="text-center">${contratoItem.itemseleccionado}</div>`;
            cell2.innerHTML = `<div class="text-center">${contratoItem.descripcion}</div>`;
            cell3.innerHTML = `<div class="text-center">${contratoItem.accesorios}</div>`;
            cell4.innerHTML = `<div class="text-center">${contratoItem.cantidad_minima}</div>`;
            cell5.innerHTML = `<div class="text-center">${contratoItem.cantidad_maxima}</div>`;
        }
    }
</script>




@endsection
