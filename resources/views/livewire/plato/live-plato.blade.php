<div>
    <div class="flex justify-center">
        <x-jet-button wire:click="modal({{0}})">Crear plato</x-jet-button>
    </div>
    <x-jet-dialog-modal wire:model="modal" wire:click="$toggle('modal')">
        <x-slot name="title">
            Crear Plato
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="crear" class="px-10">
                <div>
                    <x-jet-label for="nombre" value="{{ __('Nombre') }}"/>
                    <x-jet-input id="nombre" wire:model="nombre" class="block mt-1 w-full"
                                 type="text" name="nombre" required/>
                </div>
                <div>
                    <x-jet-label for="descripcion" value="{{ __('Descripcion') }}"/>
                    <x-jet-input id="descripcion" wire:model="descripcion" class="block mt-1 w-full"
                                 type="text" name="descripcion" required/>
                </div>

                <div>
                    <x-jet-label for="precio" value="{{ __('Precio') }}"/>
                    <x-jet-input id="precio" wire:model="precio" class="block mt-1 w-full"
                                 type="number" name="precio" required/>
                </div>

                <div>
                    <x-jet-label for="cantidad" value="{{ __('Cantidad') }}"/>
                    <x-jet-input id="cantidad" wire:model="cantidad" class="block mt-1 w-full"
                                 type="number" name="cantidad" required/>
                </div>
                @if($editar)
                    <x-jet-label for="estado" value="{{ __('Estado') }}"/>

                    <select wire:model="estado" name="mesa_id" id="estado" required
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="{{'Agotado'}}">Agotado</option>
                        <option value="{{'Disponible'}}">Disponible</option>

                    </select>
                @endif

                <div class="flex justify-center pt-5">
                    <x-jet-button wire:click="$toggle('modal')">Guardar</x-jet-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="eliminar">
        <x-slot name="title">
            Eliminar
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('eliminar')" wire:loading.attr="disabled">
                Cerrar
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="elimiarPlato" wire:loading.attr="disabled">
                Eliminar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>




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
                                <x-jet-button wire:click="eliminar({{$plato->id}})">Eliminar</x-jet-button>
                                <x-jet-button wire:click="modal({{$plato->id}})">Actualizar</x-jet-button>

                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
