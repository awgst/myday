$(document).ready(function () {
    var page = 1;
    // Edit or delete item
    editOrDelete('item');
    // Load Item
    loadItem();

    // Double click to edit
    $(document).on('dblclick', '.item .form-search', function () {
        if ($('#formNewItem').length === 0) {
            $(this).find('.form-item').prop('disabled', false);
            $(this).find('.form-item').focus();
        }
    });

    $(document).on('click', '#editItem', function () {
        updateItem($(this).parent().find('.form-item'));
    });

    $(document).on('click', '.item', function () {
        if (!($(this).hasClass('new-item') || $(this).hasClass('active'))) {
            loadContent($(this));
        }
    });

    $(document).on('submit', '#formNewItem', function (e) {
        e.preventDefault();
        createItem($(this));
    });

});

function loadContent(param)
{
    if (param) {
        $.ajax({
            type: "GET",
            url: param.attr('data-url'),
            success: function (response) {
                $('#contentContainer').removeAttr('style');
                $('#contentContainer').html(response);
                $('.item.active.extra-light-blue').removeClass('active extra-light-blue');
                $('.form-item.active.extra-light-blue').removeClass('active extra-light-blue');
                param.addClass('active extra-light-blue');
                param.find('.form-item').addClass('active extra-light-blue');
                $('.form-date-card').trigger('change', true);
                $('.form-date-card').datepicker({
                    format: 'dd M yyyy',
                    autoclose: true
                });
                // Task completion and progress
                $('.card').each(function () { 
                    // New task button not counted
                    updateProgressCompletion($(this));
                });

                $(window).trigger('resize');

                // Sortable
                $(function() {
                    $("#hidden-drag-ghost-list").sortable();
                    $(".items").sortable();
                });
            }, 
            error : function (response) {
                toastr["error"](response.responseJSON.message, "ERROR")
            }
        });
    } else {
        $('#contentContainer').html('');
    }
}

function createItem(param) {
    let items = $(param).parents('.form-new-item');
    let input = items.find('input');
    let saveIcon = $('#saveNewItem').find('i');
    onLoading(saveIcon, 'fa-check');
    $('#saveNewItem').addClass('disabled');
    $.ajax({
        type: "POST",
        url: storeItemRoute,
        data: {name: input.val()},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
            $(response).insertBefore($('.new-item'));
            $('.item').fadeIn();
            input.val('');
            onCreating();
        }, 
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        },
        complete: function () {
            afterLoading(saveIcon, 'fa-check');
            $('#saveNewItem').removeClass('disabled');
        }
    });
}

function loadItem(page) {
    $.ajax({
        type: "GET",
        url: listItemRoute+'?page='+page,
        success: function (response) {
            $('.item-loading').remove();
            $('.items').prepend(response);
            loadContent($('.item.active'));
        }, 
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }
    });
}

function updateItem(param) {
    let input = param;
    let editItem = param.parents('.item').find('#editItem');
    onLoading(editItem, 'fa-save');
    $.ajax({
        type: "PUT",
        url: param.attr('data-url'),
        data: {name: param.val()},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            input.val(response.item.name);
            loadContent(param.parents('.item'));
        },
        error: function (response) {
            input.val('');
            toastr["error"](response.responseJSON.message, "ERROR")
        },
        complete: function () { 
            input.blur();
            input.prop('disabled', true);
            editItem.attr('style', 'display:none;');
            param.parents('.item').find(`.count`).fadeIn();
            param.parents('.item').find(`#deleteItem`).fadeIn();
            afterLoading(editItem, 'fa-save');
        }
    });
}

function deleteItem(param) {
    let icon = $(param).find('i');
    onLoading(icon, 'fa-trash');
    $.ajax({
        type: "DELETE",
        url: $(param).attr('data-url'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $(param).parents('.item').remove();
            loadContent(null);
        }, 
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }, 
        complete: function () { 
            afterLoading(icon, 'fa-trash');
        }
    });
}

// Close form to create new item
function cancelNewItem(e)
{
    let parent = $(e).parents('.form-new-item');
    parent.html('');
    parent.append(`<a onclick="createNewItem(this)" class="new light-blue" style="cursor: pointer; display: none;">
        <i class="fa fa-plus light-blue"></i>
        <span class="ms-1" style="font-weight: 300; font-size: 16px;">New List</span>
    </a>`);
    $('a.new').fadeIn();

    // Cancel Creating
    cancelCreating();
}

// Open form to create new item
function createNewItem(e)
{
    $(e).attr('style', 'display:none;');
    $(e).parent().append(`
        <div class="form-new-item form-search" style="display:none;">
            <form action="" class="d-flex justify-content-between align-items-center" id="formNewItem">
                <input autofocus type="text" placeholder="New List" class="text-muted glass-input" style="line-height:1.75rem;" title="Press enter to create new item">
                <div class="d-flex">
                    <a onclick="cancelNewItem(this)" id="cancelNewItem" class="btn btn-danger" style="padding: 0.1rem 0.15rem;line-height: 0;margin-left: 0.35rem;font-size: 12px;cursor:pointer;" title="Cancel">
                        <i class="fa fa-close" style="color: white;"></i>
                    </a>
                    <a id="saveNewItem" onclick="createItem(this)" class="btn btn-success" style="padding: 0.12rem 0.12rem;
                        line-height: 0;
                        margin-left: 0.25rem;
                        font-size: 12px;
                        cursor: pointer;" 
                        title="Save">
                        <i class="fa fa-check" style="color: white;"></i>
                    </a>
                </div>
            </form>
        </div>
    `);
    $(e).remove();
    $('.form-new-item').fadeIn();

    // On creating
    onCreating();
}

function onCreating()
{
    $('.count').addClass('d-none');
    $('.deletion-item').removeClass('d-none');
}

function cancelCreating()
{
    $('.deletion-item').addClass('d-none');
    $('.count').removeClass('d-none');
}