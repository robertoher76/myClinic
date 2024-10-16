<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Roles
        </h2>
    </x-slot>

    <div class="mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <span class="text-sm font-medium leading-5 text-gray-900 dark:text-gray-100">
                <a href="{{ route('dashboard') }}" class="underline">Home</a>
                &nbsp;/&nbsp;
                <a href="{{ route('roles.index') }}" class="underline">Roles</a>
                &nbsp;/&nbsp;
                {{ $model->id }}
            </span>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('roles.update', $model) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="code" value="Código" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code', $model->code)" required autofocus autocomplete="code" />
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $model->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Guardar</x-primary-button>
                            @if (session('status') === 'role-updated')
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

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Permisos
                    </h2>

                    {{-- @foreach($permissions as $permission)
                        @if ($loop->first)
                            @php $currentTable = $permission->table @endphp
                            <p class="question text-gray-900 font-semibold capitalize">
                                {{ trans_choice('models.' . $currentTable, 10) }}:
                            </p>
                        @endif

                        @if($currentTable != $permission->table)
                            @php $currentTable = $permission->table @endphp
                            <p class="question text-gray-900 font-semibold capitalize">
                                {{ trans_choice('models.' . $currentTable, 10) }}:
                            </p>
                        @endif

                        <div class="columns small-24 medium-12">
                            <label>
                                <input type="checkbox">{{ $permission->name }}
                            </label>
                        </div>
                    @endforeach --}}

                    <livewire:admin.roles.permissions :role="$model">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
