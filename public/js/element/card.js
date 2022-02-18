$(document).ready(function () {
    // Open form to create a new card
    $('#newCard').on('click', function (e) {
        e.preventDefault();
        createNewCard();
    });

    // Datepicker
    $('.form-date-card').datepicker({
        format: 'dd M yyyy',
        autoclose: true
    });

    // Dynamic width
    $(document).on('change', '.form-date-card', function () {
        const selectedDate = new Date($(this).val());
        $('#dateText').html($(this).val());

        if ($(this).val() == '') {
            $('#dateText').html('Input Date');
        }
        if (isToday(selectedDate)) {
            $('#dateText').html('Today');
        }
        if (isYesterday(selectedDate)) {
            $('#dateText').html('Yesterday');
        }

        let width;
        if ($(this).val().length > 0) {
            width = (($(this).val().length + 1) * 8) + 'px';
        } else {
            width = (($(this).attr('placeholder').length + 1) * 8) + 'px';
        }
        $(this).attr('style', 'width:'+width);
    });

    // Delete card
    $(document).on('click', '.delete-card', function (e) {
        e.preventDefault();
        $(this).parents('.card').remove();
    });

    $('.form-date-card').trigger('change');

    // Task completion and progress
    $('.card').each(function () { 
        // New task button not counted
        updateProgressCompletion($(this));
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
    $('#hidden-drag-ghost-list').prepend(`
    <div class="card ui-state-default ui-sortable-handle">
        <div class="card-title">
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-search">
                    <input type="text" class="mb-0 form-card" value="New Card" placeholder="Card Name">
                </div>
                <i class="fa fa-angle-down expand-task" id="" data-value="expand"></i>
            </div>
            <span class="text-muted">
                <div class="form-search">
                    <input type="text" class="form-date-card" placeholder="Input Date" style="z-index: 5;"><span id="dateText"></span>, <span class="total-complete-task">0</span> of <span class="total-task">0</span> completed
                </div>
            </span>
            <div class="progress gradient-blue" style="--progress-after: 0%;"></div>
        </div>
        <div class="card-body px-0 pt-0 pb-2" style="display: none;">
            <div class="task d-flex align-items-center mt-2 new-task-container justify-content-between">
                <a href="" class="new-task">
                    <i class="fa fa-plus text-muted"></i>
                    <span class="ms-1" style="font-weight: bold; font-size: 16px;">New Task</span>
                </a>
                <a href="" class="delete-card btn btn-danger" title="Delete Card">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
        </div>
    </div>  
    `);
    // Datepicker
    $('.form-date-card').datepicker({
        format: 'dd M yyyy',
        autoclose: true
    });
    $('.form-date-card').trigger('change');
    $('.new').slideDown();
    let item = $('.item.active').find('.count');
    let itemCount = parseInt(item.html());
    itemCount++;
    item.html(itemCount);
}