@foreach ($items ?? [] as $item)
    <x-item :isActive="$loop->first" :name="$item->name" id="{{ $item->id ?? 0 }}" :count="$item->cards_count" />
@endforeach