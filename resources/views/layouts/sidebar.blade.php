<div class="sidebar-nav mt-3">
    <div class="item active extra-light-blue">
        <div class="form-search">
            <input type="text" class="mb-0 form-item active extra-light-blue" style="line-height: 10px; border-bottom: none;" value="Task 1">
        </div>
        <p class="mb-0 extra-light-blue count">3</p>
        <a id="editItem" class="save-item" title="Edit" style="display: none;">
            <i class="fa fa-save text-success"></i>
        </a>
        <div class="deletion-item d-none">
            <a onclick="deleteItem(this)" id="deleteItem" title="Delete" style="cursor: pointer;">
                <i class="fa fa-trash text-danger"></i>
            </a>
        </div>
    </div>
    @include('component.item')
    <div class="item new-item" style="display: block;">
        <a onclick="createNewItem(this)" class="new light-blue" style="cursor: pointer;">
            <i class="fa fa-plus light-blue"></i>
            <span class="ms-1" style="font-weight: 300; font-size: 16px;">New List</span>
        </a>
    </div>
</div>