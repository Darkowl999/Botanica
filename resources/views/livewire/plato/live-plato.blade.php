<div>
    <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
                <table class="w-full">
                    <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Descripción</th>
                        <th class="px-4 py-3">Precio</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Cantidad</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <!--inicio foreach-->
                    @foreach($platos as $plato)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$plato->nombre}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$plato->descripcion}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$plato->precio}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-center text-green-800 rounded-full bg-green-400">{{$plato->estado}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$plato->cantidad}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <x-jet-button wire:click="eliminars({{$plato->id}})">Eliminar</x-jet-button>
                                <x-jet-button wire:click="eliminar({{$plato->id}})">Crear</x-jet-button>
                                <x-jet-button wire:click="eliminar({{$plato->id}})">Actualizar</x-jet-button>

                            </td>


                        </tr>
                    @endforeach
                    <!--fin for each-->

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
