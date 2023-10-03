@extends('layouts.app')

@section('content')

<div class="container mx-auto space-y-4">

    <h2 class="text-2xl font-bold mb-4">Nuevo Contrato</h2>

    <div class="relative overflow-x-auto shadow-md ax-w-screen-sm mx-auto">

        <form action="{{ route('contratos.store') }}" method="POST" class="grid grid-cols-2 gap-4 mb-4 max-w-screen-sm mx-auto">
            @csrf

            <!-- ... Resto de tus campos ... -->

            <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-toggle="modal" data-target="#addItemModal">
                Agregar Item
            </button>



            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar Contrato
            </button>
        </form>

    </div>

</div>

<!-- Modal para agregar un nuevo item -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Agregar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar un nuevo item -->
                <div class="mb-4">
                    <label class="block mb-1" for="item_descripcion">Descripción del Item:</label>
                    <input type="text" class="border rounded w-full py-2 px-3" id="item_descripcion" name="item_descripcion" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="item_cantidad_minima">Cantidad Mínima:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="item_cantidad_minima" name="item_cantidad_minima" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1" for="item_cantidad_maxima">Cantidad Máxima:</label>
                    <input type="number" class="border rounded w-full py-2 px-3" id="item_cantidad_maxima" name="item_cantidad_maxima" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="agregarItem()">Agregar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function agregarItem() {
        // Aquí puedes escribir lógica para agregar el item a la tabla o realizar alguna acción
        // Por ejemplo, puedes usar JavaScript para agregar una nueva fila en la tabla con los datos ingresados
        const descripcion = document.getElementById('item_descripcion').value;
        const cantidadMinima = document.getElementById('item_cantidad_minima').value;
        const cantidadMaxima = document.getElementById('item_cantidad_maxima').value;

        // Puedes agregar la lógica para agregar estos datos a la tabla o enviarlos al servidor
        // Por ejemplo, puedes crear una nueva fila en la tabla con estos datos

        // Luego, cierra el modal
        $('#addItemModal').modal('hide');
    }
</script>

@endsection
