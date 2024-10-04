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

                    <form method="post" action="{{ route('patients.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="birthdate" :value="__('birthdate')" />
                            <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" :value="old('birthdate')" required autofocus autocomplete="birthdate" />
                            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_name" :value="__('emergency_contact_name')" />
                            <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full" :value="old('emergency_contact_name')" required autofocus autocomplete="emergency_contact_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_name')" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_phone_number" :value="__('emergency_contact_phone_number')" />
                            <x-text-input id="emergency_contact_phone_number" name="emergency_contact_phone_number" type="text" class="mt-1 block w-full" :value="old('emergency_contact_phone_number')" required autofocus autocomplete="emergency_contact_phone_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_phone_number')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
