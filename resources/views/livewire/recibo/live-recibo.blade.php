<div>
    <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
                <table class="w-full">
                    <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Mesa</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <!--inicio foreach-->
                    @foreach($recibos as $r)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$r->updated_at}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{\App\Models\User::find($r->user_id)->name}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <p class="font-semibold text-black">{{$r->mesa_id}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                @php
                                    $tot=0;
                                    foreach($r->pplatos as $key=>$pp){
                                        $tot=$tot+($pp->cantidad*$r->platos[$key]->precio);

                                    }
                                @endphp
                                <p class="font-semibold text-black">{{$tot}}</p>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <x-jet-button wire:click="verPlatos({{$r->id}})">{{'Ver platos'}}</x-jet-button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>
