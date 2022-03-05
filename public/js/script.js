var newItem;
$(document).ready(function () {
    // Search
    let searchValue = $('#search').val();

    // Resize sidebar and cardlist height
    $(window).on('resize', function(){
        let height = getSidebarNavHeight();
        let cardContainerHeight = getCardsListHeight();
        $('.sidebar-nav').attr('style', "height: "+height);
        $('#hidden-drag-ghost-list').attr('style', "height: "+cardContainerHeight);
    });

    $(window).trigger('resize');
    
    $(document).on('keyup', 'input,textarea', function (e) {
        e.preventDefault();
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
            $(this).blur();
        }
    });

    $(document).on('click', 'a', function (e) {
        e.preventDefault();
    });

    $('#search, .search').on('click', function (e) {
        $('#modalSearch').modal('show');
        $('#formSearch').focus();
    });

    $('button.close').on('click', function () {
        $('#modalSearch').modal('hide');
    });

    $( "#formSearch" ).catcomplete({
        source: searchRoute,
        appendTo: '.modal-body',
        select: function(event, ui) {
            $(`.item[data-id="${ui.item.id}"]`).trigger('click').after(function () {
                $('#modalSearch').modal('hide');
            });
        }
    });

});

function editOrDelete(param) {
    $(document).on('focus', `.form-${param}`, function () {
        switch (param) {
            case 'item':
                $(this).parents(`.${param}`).find(`.count`).attr('style', 'display: none;');
                $(this).parents(`.${param}`).find(`#deleteItem`).attr('style', '');
                break;
            case 'task':
                $(this).parents(`.${param}`).find(`.delete-${param}`).attr('style', 'display: none;');
                break
            default:
                break;
        }
        $(this).parents(`.${param}`).find(`.save-${param}`).fadeIn();
    });

    $(document).on('blur', `.form-${param}`, function () {
        switch (param) {
            case 'task':
                $(this).parents(`.${param}`).find(`.save-${param}`).attr('style', 'display: none;');
                $(this).parents(`.${param}`).find(`.delete-${param}`).fadeIn();
                updateTask($(this));
                break;
            default:
                break;
        }
    });
}

// Dynamic height of sidebar nav
function getSidebarNavHeight() { 
    let dashboardHeight = $('.glasses').height();
    dashboardHeight = dashboardHeight-(dashboardHeight % 10);
    dashboardHeight = dashboardHeight - 70;
    dashboardHeight = dashboardHeight+"px;";
    if ($(window).width() <= 992) {
        dashboardHeight = 110+"px;";
        if ($('.item').length < 3) {
            dashboardHeight = 'auto;';
        }
    }
    return dashboardHeight;
}

// Dynamic height of card list
function getCardsListHeight()
{
    let cardListHeight = $('.glass').height();
    let fitToHeight = 120;
    if ($(window).width() <= 992) {
        fitToHeight = 285;
    }
    cardListHeight = cardListHeight-(cardListHeight % 10);
    cardListHeight = cardListHeight - fitToHeight;
    cardListHeight = cardListHeight+"px;";
    return cardListHeight;
}

// Update progress completion card
function updateProgressCompletion(param) {
    const totalTask = param.find('.task').length - 1;
    const totalCompleteTask = param.find(`[type="checkbox"]`).filter(':checked').length;
    const progress = (totalCompleteTask/totalTask)*100;
    param.find('.total-complete-task').html(totalCompleteTask);
    param.find('.total-task').html(totalTask);
    param.find('.progress').attr('style', `--progress-after: ${progress}%;`);
}

function onLoading(selector, className)
{
    selector.removeClass(className);
    selector.addClass('fa-spinner fa-pulse disabled');
}

function afterLoading(selector, className)
{
    selector.addClass(className);
    selector.removeClass('fa-spinner fa-pulse disabled');
}