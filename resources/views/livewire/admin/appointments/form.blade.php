<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="px-2 py-1 flex w-full mb-4">
                    <div class="w-4/6 font-bold">
                        {{ $edit ? 'Editar Cita' : 'Crear Cita' }}

                        <div class="text-gray-900 dark:text-gray-100">
                            <form wire:submit="save" class="mt-6 space-y-6">

                                <x-text-input id="id" wire:model="id" type="hidden"/>

                                <div>
                                    <x-input-label for="patient_id" :value="__('patient_id')" />

                                    <select id="patient_id" wire:model="patient_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                        <option value="{{ null }}">-- Select Patient --</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>

                                    <x-input-error class="mt-2" :messages="$errors->get('patient_id')" />
                                </div>

                                <div>
                                    <x-input-label for="scheduled_at" :value="__('scheduled_at')" />
                                    <x-text-input id="scheduled_at" wire:model="scheduled_at" type="datetime-local" class="mt-1 block w-full" required autocomplete="scheduled_at" />
                                    <x-input-error class="mt-2" :messages="$errors->get('scheduled_at')" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ $edit ? 'Modificar' : 'Guardar' }}</x-primary-button>
                                    <x-primary-button type="button" wire:click="cancel()">Cancelar</x-primary-button>
                                    @if ($saved)
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600 dark:text-gray-400"
                                        >{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
