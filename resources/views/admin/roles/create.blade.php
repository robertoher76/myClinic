<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuevo Rol
        </h2>
    </x-slot>

    <div class="mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <span>
                <a href="{{ route('dashboard') }}" class="underline">Home</a>
                &nbsp;/&nbsp;
                <a href="{{ route('roles.index') }}" class="underline">Roles</a>
                &nbsp;/&nbsp;
                Nuevo Rol
            </span>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('roles.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="code" value="Código" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code')" required autofocus autocomplete="code" />
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Guardar</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
