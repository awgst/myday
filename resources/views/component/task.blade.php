<div class="task d-flex align-items-center mt-2 justify-content-between">
    <div class="d-flex align-items-center">
        <div class="pretty p-icon p-round p-rotate mr-0">
            <input type="checkbox" class="checklist" {{ ($checked ?? false) ? 'checked' : '' }} />
            <div class="state p-primary">
                <i class="icon fa fa-check"></i>
                <label>&nbsp;</label>
            </div>
        </div>
        <div class="form-search">
            <input type="text" class="mb-0 form-task" style="line-height: 10px; border-bottom: none;" value="{{ $name ?? 'New Task' }}">
            <textarea type="text" class="text-muted form-search form-task" style="font-size: 12px;">{{ $description ?? 'Task description' }}</textarea>
        </div>
    </div>
    <div class="">
        <a href="{{ route('task.update', $id) }}" title="Save" class="text-success save-task" style="display: none;">
            <i class="fa fa-save"></i>
        </a>
        <a href="{{ route('task.destroy', $id) }}" onclick="deleteTask(this)" title="Delete" class="text-danger delete-task">
            <i class="fa fa-close"></i>
        </a>
    </div>
</div>