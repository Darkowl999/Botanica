<div>
    <div class="flex justify-center">
        <x-jet-button wire:click="modal({{0}})">Crear Pedido</x-jet-button>
    </div>

    <x-jet-dialog-modal wire:model="modal" wire:click="$toggle('modal')">
        <x-slot name="title">
            Crear Plato
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="crear" class="px-10">

                <x-jet-label for="mesa_id" value="{{ __('Mesa') }}"/>
                <select wire:model="mesa_id" name="mesa_id" id="mesa_id" required
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($mesas as $mesa)
                        <option value="{{$mesa->id}}">{{$mesa->id}}</option>
                    @endforeach
                </select>

                <x-jet-label for="user_id" value="{{ __('Cliente') }}"/>
                <select wire:model="user_id" name="user_id" id="user_id" required
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->name}}</option>
                    @endforeach
                </select>

                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full">
                            <table class="w-full">
                                <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Cantidad</th>
                                    <th class="px-4 py-3">Plato</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                <!--inicio foreach-->
                                @foreach($platos_pedidos as $key =>$p)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            <p class="font-semibold text-black">{{$p['cantidad']}}</p>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            <p class="font-semibold text-black">{{$p['plato']['nombre']}}</p>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            @if($pedido_actual!=null && $pedido_actual->activo)
                                            <x-jet-button wire:click="quitarPlato({{$key}})">Eliminar</x-jet-button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                @if(($pedido_actual!=null && $pedido_actual->activo)|| $crear)
                    <div class="flex justify-center pt-5">
                        <x-jet-button type="button" wire:click="$toggle('agregar')">Añadir plato</x-jet-button>
                    </div>
                    <div class="flex justify-center pt-5">
                        <x-jet-button wire:click="$toggle('modal')">Guardar</x-jet-button>
                    </div>
                    @if($editar)

                        <div class="flex justify-between pt-5">
                            <x-jet-button type="button" class="order-first" wire:click="$eliminarPedido">Eliminar
                                Pedido
                            </x-jet-button>

                            <x-jet-button type="button" class="order-first" wire:click="cerrar">Cerrar pedido
                            </x-jet-button>

                        </div>
                    @endif
                @endif

            </form>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="agregar" wire:click="$toggle('agregar')">
        <x-slot name="title">
            Agregar Plato
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="agregar" class="px-10">
                <div>
                    <x-jet-label for="cantidad" value="{{ __('Cantidad') }}"/>
                    <x-jet-input id="cantidad" wire:model="cantidad" class="block mt-1 w-full"
                                 type="number" name="cantidad" required/>
                </div>

                <x-jet-label for="plato_id" value="{{ __('Plato') }}"/>
                <select wire:model="plato_id" name="plato_id" id="plato_id" required
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($platos as $plato)
                        <option value="{{$plato->id}}">{{$plato->nombre}}</option>
                    @endforeach
                </select>


                <div class="flex justify-center pt-5">
                    <x-jet-button wire:click="$toggle('agregar')">Guardar</x-jet-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <div class="grid grid-cols-8 gap-4">
        @foreach($pedidos as $pedido)

            <button wire:click="modal({{$pedido->id}})"
                    class="bg-blue-500 hover:bg-blue-700 border border-black shadow-2xl rounded-md h-24 text-white text-center text-xl font-semibold">
                Pedidos de la mesa {{$pedido->mesa_id}}
            </button>
        @endforeach
    </div>
</div>
