<x-slot name="header">
    <h1 class="text-gray-900">Lista de tareas 📋</h1>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div>
                <button wire:click="create()" class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                    Nueva Tarea
                </button>
                <select class="w-60 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="selectedState">
                    <option value="">Todo</option>
                    @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                </select>
                <button wire:click="generateReport()" class="bg-green-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                    Generar reporte
                </button>
            </div>
            @if($modalRepo)
            @include('livewire.repo')
            @endif
            @if($modal)
            @include('livewire.create')
            @endif
            <table class="table-fixed w-full mt-1.5">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2">NOMBRE</th>
                        <th class="px-4 py-2">FECHA INICIO</th>
                        <th class="px-4 py-2">FECHA FIN</th>
                        <th class="px-4 py-2">ESTADO</th>
                        <th class="px-4 py-2">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td class="border px-4 py-2">{{$task->name}}</td>
                        <td class="border px-4 py-2">{{$task->start_date}}</td>
                        <td class="border px-4 py-2">{{$task->end_date}}</td>
                        <td class="border px-4 py-2">{{$task->states->name}}</td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="editTask({{$task->id}}, {{$task->id_state}})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4">Editar</button>
                            <button wire:click="deleteTask({{$task->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Borrar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>