@extends('layouts.app')

@section('content')

<div class="container mx-auto  space-y-4">

            <h2 class="text-2xl font-bold mb-4">Nuevo Contrato</h2>

<div class="relative overflow-x-auto shadow-md ax-w-screen-sm mx-auto">

    <form action="{{ route('contratos.store') }}" method="POST" class=" gap-4 mb-4 max-w-screen-sm mx-auto ">
                @csrf
                    <div class="grid grid-cols-3  gap-4 max-w-screen-sm mx-auto ">
                            <div class="mb-4">
                                <label class="block mb-1" for="descripcion">Descripción Contrato:</label>
                                <input type="text" class="border rounded w-full py-2 px-3" id="descripcion" name="descripcion" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1" for="idContrataciones">ID Contrataciones:</label>
                                <input type="number" class="border rounded w-full py-2 px-3" id="idContrataciones" name="idContrataciones" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1" for="idtipocontrato">Tipo Contrato:</label>
                                <select name="idtipocontrato" id="idtipocontrato" class="border rounded w-full py-2 px-3">
                                    @foreach($tipocontrato as $tipocontratos)
                                        <option value="{{ $tipocontratos->idtipocontrato }}">{{ $tipocontratos->descripcion .' - '.$tipocontratos->valorduracion.' '.$tipocontratos->duracion}}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('contratos.index') }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Crear Tipo</a>
                            </div>
                     </div>

                    <div class="grid grid-cols-3  gap-4 max-w-screen-sm mx-auto ">
                    <div class="mb-4">
                        <label class="block mb-1" for="fechafirma">Fecha de Firma:</label>
                        <input type="date" class="border rounded w-full py-2 px-3" id="fechafirma" name="fechafirma" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="anho">Año:</label>
                        <input type="number" class="border rounded w-full py-2 px-3" id="anho" name="anho" required>
                    </div>
                    <div class="mb-4">
                        <label for="idmonto">Monto:</label>
                        <input type="number" class="border rounded w-full py-2 px-3" id="idmonto" name="idmonto" required>
                    </div>



                    </div>

                    <div class="grid grid-cols-3  gap-4 max-w-screen-sm mx-auto ">

                    <div class="mb-4">
                        <label class="block mb-1" for="alias">Alias:</label>
                        <input type="text" class="border rounded w-full py-2 px-3" id="alias" name="alias" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1" for="idadministrador">Administrador:</label>
                        <select name="idadministrador" id="idadministrador" class="border rounded w-full py-2 px-3">
                            @foreach($administradores as $administrador)
                                <option value="{{ $administrador->idadministrador }}">{{ $administrador->nombres }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="idcontratista">Contratista:</label>
                        <select name="idcontratista" id="idcontratista" class="border rounded w-full py-2 px-3">
                            @foreach($contratistas as $contratista)
                                <option value="{{ $contratista->idcontratista }}">{{ $contratista->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                <div class="grid grid-cols-3  gap-4 max-w-screen-sm mx-auto ">
                    <div class="mb-4">
                        <label for="fechainicio">Fecha de Inicio:</label>
                        <input type="date" class="border rounded w-full py-2 px-3" id="fechainicio" name="fechainicio" required>
                    </div>
                    <div class="mb-4">
                        <label for="fecha_ARTP">Fecha ARTP:</label>
                        <input type="date" class="border rounded w-full py-2 px-3" id="fecha_ARTP" name="fecha_ARTP" >
                    </div>
                    <div class="mb-4">
                        <label for="fecha_ARTD">Fecha ARTD:</label>
                        <input type="date" class="border rounded w-full py-2 px-3" id="fecha_ARTD" name="fecha_ARTD" >
                    </div>
            </div>

                <div class="mb-4">
                    <label class="block mb-1" for="fiscales">Fiscales asignados:</label>
                    <select multiple class="border rounded w-full py-2 px-3" id="fiscales" name="fiscales[]">
                        @foreach($fiscales as $fiscal)
                            <option value="{{ $fiscal->idfiscal }}">{{ $fiscal->nombresyapellido }}</option>
                        @endforeach
                    </select>
                </div>







                <!-- Sección para agregar contrato items -->
        <div class="mb-4">
            <input type="hidden" id="contratoItems" name="contratoItems">
            <h2>Agregar Contrato Item</h2>

            <label for="item">Selecciona un item:</label>
            <div class="grid grid-cols-3  gap-4 max-w-screen-sm mx-auto ">
                <div>
                <select name="item" id="item" class="border rounded w-full py-2 px-3" >
                    @foreach($item as $items)
                        <option value="{{ $items->iditem }}">{{ $items->descripcionitem }}</option>
                    @endforeach
                </select>
            </div>
                <div>
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcionitem" name="descripcionitem" class="border rounded w-full py-2 px-3">
                </div>  <div>
                    <label for="precio">precio:</label>
                    <input type="text" id="precio" name="precio" class="border rounded w-full py-2 px-3">
                </div>  <div>
                    <label for="cantidad_minima">Cantidad Mínima:</label>
                    <input type="number" id="cantidad_minima" name="cantidad_minima" class="border rounded w-full py-2 px-3">
                </div>  <div>
                    <label for="cantidad_maxima">Cantidad Máxima:</label>
                    <input type="number" id="cantidad_maxima" name="cantidad_maxima" class="border rounded w-full py-2 px-3">
                </div>  <div>
                    <button type="button" onclick="agregarContratoItem()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Agregar
                    </button>
                </div>
                </div>
        </div>

        <h2>Contrato Items</h2>
        <table class="table-auto w-full mb-4 border border-gray-300"" >
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b p-2 text-center">Item</th>
                    <th class="px-4 py-2 border-b p-2 text-center">Descripción</th>
                    <th class="px-4 py-2 border-b p-2 text-center">precio</th>
                    <th class="px-4 py-2 border-b p-2 text-center">Cantidad Mínima</th>
                    <th class="px-4 py-2 border-b p-2 text-center">Cantidad Máxima</th>
                </tr>
            </thead>
            <tbody id="contratoItemsTableBody">
                <!-- Aquí se listarán los contratoitems -->
            </tbody>
        </table>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Guardar Contrato
        </button>

    </form>





</div>




<!-- Script para manejar los contrato items en el cliente -->
<script>
    var contratoItems = [];

    function agregarContratoItem() {

        var select = document.getElementById("item");
        var item = document.getElementById("item").value;
        var itemseleccionado= select.options[select.selectedIndex].text
        var descripcionitem = document.getElementById("descripcionitem").value;
        var precio = document.getElementById("precio").value;
        var cantidad_minima = document.getElementById("cantidad_minima").value;
        var cantidad_maxima = document.getElementById("cantidad_maxima").value;
        // Verificar si el item ya está en la lista
        var itemYaExiste = contratoItems.some(function (element) {
            return element.item === item;
        });

        if (itemYaExiste) {
            alert('El item ya ha sido agregado.');
            return;
        }

        var contratoItem = {
            item: item,
            descripcionitem: descripcionitem,
            precio: precio,
            cantidad_minima: cantidad_minima,
            cantidad_maxima: cantidad_maxima,
            itemseleccionado:  itemseleccionado
        };

        contratoItems.push(contratoItem);

        // Limpiar los campos
        document.getElementById("item").value = '';
        document.getElementById("descripcionitem").value = "";
        document.getElementById("precio").value = "";
        document.getElementById("cantidad_minima").value = "";
        document.getElementById("cantidad_maxima").value = "";

        // Actualizar el campo oculto
        document.getElementById("contratoItems").value = JSON.stringify(contratoItems);

        // Actualizar la tabla
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


            cell1.innerHTML = `<div class="text-center">${contratoItem. itemseleccionado}</div>`;
            cell2.innerHTML = `<div class="text-center">${contratoItem.descripcionitem}</div>`;
            cell3.innerHTML = `<div class="text-center">${contratoItem.precio}</div>`;
            cell4.innerHTML = `<div class="text-center">${contratoItem.cantidad_minima}</div>`;
            cell5.innerHTML = `<div class="text-center">${contratoItem.cantidad_maxima}</div>`;


        }
    }


    function mostrarValorSeleccionado() {
    var select = document.getElementById("item");
    var valorSeleccionado = select.options[select.selectedIndex].text;
    var divValorSeleccionado = document.getElementById("valorSeleccionado");
    alert("Valor seleccionado: " + valorSeleccionado);
  }
</script>


@endsection
