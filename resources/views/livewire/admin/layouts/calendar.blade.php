<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="px-2 py-1 flex w-full mb-4">

                    <div class="w-4/6 font-bold">
                        {{ $date->format('F Y') }}
                    </div>

                    <div wire:click="previousMonth()" class="w-1/6 text-right hover:text-gray-900 cursor-pointer" >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-right">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>

                    <div wire:click="nextMonth()" class="w-1/6 text-right hover:text-gray-900 cursor-pointer" >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 float-right">
                        <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="flex flex-wrap text-sm transition" wire:loading.class="opacity-20">

                    <div class="flex w-full">
                        <div class="calendar-header-box">Domingo</div>
                        <div class="calendar-header-box">Lunes</div>
                        <div class="calendar-header-box">Martes</div>
                        <div class="calendar-header-box">Miércoles</div>
                        <div class="calendar-header-box">Jueves</div>
                        <div class="calendar-header-box">Viernes</div>
                        <div class="calendar-header-box">Sábado</div>
                    </div>

                    @foreach ($calendar as $day)
                        <div
                            class="calendar-day
                            {{ $day['is_current_month'] ? 'calendar-current-month' : 'calendar-not-current-month' }}">

                            <div class="day-options flex items-center">
                                <span class="inline-block mr-2">{{ $day['day'] }}</span>
                                @if($day['available'])
                                    <button wire:click="newAppointmentByDate({{ $day['timestamp'] }})" type="button" class="btn-add-appointment fill-green-700 hover:fill-green-800">
                                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z" fill-rule="nonzero"/></svg>
                                    </button>
                                @endif
                            </div>

                            @foreach($day['appointments'] as $appointment)
                                <div class="calendar-appointment-box">
                                    <p>{{ $appointment['patient'] }} {{ $appointment['time'] }}</p>
                                    <button wire:click="editAppointment({{ $appointment['id'] }})">
                                        <svg width="18" height="18" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m4.481 15.659c-1.334 3.916-1.48 4.232-1.48 4.587 0 .528.46.749.749.749.352 0 .668-.137 4.574-1.492zm1.06-1.061 3.846 3.846 11.321-11.311c.195-.195.293-.45.293-.707 0-.255-.098-.51-.293-.706-.692-.691-1.742-1.74-2.435-2.432-.195-.195-.451-.293-.707-.293-.254 0-.51.098-.706.293z" fill-rule="nonzero"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
