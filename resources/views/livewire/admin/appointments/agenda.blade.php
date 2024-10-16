<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="px-2 py-1 flex w-full mb-4">
                    <div class="flex w-full flex-nowrap">
                        <div class="agenda-header flex flex-col text-center w-min pr-4">
                            <span class="agenda-month">{{ $day->format('F') }}</span>
                            <span class="agenda-day">{{ $day->format('d') }}</span>
                            <span class="agenda-month">{{ $day->format('l') }}</span>
                        </div>
                        <div class="agenda-grid-hours">
                            @foreach ($agenda as $hour)
                                <div class="agendar-hour mb-2">
                                    <p class="agenda-grid-hour">{{ $hour['12HourFormat'] }}</p>
                                    <div class="agenda-grid-minutes">
                                        @foreach($hour['appointments'] as $appointment)
                                            <div class="agenda-grid-minute">
                                                <p>{{ $appointment['patient'] }} {{ $appointment['time'] }}</p>
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
