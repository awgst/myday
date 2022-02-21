@foreach ($items ?? [] as $item)
    <x-item isActive="{{ $loop->first }}" name="{{ $item->name }}" id="{{ $item->id ?? 0 }}" />
@endforeach