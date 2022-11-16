<div class="text-end">
    <div class="btn-group" role="group" aria-label="Action Buttons">
        @if ($edit && Auth::user()->can($permission_group . '-edit'))
            <a href="{{ route('admin.' . $model . '.edit', $key->$field) }}" class="btn btn-primary btn-circle btn-sm">
                {!! getIcon('fas', 'edit') !!}
            </a>
        @endif
        @if ($delete && Auth::user()->can($permission_group . '-delete'))
            <a href="{{ route('admin.' . $model . '.delete', $key->$field) }}" class="btn btn-warning btn-circle btn-sm">
                {!! getIcon('fas', 'trash') !!}
            </a>
        @endif
        @if ($restore && $key->trashed() && Auth::user()->can($permission_group . '-restore'))
            <a href="{{ route('admin.' . $model . '.restore', $key->$field) }}" class="btn btn-undo btn-circle btn-sm">
                {!! getIcon('fas', 'undo') !!}
            </a>
        @endif
        @if ($destroy && $key->trashed() && Auth::user()->can($permission_group . '-destroy'))
            <a href="{{ route($model . '.destroy', $key->$field) }}" class="btn btn-danger btn-circle btn-sm">
                {!! getIcon('fas', 'times') !!}
            </a>
        @endif
    </div>
</div>
