<form class="form-inline" action="{{ url('customers') }}" method="get" role="search">
    <input type="hidden" name="per_page" value="{{$customers->perPage()}}" />
    <div class="col-sm-12 col-lg-3">
        <label>@lang('customers.code')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-hashtag"></i></div>
            </div>
            <input type="text" class="form-control" name="q[code]" value="{{$search['code'] ?? ''}}"
                placeholder="@lang('customers.code')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <label>@lang('customers.name')</label>
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-alt"></i></div>
            </div>
            <input type="text" class="form-control" name="q[name]" value="{{$search['name'] ?? ''}}"
                placeholder="@lang('customers.name')" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <label>@lang('customers.city_id')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2" name="q[city_id]">
                <option value="">@lang('customers.city_id')</option>
                @foreach($cities as $city)
                <option value="{{$city->id}}" {{($search['city_id'] ?? '') == $city->id ? 'selected' : ''}}>
                    {{$city->name}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <label>@lang('users.status')</label>
        <div class="input-group input-group-sm mb-2">
            <select class="form-control-sm select2 w-100" name="q[status]">
                <option value="">@lang('users.status')</option>
                <option value="1" {{($search['active'] ?? '') == '1' ? 'selected' : ''}}>@lang('base_lang.active')
                </option>
                <option value="0" {{($search['active'] ?? '') == '0' ? 'selected' : ''}}>@lang('base_lang.inactive')
                </option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 mt-3 text-sm-left text-lg-right">
        <button type="submit" class="btn btn-sm btn-primary mb-2">@lang('base_lang.search')</button>
        <a href="{{url('customers?q[]')}}" class="btn btn-sm btn-primary mb-2">
            @lang('base_lang.clear_search')
        </a>
    </div>
</form>