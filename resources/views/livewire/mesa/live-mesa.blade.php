<div>
    <div class="flex justify-center pb-10 space-x-2">

        <button type="button"
                class="w-24 h-10 bg-white border border-black text-center text-black font-semibold rounded-md ">{{'Libre'}}</button>
        <button
            class="w-24 h-10 bg-red-500 border border-black text-center text-white font-semibold rounded-md">{{'Ocupado'}}</button>
        <button
            class="w-24 h-10 bg-green-500 border border-black text-center text-white font-semibold rounded-md">{{'Reservado'}}</button>
        <button wire:click="$toggle('mesaNueva')"
                class="w-24 h-10 bg-gray-700 border border-black text-center text-white font-semibold rounded-md">{{'Nueva mesa'}}</button>
    </div>
    <div class="grid grid-cols-8 gap-4">
        @foreach($mesas as $m)
            @if($m->estado==='Libre')
                <button wire:click="mesaModal({{$m->id}})"
                        class="bg-white hover:bg-gray-500 shadow-2xl rounded-md h-24 border border-black text-black text-center text-5xl font-semibold">
                    {{$m->id}}
                </button>
            @else
                <button wire:click="mesaModal({{$m->id}})"
                        class="{{$m->estado==='Ocupado'?'bg-red-500 hover:bg-red-700':'bg-green-500 hover:bg-green-700'}} border border-black shadow-2xl rounded-md h-24 text-white text-center text-5xl font-semibold">
                    {{$m->id}}
                </button>
            @endif
        @endforeach
    </div>

    <x-jet-dialog-modal wire:model="mesaNueva" wire:click="$toggle('mesaNueva')">
        <x-slot name="title">
            Crear Mesa
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="crear" class="px-10">
                <div>
                    <x-jet-label for="capacidad" value="{{ __('Capacidad') }}"/>
                    <x-jet-input id="capacidad" wire:model="capacidad" class="block mt-1 w-full"
                                 type="number" name="capacidad" required/>
                </div>

                <div>
                    <x-jet-label for="area" value="{{ __('Area') }}"/>
                    <select wire:model="area_id" name="area" id="area" required
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" {{$area->id==1?'selected':''}}>{{$area->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-center pt-5">
                    <x-jet-button wire:click="$toggle('mesaNueva')">Crear</x-jet-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>


    @if($mesa!=null)
        <x-jet-dialog-modal wire:model="mesaModal" wire:click="$toggle('mesaModal')">
            <x-slot name="title">
                Mesa {{$mesa->id}}
            </x-slot>

            <x-slot name="content">
                <form wire:submit.prevent="editar" class="px-10">
                    <div>
                        <x-jet-label for="capacidad" value="{{ __('Capacidad') }}"/>
                        <x-jet-input id="capacidad" wire:model="capacidad" class="block mt-1 w-full"
                                     type="number" name="capacidad" required/>
                    </div>
                    <div>
                        <x-jet-label for="area_id" value="{{ __('Area') }}"/>
                        <select wire:model="area_id" name="area_id" id="area_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            @foreach($areas as $area)
                                <option
                                    value="{{$area->id}}">{{$area->nombre}}</option>
                            @endforeach
                        </select>

                    </div>
                    @if($mesa->estado==='Libre')
                        <div class="flex justify-between pt-5">
                            <x-jet-button wire:click="eliminar" type="button"
                                          class="order-first bg-red-500 hover:bg-red-400 focus:bg-red-700">Eliminar
                            </x-jet-button>
                            <x-jet-button wire:click="$toggle('mesaModal')" class="order-last">Guardar</x-jet-button>
                        </div>
                    @endif
                </form>

            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
