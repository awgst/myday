<script>
    var listItemRoute = {!! json_encode(route('item.index')) !!}
    var storeItemRoute = {!! json_encode(route('item.store')) !!}
    var storeCardRoute = {!! json_encode(route('card.store')) !!}
    var storeTaskRoute = {!! json_encode(route('task.store')) !!}
    var searchRoute = {!! json_encode(route('json.search')) !!}
    var orderingItemRoute = {!! json_encode(route('item.ordering')) !!}
</script>