$(document).ready(function () {
    // Open form to create a new card
    $(document).on('click', '#newCard', function (e) {
        e.preventDefault();
        createNewCard();
    });

    // Datepicker
    $('.form-date-card').datepicker({
        format: 'dd M yyyy',
        autoclose: true
    });

    // Dynamic width
    $(document).on('change', '.form-date-card', function (event, firstLoad=false) {
        const selectedDate = new Date($(this).val());
        $(this).parent().find('#dateText').html($(this).val());

        if ($(this).val() == '') {
            $(this).parent().find('#dateText').html('Input Date');
        }
        if (isToday(selectedDate)) {
            $(this).parent().find('#dateText').html('Today');
        }
        if (isYesterday(selectedDate)) {
            $(this).parent().find('#dateText').html('Yesterday');
        }

        let width;
        if ($(this).val().length > 0) {
            width = (($(this).val().length + 1) * 8) + 'px';
        } else {
            width = (($(this).attr('placeholder').length + 1) * 8) + 'px';
        }
        $(this).attr('style', 'width:'+width);
        if (firstLoad === false) {
            updateCard($(this));
        }
    });

    // Delete card
    $(document).on('click', '.delete-card', function (e) {
        e.preventDefault();
        deleteCard($(this));
    });

    // Update Card
    $(document).on('blur', '.form-card', function () {
        updateCard($(this));
    });

});
// Check selectedDate isToday
const isToday = (date) => {
    const today = new Date()
    return date.getDate() === today.getDate() &&
        date.getMonth() === today.getMonth() &&
        date.getFullYear() === today.getFullYear();
};
// Check selectedDate isYesterday
const isYesterday = (date) => {
    const yesterday = new Date()
    return date.getDate() === yesterday.getDate()-1 &&
        date.getMonth() === yesterday.getMonth() &&
        date.getFullYear() === yesterday.getFullYear();
};
// Close form to create new card
function cancelCreateCard()
{
    $('#newCardForm').slideUp();
}

// Open form to create new card
function createNewCard()
{
    let beforeLoading = $('#newCard').html();
    let beforeLoadingWidth = $('#newCard').width();
    let onLoading = `<i class="fa fa-pulse fa-spinner"></i>`;
    // OnLoading
    $('#newCard').addClass('disabled');
    $('#newCard').attr('style', 'width:'+beforeLoadingWidth+'px');
    $('#newCard').html(onLoading);
    $.ajax({
        type: "POST",
        url: storeCardRoute,
        data: {item_id:$('#newCard').attr('data-id')},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#hidden-drag-ghost-list').prepend(response);
            // Datepicker
            $('.form-date-card').datepicker({
                format: 'dd M yyyy',
                autoclose: true
            });
            $('.form-date-card').trigger('change', true);
            $('.new').slideDown();
            let item = $('.item.active').find('.count');
            let itemCount = parseInt(item.html());
            itemCount++;
            item.html(itemCount);
        },
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        },
        complete: function () {
            // After loading
            $('#newCard').removeClass('disabled');
            $('#newCard').attr('style', '');
            $('#newCard').html(beforeLoading);
        }
    });
    
}

function updateCard(param)
{
    $.ajax({
        type: "PUT",
        url: param.attr('data-url'),
        data: param.serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (param.hasClass('form-date-card')) {
                param.val(response.card.date);    
            } else {
                param.val(response.card.name);
            }
        },
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }
    });
}

function deleteCard(param)
{
    let icon = $(param).find('i');
    onLoading(icon, 'fa-trash');
    $.ajax({
        type: "DELETE",
        url: param.attr('href'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            param.parents('.card').remove();
            let item = $('.item.active').find('.count');
            let itemCount = parseInt(item.html());
            itemCount--;
            item.html(itemCount);
        },
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }, 
        complete: function () { 
            afterLoading(icon, 'fa-trash');
        }
    });
    
}