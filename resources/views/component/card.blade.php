<div class="card ui-state-default ui-sortable-handle">
    <div class="card-title">
        <div class="d-flex justify-content-between align-items-center">
            <div class="form-search">
                <input data-url="{{ route('card.update', $id) }}" name="name" type="text" class="mb-0 form-card" value="{{ $name ?? '' }}" placeholder="Card Name">
            </div>
            <i class="fa fa-angle-down expand-task" id="" data-value="expand"></i>
        </div>
        <span class="text-muted">
            <div class="form-search">
                <input type="text" data-url="{{ route('card.update', $id) }}" name="date" class="form-date-card date-card" placeholder="Input Date" style="z-index: 5;" value="{{ $date ?? '' }}"><span id="dateText">{{ $date ?? '' }}</span>, <span class="total-complete-task">{{ $totalCompletion ?? 0 }}</span> of <span class="total-task">{{ $total ?? 0 }}</span> completed
            </div>
        </span>
        <div class="progress gradient-blue"></div>
    </div>
    <div class="card-body px-0 pt-0 pb-2" style="display: none;">
        @if ($tasks)
            @foreach ($tasks as $task)
                <x-task :checked="$task->checked" :name="$task->name" :description="$task->description" />
            @endforeach
        @endif
        {{-- New Task --}}
        <div class="task d-flex align-items-center mt-2 new-task-container justify-content-between">
            <a href="" class="new-task">
                <i class="fa fa-plus text-muted"></i>
                <span class="ms-1" style="font-weight: bold; font-size: 16px;">New Task</span>
            </a>
            <a href="{{ route('card.destroy', $id) }}" class="delete-card btn btn-danger" title="Delete Card">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div> 