@extends('layouts.app')

@section('content')
<div class="container mx-auto space-y-10">
    <h1 class="text-2xl font-bold mb-4 text-center">Provisiones de Contrato</h1>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-md mx-auto bg-gray-100 text-1xl font-bold text-center">
        Contrato Nro:{{$contrato->alias }} - {{$contrato->descripcion }} - {{$contrato->provisiones()->count()}}
    </div>

    <table class="w-full text-sm text-gray-500 dark:text-gray-400">
        <!-- Table Header -->
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">Item</th>
                <th scope="col" class="px-4 py-3">Descripción</th>
                <th scope="col" class="px-4 py-3">Cantidad Maxima</th>
                <th scope="col" class="px-4 py-3">Numero de provisiones</th>
                <th scope="col" class="px-4 py-3">Cantidad de Items</th>
                <th scope="col" class="px-4 py-3">Disponible</th>

                <!-- Add more headers as needed -->
                <th scope="col" class="px-2 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody id="contractTableBody">
            <!-- Contracts will be displayed here -->
            @foreach($contrato->contratoItems as $contratoItem)
            <!-- Contract row -->
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                <td class="px-4 py-4">{{ $contratoItem->item->descripcionitem }}</td>
                <td class="px-4 py-4">{{ $contratoItem->descripcion}}</td>
                <td class="px-4 py-4">{{ $contratoItem->cantidad_maxima }}</td>
                <td class="px-4 py-4"> {{$contratoItem->provisiones()->count() }} </td>
                <td class="px-4 py-4">{{ $contratoItem->getCantidadProvisionesAttribute() }} </td>
                <td class="px-4 py-4">{{$contratoItem->cantidad_maxima - $contratoItem->getCantidadProvisionesAttribute() }} </td>
                <td class="px-2 py-2">
                    <button id="agregarProvision_{{ $contratoItem->iditem }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mt-4">
                        Agregar Provision
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar la tabla de provisiones solo si hay provisiones -->
    @if ($contrato->provisiones()->count() > 0)


            <form action="{{ route('provisiones.store') }}" method="POST" id="provisionForm">
                @csrf
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <!-- Table Header -->
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 text-center">
                        <tr>
                            <th scope="col" class="px-2 py-2">Item</th>
                            <th scope="col" class="px-4 py-2">descripcion</th>
                            <th scope="col" class="px-3 py-2">Fecha</th>
                            <th scope="col" class="px-3 py-2">Cantidad</th>

                            <!-- Add more headers as needed -->
                        </tr>
                    </thead>
                    <tbody id="provisionesTableBody">
                        @foreach($contrato->provisiones as $provision)
                        <tr>
                            <td class="px-2 py-2 border-b text-center">
                                <input type="text" class="border rounded w-full py-2 px-3" id="item" name="item"
                                    value="{{ $provision->contratoItem->item->descripcionitem }}" readonly>
                                <input type="hidden" id="iditem" name="iditem" value="{{ $provision->contratoItem->iditem }}"
                                    readonly >
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <input type="text" class="border rounded w-full py-2 px-3" id="descripcionitem" name="descripcionitem"
                                    value="{{  $provision->contratoItem->descripcion }}" readonly>
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <input type="text" class="border rounded  py-2 px-3  w-2/4" id="fecha" name="fecha"
                                    value="{{$provision->fecha }}" readonly>
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <input type="text" class="border rounded py-2 px-3 w-2/4 d mr-2" id="cantidad_provision"
                                    name="cantidad_provision" value="{{$provision->cantidad_provision }}" readonly >
                            </td>

                        </tr>
                        <!-- Add more rows as needed -->
                        @endforeach
                    </tbody>
                </table>
            </form>

    @else
    <div class="text-center my-4">No hay provisiones para este contrato.</div>
    @endif

    <!-- Script para agregar nueva fila de provisiones -->
    <script>

        var itemsData = [];
        function cargarItemsData() {


                    // Obtener la tabla y sus filas
                    var table = document.getElementById('contractTableBody');
                    var rows = table.getElementsByTagName('tr');

                    // Recorrer cada fila de la tabla
                    for (var i = 0; i < rows.length; i++) {
                        var row = rows[i];
                        var cells = row.getElementsByTagName('td');

                        // Extraer la información del ID y cantidad máxima
                        var id = cells[0].textContent.trim(); // Asumiendo que la primera celda tiene el ID
                        var cantidadMaxima = cells[5].textContent.trim(); // Asumiendo que la tercera celda tiene la cantidad máxima

                        // Convertir la cantidad máxima a un número entero
                        cantidadMaxima = parseInt(cantidadMaxima, 10);

                        // Agregar los datos al vector
                        itemsData.push({ id: id, cantidadMaxima: cantidadMaxima });
                    }

                    return itemsData;
                }

                // Llamada a la función para cargar los datos en un vector
                var itemsData = cargarItemsData();

                // Mostrar el vector con los datos cargados
                console.log('Items Data:', itemsData);


                function obtenerCantidadMaxima(id,cantidad) {

            // Buscar el item por su ID en el vector itemsData
            var itemEncontrado = itemsData.find(item => item.id === id);
            //alert(id);
            if (itemEncontrado) {
                // Comparar la cantidad con la cantidad máxima
                if (cantidad < itemEncontrado.cantidadMaxima) {
                    // La cantidad es menor o igual a la cantidad máxima
                    return cantidad;
                } else {
                    // La cantidad supera la cantidad máxima
                    alert("Su cantidad supera la la disponible, se reemplazara el valor por el disponible");
                    return itemEncontrado.cantidadMaxima;
                }
            } else {
                console.error('No se encontró un item con el ID proporcionado.');
                return null;
                }
}






            function eliminarFilaProvisiones(button) {
                var row = button.closest('tr'); // Encuentra la fila más cercana
                 row.remove(); // Elimina la fila
                 botones(false);
            }


            function botones(valor){
                var agregarProvisionButtons = document.querySelectorAll('[id^="agregarProvision_"]');
                    agregarProvisionButtons.forEach(function(button) {
                        button.disabled = valor;
                    });

            }



        // Función para agregar nueva fila de provisiones
        function agregarFilaProvisiones(itemID, descripcion, item, idcontrato)
        {

            botones(true);

            var tbody = document.getElementById('provisionesTableBody');
            var newRow = tbody.insertRow(tbody.rows.length);
            // Celdas para la nueva fila
                    var cell1 = newRow.insertCell(0);
                    var cell2 = newRow.insertCell(1);
                    var cell3 = newRow.insertCell(2);
                    var cell4 = newRow.insertCell(3);

                    // Contenido de las celdas
                    cell1.innerHTML = '<input type="hidden"  id="idcontrato" name="idcontrato" value="' + idcontrato + '" readonly><input type="hidden"  id="itemID" name="itemID" value="' + itemID+ '" readonly><input type="text" class="border rounded w-full py-2 px-3 " id="item" name="item" value="' + item + '" readonly>';
                    cell2.innerHTML = '<input type="text" class="border rounded w-full py-2 px-3 text-left" id="descripcionitem" name="descripcionitem" value="' + descripcion + '" readonly>';

                    cell3.innerHTML = '<center><input type="date" class="d mr-2 border rounded w-full  py-2 px-3 w-2/4" id="fecha" name="fecha" required></center>';
                    cell4.innerHTML = '<center><input type="number" class="border rounded py-2 px-3 w-2/4 d mr-2" id="cantidad_provision" name="cantidad_provision" required>'+
                                    '<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2" onclick="eliminarFilaProvisiones(this)">Cancelar</button> ' +
                                    '<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded mr-2">Guardar</button></center>';



                    // Evento de cambio en la cantidad de provisiones para verificar si no excede la cantidad máxima
                    var inputCantidadProvision = cell4.querySelector('#cantidad_provision');
                    inputCantidadProvision.addEventListener('change', function() {

                                        inputCantidadProvision.value = obtenerCantidadMaxima(item,inputCantidadProvision.value) ;  // Establecer la cantidad máxima

                    });

        }

        // Evento de clic para agregar nueva fila de provisiones
        @foreach($contrato->contratoItems as $contratoItem)
        var agregarProvisionBtn_{{ $contratoItem->iditem }} = document.getElementById('agregarProvision_{{ $contratoItem->iditem }}');
        agregarProvisionBtn_{{ $contratoItem->iditem }}.addEventListener('click', function () {
            agregarFilaProvisiones({{ $contratoItem->iditem }}, '{{ $contratoItem->descripcion }}','{{  $contratoItem->item->descripcionitem }}',{{ $contratoItem->idcontrato }});
        });
        @endforeach

        // Evento de clic para agregar nueva fila de provisiones global
        var agregarProvisionGlobalBtn = document.getElementById('agregarProvisionGlobal');
        agregarProvisionGlobalBtn.addEventListener('click', function () {
            agregarFilaProvisiones('', '','','');
        });
    </script>


</div>

@endsection

