<div class="content">
    <!-- Header -->
    <div class="header row mx-0">
        <div class="col-8 px-0">
            <h2 class="mb-0" style="color: #444444;">My Day</h2>
            <p class="text-muted">Suday, 13 February 2022</p>
        </div>
        <div class="col-4 px-0">
            <a href="" id="newCard" class="btn btn-primary new-card gradient-blue float-end btn-hover">
                <i class="fa fa-plus"></i>
                <span>New Card</span>
            </a>
        </div>
    </div>
    <!-- Cards List -->
    <div id="hidden-drag-ghost-list" class="ui-sortable mt-3">
       @include('component.card')                 
    </div>
</div>