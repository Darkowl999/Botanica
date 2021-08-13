<div>
    {{-- Do your work, then step back. --}}
    <div class="grid grid-cols-3 gap-4">
        @foreach($mesas as $mesa)
            <div class="bg-purple-500">{{$mesa->id}}</div>
        @endforeach

    </div>

</div>
