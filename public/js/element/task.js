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
    $.ajax({
        type: "POST",
        url: storeTaskRoute,
        data: {card_id:param.attr('data-id')},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            const newTask = response;
            console.log(newTask);
            $(newTask).insertBefore($('.new-task').parent());
            updateProgressCompletion(param.parents('.card'));  
        },
        error : function (response) {
            toastr["error"](response.responseJSON.message, "ERROR")
        }
    });
}

function updateTask(param) {
}

function deleteTask(param) {
    const parent = $(param).parents('.card');
    $(param).parents('.task').remove();
    updateProgressCompletion(parent);
}