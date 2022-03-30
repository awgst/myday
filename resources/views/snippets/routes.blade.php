<script>
    var listItemRoute = {!! json_encode(route('item.index')) !!}
    var storeItemRoute = {!! json_encode(route('item.store')) !!}
    var storeCardRoute = {!! json_encode(route('card.store')) !!}
    var storeTaskRoute = {!! json_encode(route('task.store')) !!}
    var searchRoute = {!! json_encode(route('json.search')) !!}
    var orderingItemRoute = {!! json_encode(route('item.ordering')) !!}
    var orderingCardRoute = {!! json_encode(route('card.ordering')) !!}
    var orderingTaskRoute = {!! json_encode(route('task.ordering')) !!}
    var accountSettingRoute = {!! json_encode(route('account.index')) !!}
    var accountUploadRoute = {!! json_encode(route('account.upload')) !!}
</script>