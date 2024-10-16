<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Paciente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('services.update', $model) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $model->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="birthdate" value="Fecha de Nacimiento" />
                            <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" :value="old('birthdate', $model->birthdate)" required autofocus autocomplete="birthdate" />
                            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
                        </div>

                        <div>
                            <x-input-label for="phone" value="Teléfono" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $model->phone)" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_name" value="Nombre de contacto de emergencia" />
                            <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full" :value="old('emergency_contact_name', $model->emergency_contact_name)" required autofocus autocomplete="emergency_contact_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_name')" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_phone_number" value="Teléfono del contacto de emergencia" />
                            <x-text-input id="emergency_contact_phone_number" name="emergency_contact_phone_number" type="text" class="mt-1 block w-full" :value="old('emergency_contact_phone_number', $model->emergency_contact_phone_number)" required autofocus autocomplete="emergency_contact_phone_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_phone_number')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Guardar</x-primary-button>
                            @if (session('status') === 'model-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >Guardado</p>
                        @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
