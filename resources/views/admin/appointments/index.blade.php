<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ trans_choice('models.' . $model->routes()->formatStringName(), 10) }}
        </h2>
    </x-slot>

    <livewire:admin.concerns.calendar>

    <livewire:admin.appointments.form>

</x-app-layout>
