<div>
    {{-- Be like water. --}}
    <!--Este componente es de tailwind css -->
        <x-jet-dialog-modal wire:model="modal" wire:click="$toggle('modal')">
            <x-slot name="title">
                Editar usuario
            </x-slot>

            <x-slot name="content">
                <form wire:submit.prevent="crear" class="px-10">
                    <div>
                        <x-jet-label for="name" value="{{ __('Nombre') }}"/>
                        <x-jet-input id="name" wire:model="name" class="block mt-1 w-full"
                                     type="text" name="name" required/>
                    </div>
                    <div>
                        <x-jet-label for="email" value="{{ __('Correo') }}"/>
                        <x-jet-input id="email" wire:model="email" class="block mt-1 w-full"
                                     type="email" name="email" required/>
                    </div>

                    <div>
                        <x-jet-label for="direccion" value="{{ __('Direccion') }}"/>
                        <x-jet-input id="direccion" wire:model="direccion" class="block mt-1 w-full"
                                     type="text" name="direccion" required/>
                    </div>
                        <x-jet-label for="estado" value="{{ __('Estado') }}"/>
                    @if($editar)
                        <select wire:model="estado" name="estado" id="estado" required
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="{{1}}">Activo</option>
                            <option value="{{0}}">Inactivo</option>
                        </select>
                    @endif
                    <div>
                        <x-jet-label for="telefono" value="{{ __('Teléfono') }}"/>
                        <x-jet-input id="telefono" wire:model="telefono" class="block mt-1 w-full"
                                     type="number" name="telefono" required/>
                    </div>

                    @if($editar)
                    <div>
                        <x-jet-label for="rol" value="{{ __('Rol') }}"/>
                        <select wire:model="rol" name="rol" id="rol" required
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="{{'1,0,0'}}">Administrador</option>
                            <option value="{{'0,2,0'}}">Empleado</option>
                            <option value="{{'0,0,3'}}">Cliente</option>
                        </select>
                    </div>
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

                <x-jet-danger-button class="ml-2" wire:click="eliminarUser" wire:loading.attr="disabled">
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
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Direccion</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Telefono</th>
                            <th class="px-4 py-3">Rol</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                       <!--inicio foreach-->
                        @foreach($users as $user)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="{{$user->profile_photo_url}}" alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-black">{{$user->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$user->email}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$user->direccion}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-center text-green-800 rounded-full bg-green-400">{{$user->estado?'Activo':'Inactivo'}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$user->telefono}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border  space-y-1">
                                @php
                                    $roles=explode( ',', $user->rol);
                                @endphp
                                @if($roles[0]=='1')
                                <span class="font-semibold text-center text-blue-800 rounded-full bg-blue-400">{{'Administrador'}}</span>
                                @endif
                                @if($roles[1]=='2')
                                    <span class="font-semibold text-center text-blue-800 rounded-full bg-blue-400">{{'Empleado'}}</span>
                                @endif
                                @if($roles[2]=='3')
                                    <span class="font-semibold text-center text-blue-800 rounded-full bg-blue-400">{{'Cliente'}}</span>
                                @endif

                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                @if(\Illuminate\Support\Facades\Auth::user()->id!=$user->id)
                                <x-jet-button wire:click="eliminar({{$user->id}})">Eliminar</x-jet-button>
                                <x-jet-button wire:click="modal({{$user->id}})">Actualizar</x-jet-button>
                                @endif
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
