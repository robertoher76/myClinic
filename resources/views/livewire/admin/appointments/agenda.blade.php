<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="px-2 py-1 flex w-full mb-4">
                    <div class="flex w-full flex-nowrap">
                        <div class="agenda-header flex flex-col text-center w-min pr-4">
                            <span class="agenda-month">{{ $day->monthName }}</span>
                            <span class="agenda-day">{{ $day->format('d') }}</span>
                            <span class="agenda-month">{{ $day->dayName }}</span>
                            <div class="flex justify-between mt-2">
                                <div wire:click="previousDay()" class="w-1/6 text-left hover:text-gray-900 cursor-pointer" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-right">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                </div>

                                <div wire:click="nextDay()" class="w-1/6 text-right hover:text-gray-900 cursor-pointer" >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 float-right">
                                    <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="agenda-grid-hours">
                            @foreach ($agenda as $hour)
                                <div class="agendar-hour mb-2">
                                    <p class="agenda-grid-hour">{{ $hour['12HourFormat'] }}</p>
                                    <div class="agenda-grid-minutes">
                                        @foreach($hour['appointments'] as $appointment)
                                            <div class="agenda-grid-minute">
                                                <div class="agenda-grid-minute-header
                                                @if($appointment['status'] == 1)
                                                    appointment-scheduled
                                                @elseif($appointment['status'] == 2)
                                                    appointment-finalized
                                                @elseif($appointment['status'] == 3)
                                                    appointment-canceled
                                                @else
                                                    appointment-rescheduled
                                                @endif
                                                pl-4 pr-4 py-2 flex flex-nowrap justify-between">
                                                    <p>{{ $appointment['patient'] }} {{ $appointment['start_time'] }} - {{ $appointment['end_time'] }}</p>
                                                    <span>{{ $appointment['status_label'] }}</span>
                                                </div>
                                                <div class="agenda-grid-minute-body pl-4 pr-3 pt-2 pb-4">
                                                    <div class="flex justify-between flex-nowrap">
                                                        <div class="">
                                                            <p class="font-medium">Doctor: {{ $appointment['doctor'] }}</p>
                                                            <p class="font-medium">Servicios: {{ $appointment['services'] }}</p>
                                                        </div>
                                                        <div class="shrink text-right relative" x-data="{ options: false }">
                                                            <button type="button" x-on:click="options = !options;">
                                                                <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 18c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0-9c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0-9c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3z"/></svg>
                                                            </button>
                                                            <ul
                                                            class="border border-gray-200 rounded-md text-sm absolute right-2"
                                                            x-show="options"
                                                            x-on:click.outside="options = false"
                                                            x-cloak>
                                                                <li>
                                                                    <button
                                                                    wire:click="finishAppointment({{ $appointment['id'] }})"
                                                                    class="bg-white hover:bg-gray-200 border border-gray-200 py-1 px-2 block w-full" type="button">Finalizar</button>
                                                                </li>
                                                                <li>
                                                                    <button
                                                                    wire:click="cancelAppointment({{ $appointment['id'] }})"
                                                                    class="bg-white hover:bg-gray-200 border border-gray-200 py-1 px-2 block w-full" type="button">Cancelar</button>
                                                                </li>
                                                                <li>
                                                                    <button
                                                                    wire:click="rescheduleAppointment({{ $appointment['id'] }})"
                                                                    class="bg-white hover:bg-gray-200 border border-gray-200 py-1 px-2 block w-full" type="button">Reprogramar</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
