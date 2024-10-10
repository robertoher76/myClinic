<div x-data="{ open: $wire.entangle('show') }">

    <div class="top-0 left-0 bg-[#0c0d12]/60 w-full h-full fixed overflow-y-auto z-9999" x-show="open" x-cloak>
        <div
            x-on:click.self="open = false;"
            x-on:keydown.escape.window="open = false;"
            class="relative w-full min-h-screen flex items-start justify-center p-4 lg:py-20">
            <div
                style="box-shadow: -9px 4px 30px rgba(0, 0, 0, 0.25);"
                class="xl:w-[45vw] md:w-[65vw] sm:w-[80vw] w-[90vw] bg-white rounded-md relative">

                <div class="max-w-full mx-auto">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            <div class="px-2 py-1 w-full mb-4 font-bold">
                                <p>{{ $edit ? 'Editar Cita' : 'Nueva Cita' }}</p>

                                <div class="text-gray-900 dark:text-gray-100">
                                    <form wire:submit="save" class="mt-6 space-y-6">

                                        <x-text-input id="id" wire:model="id" type="hidden"/>

                                        <div>
                                            <x-input-label for="patient_id" :value="__('models.appointment.patient_id')" />

                                            <select id="patient_id" wire:model="patient_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                                                <option value="{{ null }}">-- Elegir Paciente --</option>
                                                @foreach($patients as $patient)
                                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                @endforeach
                                            </select>

                                            <x-input-error class="mt-2" :messages="$errors->get('patient_id')" />
                                        </div>

                                        <div>
                                            <x-input-label for="scheduled_at" :value="__('models.appointment.scheduled_at')" />
                                            <x-text-input id="scheduled_at" wire:model="scheduled_at" type="datetime-local" class="mt-1 block w-full" required autocomplete="scheduled_at" />
                                            <x-input-error class="mt-2" :messages="$errors->get('scheduled_at')" />
                                        </div>

                                        <div class="block mb-4">
                                            <x-input-label for="service_id" :value="__('models.appointment.service_id')" />

                                            <div class="flex mb-6 mt-1">
                                                <select id="service_id" wire:model="service_id" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                                    <option value="{{ null }}">-- Elegir Servicio --</option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button title="Agregar Servicio" type="button" wire:click="addServiceToAppointment" class="bg-green-600 fill-white rounded-md px-2 ml-2 w-max block">
                                                    <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11 11h-7.25c-.414 0-.75.336-.75.75s.336.75.75.75h7.25v7.25c0 .414.336.75.75.75s.75-.336.75-.75v-7.25h7.25c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-7.25v-7.25c0-.414-.336-.75-.75-.75s-.75.336-.75.75z" stroke="white" fill-rule="nonzero"/></svg>
                                                </button>
                                            </div>

                                            <x-input-error class="mt-2" :messages="$errors->get('service_id')" />

                                            <div class="services">
                                                @foreach ($appointment_services as $service)
                                                    <div class="grid grid-cols-10 gap-4 mb-2">
                                                        <span class="col-span-7 px-2 py-1">{{ $service['name'] }}</span>
                                                        <span class="col-span-2 px-2 py-1">
                                                            {{ $service['estimated_minutes'] }} mins
                                                        </span>
                                                        <button
                                                            type="button"
                                                            class="fill-red-600 hover:fill-red-800 text-center w-min mx-auto rounded"
                                                            wire:click="deleteServiceToAppointment({{ $service['service_id'] }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div>
                                            <x-input-label for="doctor_id" :value="__('models.appointment.doctor_id')" />

                                            <select id="doctor_id" wire:model="doctor_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                                <option value="{{ null }}">-- Elegir Doctor --</option>
                                                @foreach($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>

                                            <x-input-error class="mt-2" :messages="$errors->get('doctor_id')" />
                                        </div>


                                        <div class="flex items-center gap-4">
                                            <x-primary-button class="font-bold bg-green-600 hover:bg-green-800">{{ $edit ? 'Modificar' : 'Guardar' }}</x-primary-button>
                                            <x-primary-button class="font-bold bg-red-600 hover:bg-red-800" type="button" wire:click="cancel()">Cancelar</x-primary-button>
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
    </div>
</div>
