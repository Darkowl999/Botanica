<div>
   <div class="flex justify-center">
       <x-jet-button wire:click="modal({{0}})">Reservar</x-jet-button>
   </div>
    <x-jet-dialog-modal wire:model="modal" wire:click="$toggle('modal')">
        <x-slot name="title">
            Crear Reserva
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="reservar" class="px-10">
                <div>
                    <x-jet-label for="hora" value="{{ __('Hora') }}"/>
                    <x-jet-input id="hora" wire:model="hora" class="block mt-1 w-full"
                                 type="time" name="hora" required/>
                </div>
                <div>
                    <x-jet-label for="fecha" value="{{ __('Fecha') }}"/>
                    <x-jet-input id="fecha" wire:model="fecha" class="block mt-1 w-full"
                                 type="date" name="fecha" required/>
                </div>

                <div>
                    <x-jet-label for="cant_personas" value="{{ __('Cantidad de personas') }}"/>
                    <x-jet-input id="cant_personas" wire:model="cant_personas" class="block mt-1 w-full"
                                 type="number" name="cant_personas" required/>
                </div>

                <div>
                    <x-jet-label for="mesa_id" value="{{ __('Mesa') }}"/>
                    @if($mesas_disponibles->isNotEmpty())
                    <select wire:model="mesa_id" name="mesa_id" id="mesa_id" required
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($mesas_disponibles as $mesa)
                            <option value="{{$mesa->id}}" {{$mesa->id==1?'selected':''}}>{{$mesa->id}}</option>
                        @endforeach
                    </select>
                    @else
                        <x-jet-label>No existen mesas disponibles para cambiar</x-jet-label>
                    @endif
                </div>
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

            <x-jet-danger-button class="ml-2" wire:click="elimiarReserva" wire:loading.attr="disabled">
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
                            <th class="px-4 py-3">Usuario</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Hora</th>
                            <th class="px-4 py-3">Cant. de personas</th>
                            <th class="px-4 py-3">Mesa</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        <!--inicio foreach-->
                        @foreach($reservas as $reserva)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    <p class="font-semibold text-black">{{\App\Models\User::find($reserva->user_id)->name}}</p>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    <p class="font-semibold text-black">{{$reserva->fecha}}</p>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    <p class="font-semibold text-black">{{$reserva->hora}}</p>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    <p class="font-semibold text-black">{{$reserva->cant_personas}}</p>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    <p class="font-semibold text-black">{{$reserva->mesa_id}}</p>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    <x-jet-button wire:click="eliminar({{$reserva->id}})">Eliminar</x-jet-button>
                                    <x-jet-button wire:click="modal({{$reserva->id}})">Actualizar</x-jet-button>

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
