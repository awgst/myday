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
        updateTask($(this));
        updateProgressCompletion($(this).parents('.card'));
    });
});

function createNewTask(param) {
    $.ajax({
        type: "POST",
        url: storeTaskRoute,
        data: {card_id:param.attr('data-id')},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            const newTask = response;
            $(newTask).insertBefore($('.new-task').parent());
            updateProgressCompletion(param.parents('.card'));  
        },
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }
    });
}

function updateTask(param) {
    let data = param.serialize();
    let icon = param.parents('.task').find('.save-task').find('i');
    if (!data && param.attr('type', 'checkbox')) {
        data = {checked: false};
    }
    onLoading(icon, 'fa-save');
    $.ajax({
        type: "PUT",
        url: param.parents('.task').find('.save-task').attr('href'),
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
        },
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }, 
        complete: function () { 
            afterLoading(icon, 'fa-save');
        }
    });
}

function deleteTask(param) {
    const parent = $(param).parents('.card');
    $(param).parents('.task').remove();
    updateProgressCompletion(parent);
}