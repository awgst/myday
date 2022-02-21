$(document).ready(function () {
    // Edit or delete item
    editOrDelete('item');
    // Load Item
    loadItem();

    // Double click to edit
    $(document).on('dblclick', '.item .form-search', function () {
        $(this).find('.form-item').prop('disabled', false);
        $(this).find('.form-item').focus();
    });
    $(document).on('blur', '.form-item', function () {
        $(this).prop('disabled', true);
    });

    $(document).on('click', '.item .form-search', function () {
        console.log('1 click');
    });

    $(document).on('submit', '#formNewItem', function (e) {
        e.preventDefault();
        createItem($(this));
    });

});

function createItem(param) {
    let items = $(param).parents('.form-new-item');
    let input = items.find('input');
    let saveIcon = $('#saveNewItem').find('i');
    saveIcon.removeClass('fa-check');
    saveIcon.addClass('fa-spinner fa-pulse');
    $('#saveNewItem').addClass('disabled');
    $.ajax({
        type: "POST",
        url: storeItemRoute,
        data: {name: input.val()},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $(response).insertBefore($('.new-item'));
            $('.item').fadeIn();
            input.val('');
            onCreating();
        },
        complete: function () {
            saveIcon.addClass('fa-check');
            saveIcon.removeClass('fa-spinner fa-pulse');
            $('#saveNewItem').removeClass('disabled');
        }
    });
}

function loadItem() {
    $.ajax({
        type: "GET",
        url: listItemRoute,
        success: function (response) {
            $('.item-loading').remove();
            $('.sidebar-nav').prepend(response);
        }
    });
}

function updateItem(param) {
    console.log('saved item');
    console.log(param.val());
}

function deleteItem(param) {
    console.log('deleted item');
    $(param).parents('.item').remove();
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