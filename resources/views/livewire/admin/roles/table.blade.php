<div class="index-table">
    <div class="flex justify-end">
        <input type="text" id="query" wire:model.live="query">
    </div>
    <table class="table-auto mt-8 mb-4">
        <thead>
            <tr>
                @foreach($model->filter()->getFilter() as $field)
                    <th class="text-left">
                        {{ $field->getLabel() }}
                        @if ($field->canSort())
                            <button wire:click="setSort('{{ $field->getField() }}')">
                                <svg width="24" height="24" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m15.344 17.778c0-.414-.336-.75-.75-.75h-5.16c-.414 0-.75.336-.75.75s.336.75.75.75h5.16c.414 0 .75-.336.75-.75zm2.206-4c0-.414-.336-.75-.75-.75h-9.596c-.414 0-.75.336-.75.75s.336.75.75.75h9.596c.414 0 .75-.336.75-.75zm2.45-4c0-.414-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75h14.5c.414 0 .75-.336.75-.75zm2-4c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75z" fill-rule="nonzero"/></svg>
                            </button>
                        @endif
                    </th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    @foreach ($model->filter()->getFilter() as $filter)
                        <td class="py-3">
                            @if ($filter->getType() == 'checkbox')
                                xd
                            @elseif ($filter->getType() == 'relationship')
                                xd
                            @elseif ($filter->getType() == 'enum')
                                xd
                            @else
                                {{ $item->{$filter->getField()} }}
                            @endif
                        </td>
                    @endforeach
                    <td>
                        <div class="flex flex-nowrap">
                            <a class="mr-2 font-medium bg-green-600 text-white px-2 py-1 rounded" href="{{ route($model->routes()->edit(), $item->id) }}">
                                Editar
                            </a>
                            <form action="{{ route($model->routes()->delete(), $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="font-medium bg-red-600 text-white px-2 py-1 rounded" type="submit">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
</div>
