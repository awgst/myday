@foreach ($items ?? [] as $item)
    <x-item isActive="{{ $loop->first }}" name="{{ $item->name }}" />
@endforeach