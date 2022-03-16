{{-- Bootstrap --}}
<script src="{{ asset('js/app.js') }}" defer></script>
{{-- Sortable --}}
<script src="{{ asset('js/sortable.min.js') }}"></script>
{{-- jQuery --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-sortable.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
{{-- Datepicker --}}
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
{{-- Toastr --}}
<script src="{{ asset('plugins/toastr/build/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
{{-- UJS --}}
<script src="{{ asset('js/ujs.min.js') }}"></script>
{{-- Custom Scripts --}}
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/element/card.js') }}"></script>
<script src="{{ asset('js/element/item.js') }}"></script>
<script src="{{ asset('js/element/task.js') }}"></script>

{{-- Defined Route --}}
@include('snippets.routes')