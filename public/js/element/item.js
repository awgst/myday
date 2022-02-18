$(document).ready(function () {
    // Edit or delete item
    editOrDelete('item');
    $('.form-item').prop('disabled', true);
    $('.item').find('.form-search').on({
        dblclick: function() {
            $(this).find('.form-item').prop('disabled', false);
            $(this).find('.form-item').focus();
        }
    });
    $('.form-item').on('blur', function () {
        $(this).prop('disabled', true);
    });
});

function createItem(param) {
    let items = $(param).parents('.form-new-item');
    let input = items.find('input');
    let newItem = `<div class="item" style="display: none;">
        <div class="form-search">
            <input type="text" class="mb-0 form-item" style="line-height: 10px; border-bottom: none;" value="${input.val()}">
        </div>
        <p class="mb-0 count d-none">0</p>
        <a id="editItem" class="save-item" title="Edit" style="display: none;">
            <i class="fa fa-save text-success"></i>
        </a>
        <div class="deletion-item">
            <a onclick="deleteItem(this)" id="deleteItem" title="Delete" style="cursor: pointer;">
                <i class="fa fa-trash text-danger"></i>
            </a>
        </div>
    </div>`;
    $(newItem).insertBefore($('.new-item'));
    $('.item').fadeIn();
    input.val('');
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
    $('.deletion-item').addClass('d-none');
    $('.count').removeClass('d-none');
}

// Open form to create new item
function createNewItem(e)
{
    $(e).attr('style', 'display:none;');
    $(e).parent().append(`
        <div class="form-new-item form-search" style="display:none;">
            <form action="" class="d-flex justify-content-between align-items-center">
                <input type="text" placeholder="New List" class="text-muted glass-input" style="line-height:1.75rem;" title="Press enter to create new item">
                <div class="d-flex">
                    <a onclick="cancelNewItem(this)" id="cancelNewItem" class="btn btn-danger" style="padding: 0.1rem 0.15rem;line-height: 0;margin-left: 0.35rem;font-size: 12px;cursor:pointer;" title="Cancel">
                        <i class="fa fa-close" style="color: white;"></i>
                    </a>
                    <a onclick="createItem(this)" class="btn btn-success" style="padding: 0.12rem 0.12rem;
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
    $('.count').addClass('d-none');
    $('.deletion-item').removeClass('d-none');
}