<div>
    {{-- Be like water. --}}
    <!--Este componente es de tailwind css -->
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
                                <x-jet-button wire:click="eliminars({{$user->id}})">Eliminar</x-jet-button>
                                <x-jet-button wire:click="eliminar({{$user->id}})">Crear</x-jet-button>
                                <x-jet-button wire:click="eliminar({{$user->id}})">Actualizar</x-jet-button>

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
