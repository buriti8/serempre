<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center vertical-center">@lang('cities.code')</th>
            <th class="text-center vertical-center">@lang('cities.name')</th>

            @permission(['edit_customers', 'all_customers'])
            <th class="text-center vertical-center">@lang('base_lang.status')</th>
            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
            @endpermission

            @permission(['delete_customers', 'all_customers'])
            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
            @endpermission
        </tr>
    </thead>
    @forelse($cities as $city)
    <tr>
        <td>{{ $city->id ?? '' }}</td>
        <td>{{ $city->name ?? '' }}</td>

        @permission(['edit_customers', 'all_customers'])
        <td class="text-center">
            <form method="POST" action="{{url('/cities/' . $city->id)}}">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="{{$city->status ? 0 : 1}}" />
                <button type="button" class="btn btn-sm btn-primary btn-xs btn-status"
                    title="@lang('base_lang.status')">
                    {{$city->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
        </td>
        <td class="text-center">
            <div class="section_edit">
                <a href="{{url('/cities/' . $city->id . '/edit')}}" class="btn btn-sm  btn-default btn-xs"
                    title="@lang('base_lang.edit')"><i class="fa fa-fw fa-edit icon_color"></i></a>
            </div>
        </td>
        @endpermission

        @permission(['delete_customers', 'all_customers'])
        <td class="text-center">
            <form class="form-horizontal" role="form" method="POST" action="{{url('/cities/' . $city->id)}}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-sm  btn-default btn-xs btn-delete"
                    title="@lang('base_lang.delete') {{$city->name}}">
                    <i class="fa fa-fw fa-times delete"></i>
                </button>
            </form>
        </td>
        @endpermission
    </tr>
    @empty
    <tr>
        <td colspan="10">
            <em>@lang('base_lang.no_records')</em>
        </td>
    </tr>
    @endforelse
</table>