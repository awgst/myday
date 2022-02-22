@foreach ($cards as $card)
    <x-card name="{{ $card->name }}" date="{{ convert_date($card->date) }}" />
@endforeach