@foreach ($cards as $card)
    <x-card :name="$card->name" date="{{ convert_date($card->date) }}" id="{{ $card->id }}" :tasks="$card->tasks" />
@endforeach