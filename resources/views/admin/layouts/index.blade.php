<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ trans_choice('models.' . $model->routes()->formatStringName(), 10) }}
        </h2>
        <a href="{{ route($model->routes()->create()) }}">
            Nuevo
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <livewire:admin.concerns.table :model="$model">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
