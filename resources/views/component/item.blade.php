<div class="item {{ $isActive ? 'active extra-light-blue' : '' }}">
    <div class="form-search">
        <input type="text" class="mb-0 form-item {{ $isActive ? 'active extra-light-blue' : '' }}" style="line-height: 10px; border-bottom: none;" value="{{ $name ?? '' }}">
    </div>
    <p class="mb-0 count">{{ $count ?? '0' }}</p>
    <a id="editItem" class="save-item" title="Edit" style="display: none;">
        <i class="fa fa-save text-success"></i>
    </a>
    <div class="deletion-item d-none">
        <a onclick="deleteItem(this)" id="deleteItem" title="Delete" style="cursor: pointer;">
            <i class="fa fa-trash text-danger"></i>
        </a>
    </div>
</div>