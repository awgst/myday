$(document).ready(function () {
    // Edit or delete task
    editOrDelete('task');

    // Expand task on card
    $(document).on('click', '.expand-task', function () {
        let cardBody = $(this).parents('.card').find('.card-body');
        if ($(this).attr('data-value') == 'expand') {
            cardBody.slideDown();
            $(this).attr('data-value', 'collapse');
            $(this).removeClass('fa-angle-down');
            $(this).addClass('fa-angle-up');
        } else {
            cardBody.slideUp();
            $(this).attr('data-value', 'expand');
            $(this).removeClass('fa-angle-up');
            $(this).addClass('fa-angle-down');
        }
    });

    // Create new task
    $(document).on('click', '.new-task', function (e) {
        e.preventDefault();
        createNewTask($(this));
    });

    // Check a task
    $(document).on('change', '.checklist', function () {
        updateProgressCompletion($(this).parents('.card'));
    });
});

function createNewTask(param) {
    const newTask = `<div class="task d-flex align-items-center mt-2 justify-content-between">
        <div class="d-flex align-items-center">
            <div class="pretty p-icon p-round p-rotate mr-0">
                <input type="checkbox" class="checklist" />
                <div class="state p-primary">
                    <i class="icon fa fa-check"></i>
                    <label>&nbsp;</label>
                </div>
            </div>
            <div class="form-search">
                <input type="text" class="mb-0 form-task" style="line-height: 10px; border-bottom: none;" value="New Task">
                <textarea type="text" class="text-muted form-search form-task" style="font-size: 12px;">Task description</textarea>
            </div>
        </div>
        <div class="">
            <a href="#" title="Save" class="text-success save-task" style="display: none;">
                <i class="fa fa-save"></i>
            </a>
            <a href="#" onclick="deleteTask(this)" title="Delete" class="text-danger delete-task">
                <i class="fa fa-close"></i>
            </a>
        </div>
    </div>`;
    $(newTask).insertBefore($('.new-task').parent());
    updateProgressCompletion(param.parents('.card'));
}

function updateTask(param) {
}

function deleteTask(param) {
    const parent = $(param).parents('.card');
    $(param).parents('.task').remove();
    updateProgressCompletion(parent);
}