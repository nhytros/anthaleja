<div class="input-group mb-2">
    <label class="input-group-text">{!! getIcon('fas', 'list') !!}</label>
    <select class="form-select" name="parent_id" id="parent_id">
        <option selected value="0">{{ trans('admin.market.category.main_level') }}</option>
        @if (!empty($parent_categories))
            @foreach ($parent_categories as $pc)
                <option value="{{ $pc->id }}">{{ $pc->name }}</option>
                @if (!empty($pc->subCategories))
                    @foreach ($pc->subCategories as $sub)
                        <option value="{{ $sub->id }}">&nbsp;&nbsp;&bull;&nbsp;&nbsp;{{ $sub->name }}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>
