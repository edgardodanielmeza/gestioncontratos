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
                    <label class="text-2xl font-bold" for="descripcion">Descripción Contrato:</label>
                    <input type="text" class="border rounded w-full py-2 px-3" id="descripcion" name="descripcion" value="{{ $contrato->descripcion }}" required>
                </div>

                <div class="mb-4">
                    <label class="text-2xl font-bold" for="idContrataciones">ID Contrataciones:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="idContrataciones" name="idContrataciones" value="{{ $contrato->idContrataciones }}" required>

                </div>

                <div class="mb-4">
                    <label class="text-2xl font-bold" for="idtipocontrato">Tipo Contrato:</label>
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
                    <label class="text-2xl font-bold" for="fechafirma">Fecha de Firma:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fechafirma" name="fechafirma" value="{{ $contrato->fechafirma }}" required>
                </div>

                <div class="mb-4">
                    <label class="text-2xl font-bold" for="anho">Año:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="anho" name="anho" value="{{ $contrato->anho }}" required>
                </div>

                <div class="mb-4">
                    <label for="idmonto">Monto:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="idmonto" name="idmonto" value="{{ $contrato->idmonto }}" required>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 max-w-screen-sm mx-auto">
                <div class="mb-4">
                    <label class="text-2xl font-bold" for="alias">Alias:</label>
                    <input type="text" class="border rounded w-full py-2 px-3" id="alias" name="alias" value="{{ $contrato->alias }}" required>
                </div>

                <div class="mb-4">
                    <label class="text-2xl font-bold" for="idadministrador">Administrador:</label>
                    <select name="idadministrador" id="idadministrador" class="border rounded w-full py-2 px-3">
                        @foreach($administradores as $administrador)
                        <option value="{{ $administrador->idadministrador }}" {{ $contrato->idadministrador == $administrador->idadministrador ? 'selected' : '' }}>
                            {{ $administrador->nombres }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="text-2xl font-bold" for="idcontratista">Contratista:</label>
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
                    <label for="fechainicio" class="text-2xl font-bold">Fecha de Inicio:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fechainicio" name="fechainicio" value="{{ $contrato->fechainicio }}" required>
                </div>

                <div class="mb-4">
                    <label for="fecha_ARTP" class="text-2xl font-bold">Fecha ARTP:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fecha_ARTP" name="fecha_ARTP" value="{{ $contrato->fecha_ARTP }}">
                </div>

                <div class="mb-4">
                    <label for="fecha_ARTD" class="text-2xl font-bold">Fecha ARTD:</label>
                    <input type="date" class="border rounded w-full py-2 px-3" id="fecha_ARTD" name="fecha_ARTD" value="{{ $contrato->fecha_ARTD }}">
                </div>
            </div>

            <div class="mb-4">
                @php
                    $fiscalesContratoIds = $contrato->fiscales->pluck('idfiscal')->toArray();
                @endphp
                <label class="text-2xl font-bold" for="fiscales">Fiscales asignados:</label>
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


                            <!-- Agrega esta tabla en tu HTML para mostrar los Contrato Items -->
                            <h2 class="text-2xl font-bold mb-4">Contrato Items</h2>

                            <button onclick="agregarFila()" class="mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Agregar
                            </button>

                            <div class="mb-4">
                                <input type="hidden" id="contratoItems" name="contratoItems" class="max-w-screen-sm mx-auto border border-gray-300 p-2 rounded">
                            </div>

                            <table class="border border-gray-300 mb-4 w-full">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-2 border-b text-center">Item</th>
                                        <th class="px-4 py-2 border-b text-center">Descripción</th>
                                        <th class="px-4 py-2 border-b text-center">precio</th>
                                        <th class="px-4 py-2 border-b text-center">Cantidad Mínima</th>
                                        <th class="px-4 py-2 border-b text-center">Cantidad Máxima</th>
                                        <th class="px-4 py-2 border-b text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="contratoItemsTableBody">
                                    <!-- Aquí se listarán los contratoitems -->
                                    @foreach($contrato->contratoItems as $contratoItem)
                                        <tr>
                                            <td class="px-2 py-2 border-b text-center">
                                                <input type="text" class="border rounded w-full py-2 px-3" id="item" name="item" value="{{ $contratoItem->item->descripcionitem }}" readonly>
                                                <input type="hidden" id="iditem" name="iditem" value="{{ $contratoItem->item->iditem }}" readonly>
                                            </td>
                                            <td class="px-4 py-2 border-b text-center"><input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem" value="{{ $contratoItem->descripcion }}"  onchange="actualizavalor()"></td>
                                            <td class="px-4 py-2 border-b text-center"><input type="text" class="border rounded w-full py-2 px-3" id="precio" name="precio" value="{{ $contratoItem->precio }}" onchange="actualizavalor({{ $contratoItem->item->iditem}})"></td>
                                            <td class="px-4 py-2 border-b text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_minima" name="cantidad_minima" value="{{ $contratoItem->cantidad_minima }}" onchange="actualizavalor()"></td>
                                            <td class="px-4 py-2 border-b text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_maxima" name="cantidad_maxima" value="{{ $contratoItem->cantidad_maxima }}" onchange="actualizavalor()"></td>
                                            <td class="px-4 py-2 border-b text-center">
                                                <button onclick="eliminarFila(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Eliminar</button>
                                            </td>
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

        var contratoItems = [];
        actualizarContratoItems();
        function actualizavalor()
        {
        // Verifica si contratoItems está cargado y actualiza sus elementos
            // Verifica si contratoItems está vacío
                contratoItems = []
                console.log('contratoItems está vacío. Se inicializará.');
                actualizarContratoItems();


        }

            function minmax(){




                if (document.getElementById('cantidad_minima').value >= document.getElementById('cantidad_maxima').value) {
                    alert("La cantidad Máxima debe ser mayor que la Cantidad Mínima");

                    document.getElementById('cantidad_minima').focus();

                }
            }


            function agregarFila() {

                var rows = document.getElementById('contratoItemsTableBody').getElementsByTagName('tr');
                var u = rows.length
                //alert(u);
                if (u>0 && !contratoItems){
                    actualizarContratoItems();
                }
                var newRow = document.getElementById('contratoItemsTableBody').insertRow();


                newRow.innerHTML = `
                    <td class="px-4 py-2 border-b p-2 text-center">
                        <select name="item" id="item">
                            @foreach($item as $items)
                                <option value="{{ $items->iditem }}">{{ $items->descripcionitem }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-4 py-2 border-b p-2 text-center">
                        <input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem" required>
                    </td>
                    <td class="px-4 py-2 border-b p-2 text-center">
                        <input type="text" class="border rounded w-full py-2 px-3" id="precio" name="precio">
                    </td>
                    <td class="px-4 py-2 border-b p-2 text-center">
                        <input type="number" class="border rounded w-full py-2 px-3" id="cantidad_minima" name="cantidad_minima">
                    </td>
                    <td class="px-4 py-2 border-b p-2 text-center">
                        <input type="number" class="border rounded w-full py-2 px-3" id="cantidad_maxima" name="cantidad_maxima" onblur="minmax()">
                    </td>
                    <td class="px-4 py-2 border-b p-2 text-center">
                        <button onclick="guardar()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mx-1">Guardar</button>
                        <button onclick="eliminarFila(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Cancelar</button>
                    </td>
                `;

                // Actualizar el campo oculto
                //actualizarContratoItems('a');
            }

            function eliminarFila(button) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);

                // Actualizar el campo oculto
                actualizarContratoItems('b');
            }

            function actualizarContratoItems(acciones) {
                var rows = document.getElementById('contratoItemsTableBody').getElementsByTagName('tr');
                var uno = acciones === 'a' ? rows.length - 1 : rows.length;

                if (uno === 0) {
                    contratoItems = [];
                }


                if (acciones === 'a') {
                    var cells = rows[uno].getElementsByTagName('td');
                    var selectedOption = cells[0].querySelector('select');

                    var contratoItem = {
                        iditem: parseInt(selectedOption.value),
                        item: selectedOption.options[selectedOption.selectedIndex].textContent,
                        descripcionitem: cells[1].querySelector('input').value,
                        precio: parseInt(cells[2].querySelector('input').value),
                        cantidad_minima: cells[3].querySelector('input').value,
                        cantidad_maxima: cells[4].querySelector('input').value,
                    };

                    contratoItems.push(contratoItem);
                }else{
                    for (var i = 0; i < uno; i++) {
                    var cells = rows[i].getElementsByTagName('td');
                    var contratoItem = {
                        iditem: parseInt(cells[0].getElementsByTagName('input')[1].value),
                        item: cells[0].querySelector('input').value,
                        descripcionitem: cells[1].querySelector('input').value,
                        precio: parseInt(cells[2].querySelector('input').value),
                        cantidad_minima: cells[3].querySelector('input').value,
                        cantidad_maxima: cells[4].querySelector('input').value,
                    };

                    contratoItems.push(contratoItem);
                }

                }

                console.log(contratoItems);
                document.getElementById('contratoItems').value = JSON.stringify(contratoItems);
            }
            function mostrarTablaActualizada() {
                    // Obtiene el cuerpo de la tabla.
                    var tableBody = document.getElementById('contratoItemsTableBody');

                    // Borra el contenido actual de la tabla.
                    tableBody.innerHTML = '';
                    console.log(contratoItems);
                    // Obtiene los contratoItems.
                    // var contratoItems = JSON.parse(document.getElementById('contratoItems').value);

                    // Recorre los contratoItems y agrega filas a la tabla.
                    for (var i = 0; i < contratoItems.length; i++) {
                        var newRow = tableBody.insertRow();
                        newRow.innerHTML = `
                            <td class="px-2 py-2 border-b text-center">
                                <input type="text" class="border rounded w-full py-2 px-3" id="item" name="item" value='${contratoItems[i].item}' >
                                <input type="hidden" id="iditem" name="iditem" readonly value=${contratoItems[i].iditem}>
                            </td>
                            <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem" value=${contratoItems[i].descripcionitem}  onchange="actualizavalor()"></td>
                            <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="precio" name="precio" value="${contratoItems[i].precio}"   onchange="actualizavalor()"></td>
                            <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_minima" name="cantidad_minima" value=${contratoItems[i].cantidad_minima} onchange="actualizavalor()" ></td>
                            <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_maxima" name="cantidad_maxima" value=${contratoItems[i].cantidad_maxima}  onchange="actualizavalor()"></td>
                            <td class="px-4 py-2 border-b p-2 text-center">
                                <button onclick="eliminarFila(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Eliminar</button>
                            </td>
                        `;
            }
        }
            function guardar() {
                var rows = document.getElementById('contratoItemsTableBody').getElementsByTagName('tr');
                var un = rows.length - 1;
                var veri = rows[un].getElementsByTagName('td');
                var selectedOption = veri[0].querySelector('select');
                var idItemSeleccionado = parseInt(selectedOption.value);


                if (veri[3].querySelector('input').value >= veri[4].querySelector('input').value) {
                    alert("La cantidad Máxima debe ser mayor que la Cantidad Mínima");

                    veri[3].querySelector('input').focus();

                }else{
                                var itemYaExiste = contratoItems.some(function (element) {
                                return element.iditem === idItemSeleccionado;
                            });
                            console.log(contratoItems);


                            if (itemYaExiste) {
                                alert('El item ya ha sido agregado.');
                                var eliminarButton = veri[5].querySelector('button');

                                var row = eliminarButton.parentNode.parentNode;
                                row.parentNode.removeChild(row);


                                return;
                            } else {
                                actualizarContratoItems('a');
                                mostrarTablaActualizada();
                            }
                }


            }
</script>





@endsection
