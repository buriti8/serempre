<form role="form" method="POST" action="{{ url('/customers' . ($customers->id ? "/{$customers->id}" : '')) }}">
    @csrf
    @if($customers->id)
    @method('put')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>*@lang('customers.name')</label>
                <div class="input-group input-group-sm mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user-alt"></i></div>
                    </div>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        name="name" value="{{ old('name', $customers->name ?? '') }}"
                        placeholder="@lang('customers.name')">
                    @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <label>*@lang('customers.city_id')</label>
                <div class="input-group input-group-sm mb-2">
                    <select name="city_id" id="city_id"
                        class="form-control-sm select2 {{ $errors->has('city_id') ? 'is-invalid' : '' }} w-100">
                        <option value="">@lang('customers.city_id')</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}"
                            {{$city->id==old('city_id',$customers->city_id ?? '') ? 'selected' : ''}}>
                            {{$city->name}}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('city_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('city_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-5">
                <small><strong>(*) </strong>@lang('base_lang.required')</small>
            </div>
            <div class="col-sm-12 col-md-7 text-center text-md-right pt-2">
                <button type="submit" class="btn btn-sm btn-primary">
                    @lang('base_lang.save')
                </button>
                <a href="{{ url('/customers') }}" class="btn btn-sm btn-primary">
                    @lang('base_lang.cancel')
                </a>
            </div>
        </div>
    </div>
</form>