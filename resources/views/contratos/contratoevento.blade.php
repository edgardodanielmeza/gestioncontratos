@extends('layouts.app')

@section('content')
<div class="container mx-auto  space-y-4">
    <h2 class="text-2xl font-bold mb-4">Detalle del Evento</h2>
    <!-- Mostrar el evento si existe -->
    @if($contrato->eventos->count() > 0)
    <table class="border border-gray-300 mb-4 w-full">
            <thead>
                <tr>
                    <th class="px-6 py-2 border-b text-center">Evento</th>
                    <th class="px-6 py-2 border-b text-center">Descripción</th>
                    <th class="px-6 py-2 border-b text-center">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contrato->eventos as $evento)
                    <tr>
                        <td>{{ $evento->evento }}</td>
                        <td>{{ $evento->descripcion }}</td>
                        <td>{{ $evento->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay eventos disponibles para este contrato.</p>
    @endif

    <!-- Formulario para cargar un nuevo evento -->
    <div class="relative overflow-x-auto shadow-md ax-w-screen-sm mx-auto">

                <h2>Cargar Nuevo Evento</h2>
                <form action="#" method="POST">
                    @csrf
                    <table class="border border-gray-300 mb-4 w-full">
                        <tr>
                                <input type="hidden" name="idcontrato" value="{{ $contrato->idcontrato }}">
                           <th class="px-6 py-2 border-b text-center">
                                <label for="evento">Evento:</label>
                                <input type="text" class="form-control" id="evento" name="evento" required>
                           </th>
                           <th class="px-6 py-2 border-b text-center">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                           </th>
                           <th class="px-6 py-2 border-b text-center">
                                <label for="fecha">Fecha:</label>
                                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                           </th>
                        </tr>
                    </table>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Evento</button>
                </form>
        </div>
</div>
@endsection
