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


                            <!-- Agrega esta tabla en tu HTML para mostrar los Contrato Items -->
                        <h2>Contrato Items</h2>
                        <button type="button" onclick="agregarFila()" class="  mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Agregar
                        </button>
                        <div>
                        <input type="text" id="contratoItems" name="contratoItems" class="max-w-screen-sm mx-auto">
                        </div>
                        <table class=" mb-4 border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="px-6 py-2 border-b p-2 text-center">Item</th>
                                    <th class="px-4 py-2 border-b p-2 text-center">Descripción</th>
                                    <th class="px-4 py-2 border-b p-2 text-center">Accesorios</th>
                                    <th class="px-4 py-2 border-b p-2 text-center">Cantidad Mínima</th>
                                    <th class="px-4 py-2 border-b p-2 text-center">Cantidad Máxima</th>
                                    <th class="px-4 py-2 border-b p-2 text-center">Acciones</th>
                                </tr>
                            </thead>

                    <tbody id="contratoItemsTableBody">
                        <!-- Aquí se listarán los contratoitems -->
                    @foreach($contrato->contratoItems as $contratoItem)
                    <tr>
                        <td class="px-2 py-2 border-b text-center">
                        <input type="text" class="border rounded w-full py-2 px-3" id="item" name="item"  value="{{ $contratoItem->item->descripcionitem }} "  readonly>
                        <input type="hidden" id="iditem" name="iditem"  value="{{ $contratoItem->item->iditem }} "  readonly></td>
                        <td class="px-4 py-2 border-b text-center"><input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem"  value="{{ $contratoItem->descripcion}}"></td>
                        <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="accesorios" name="accesorios"  value="{{ $contratoItem->accesorios }}"></td>
                        <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_minima" name="cantidad_minima"  value="{{ $contratoItem->cantidad_minima }}"></td>
                        <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="$contratoItem->cantidad_maxima" name="$contratoItem->cantidad_maxima"  value="{{ $contratoItem->cantidad_maxima }}" ></td>
                        <td class="px-4 py-2 border-b p-2 text-center">
                            <button onclick="eliminarFila(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Eliminar</button>
                        </div>
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


    function agregarFila() {
        console.log( contratoItems);
        var newRow = document.getElementById('contratoItemsTableBody').insertRow();
     //
        newRow.innerHTML = `
            <td class="px-4 py-2 border-b p-2 text-center">
                <select name="item" id="item" >
                    @foreach($item as $items)
                        <option value="{{ $items->iditem }}">{{ $items->descripcionitem }}</option>
                    @endforeach
                </select></td>

            <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem" required></td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="accesorios" name="accesorios"></td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_minima" name="cantidad_minima"></td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_maxima" name="cantidad_maxima"></td>
            <td class="px-4 py-2 border-b p-2 text-center">
                <button onclick="guardar()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mx-1">guardar</button>
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

        if(acciones=='a'){

            var uno=(rows.length-1);


        }
        else{
            var uno=rows.length;
        }

        if(uno==0)
                 contratoItems=[]
                       for (var i = 0; i < uno; i++) {
                            var cells = rows[i].getElementsByTagName('td');
                            var contratoItem = {
                                item: cells[0].getElementsByTagName('input')[0].value,
                                iditem: parseInt(cells[0].getElementsByTagName('input')[1].value),
                                descripcionitem: cells[1].getElementsByTagName('input')[0].value,
                                accesorios: cells[2].getElementsByTagName('input')[0].value,
                                cantidad_minima: cells[3].getElementsByTagName('input')[0].value,
                                cantidad_maxima: cells[4].getElementsByTagName('input')[0].value,
                            };


                            contratoItems.push(contratoItem);
                        }

                        if(acciones=='a'){
                             var cells = rows[uno].getElementsByTagName('td');
                               // var itemYaExiste = contratoItems.some(function (element) {
                                 //       return element.iditem ===  parseInt(cells[0].getElementsByTagName('select')[0].value);
                                //});
                               // alert(itemYaExiste);
                                  // if (itemYaExiste) {
                                    //   alert('El item ya ha sido agregado.');

                                   //}
                                   var selectedOption = cells[0].getElementsByTagName('select')[0];

                            var contratoItem = {

                                iditem: parseInt( cells[0].getElementsByTagName('select')[0].value),
                                item: selectedOption.options[selectedOption.selectedIndex].textContent,
                                descripcionitem: cells[1].getElementsByTagName('input')[0].value,
                                accesorios: cells[2].getElementsByTagName('input')[0].value,
                                cantidad_minima: cells[3].getElementsByTagName('input')[0].value,
                                cantidad_maxima: cells[4].getElementsByTagName('input')[0].value,
                                };

                                contratoItems.push(contratoItem);
                            }
                            console.log(contratoItems);

                        document.getElementById('contratoItems').value = JSON.stringify(contratoItems);
        }

    function guardar() {


        if(document.getElementById('cantidad_minima').value >= document.getElementById('cantidad_maxima').value)
                {
                    alert("La cantidad Maxima debe se Mayor a la Cantidad Minima");
                    document.getElementById('cantidad_minima').focus();
                }else{
                    var rows = document.getElementById('contratoItemsTableBody').getElementsByTagName('tr');
                    var un=(rows.length-1);
                    var veri = rows[un].getElementsByTagName('td');
                    alert(veri[0].getElementsByTagName('select')[0].value);
                    var itemYaExiste = contratoItems.some(function (element) {
                                        return element.iditem ===  parseInt(veri[0].getElementsByTagName('select')[0].value);
                                });
                               // alert(itemYaExiste);
                                   if (itemYaExiste) {
                                       alert('El item ya ha sido agregado.');
                                       var eliminarButton = veri[5].getElementsByTagName('button')[0];
                                            // Llama a la función que maneja la eliminación
                                            eliminarFila(eliminarButton);
                                        }else{
                                        // Llama a actualizarContratoItems para actualizar el campo oculto.

                                        actualizarContratoItems('a');

                                        // Llama a la función para mostrar la tabla actualizada.
                                        mostrarTablaActualizada();

                                   }


            }

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
            <td class="px-2 py-2 border-b text-center"><input type="hidden" id="iditem" name="iditem" readonly value=${contratoItems[i].iditem}>
                <input type="text" class="border rounded w-full py-2 px-3" id="item" name="item" value='${contratoItems[i].item}' >
                 </td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem" value=${contratoItems[i].descripcionitem} ></td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="text" class="border rounded w-full py-2 px-3" id="accesorios" name="accesorios" value=${contratoItems[i].accesorios} ></td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_minima" name="cantidad_minima" value=${contratoItems[i].cantidad_minima} ></td>
            <td class="px-4 py-2 border-b p-2 text-center"><input type="number" class="border rounded w-full py-2 px-3" id="cantidad_maxima" name="cantidad_maxima" value=${contratoItems[i].cantidad_maxima} ></td>
            <td class="px-4 py-2 border-b p-2 text-center">
                <button onclick="eliminarFila(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Eliminar</button>
            </td>
        `;
    }
}









</script>





@endsection
