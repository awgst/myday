@foreach ($items ?? [] as $item)
    <x-item isActive="{{ $loop->first ? true : false }}" name="{{ $item->name }}" />
@endforeach