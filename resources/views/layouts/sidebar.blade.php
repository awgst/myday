<div class="sidebar-nav mt-3">
    {{-- Item --}}
    <x-item />
    {{-- New Item --}}
    <div class="item new-item" style="display: block;">
        <a onclick="createNewItem(this)" class="new light-blue" style="cursor: pointer;">
            <i class="fa fa-plus light-blue"></i>
            <span class="ms-1" style="font-weight: 300; font-size: 16px;">New List</span>
        </a>
    </div>
</div>