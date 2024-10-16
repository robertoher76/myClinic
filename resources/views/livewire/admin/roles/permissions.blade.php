<div class="mt-4">

    @foreach($permissions as $key => $permission)
        <div class="ask ask-2">
            <p class="question text-gray-900 font-semibold capitalize">{{ trans_choice('models.' . $key, 10) }}:</p>
            <div class="row align-justify align-middle multiple">
                @foreach($permission as $value)
                    <div class="columns small-24 medium-12">
                        <label>
                            <input
                                type="checkbox"
                                wire:click="togglePermissions('{{ $key }}', '{{ $value }}')"
                                {{ $this->valueInPermissions($key, $value) }}>
                            {{ __('permissions.' . $value) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
    @endforeach

    <div class="mt-4 flex justify-center">
        <button
            wire:click="save"
            class="bg-green-600 uppercase min-w-[20rem] text-white font-bold text-center py-2 px-6 rounded duration-300 hover:bg-green-700" type="button">
            Guardar
        </button>
    </div>
    @if($saved)
        <p class="text-center text-teal-600">Permisos Guardadós</p>
    @endif

</div>
