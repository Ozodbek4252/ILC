@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Update Tariff') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.tariffs.index') }}"
                                    class="btn btn-secondary btn-soft-secondary waves-effect waves-light d-flex
                                align-items-center justify-content-between">
                                    <i class='bx bx-arrow-back'></i>
                                    {{ __('body.Back') }}
                                </a>
                            </div>
                        </div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($langs as $lang)
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab"
                                        href="ui-tabs-accordions.html#navtabs-{{ $lang->code }}" role="tab">
                                        <span class="d-none d-sm-block">
                                            <img src="/{{ $lang->icon }}" style="width: 20px; height: auto;"
                                                alt="user-image" class="me-1">
                                            {{ $lang->name }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <form action="{{ Route('dash.tariffs.update', $tariff->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                @foreach ($langs as $lang)
                                    <div class="tab-pane" id="navtabs-{{ $lang->code }}" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tariff-name">
                                                        {{ __('body.Title') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="name_{{ $lang->code }}"
                                                        value="@if (isset($tariff->translations[$lang->code]) && isset($tariff->translations[$lang->code]['name'])){{ $tariff->translations[$lang->code]['name']['content'] }}@endif"
                                                        type="text" placeholder="{{ __('body.Enter name') }}..."
                                                        class="form-control" id="tariff-name-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="tariff-delivery-time-{{ $lang->code }}">
                                                        {{ __('body.Delivery Time') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="delivery_time_{{ $lang->code }}"
                                                        value="@if (isset($tariff->translations[$lang->code]) && isset($tariff->translations[$lang->code]['delivery_time'])){{ $tariff->translations[$lang->code]['delivery_time']['content'] }}@endif"
                                                        type="text"
                                                        placeholder="{{ __('body.Enter delivery time') }}..."
                                                        class="form-control" id="tariff-delivery-time-{{ $lang->code }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tariff-schedule-{{ $lang->code }}">
                                                        {{ __('body.Schedule') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="schedule_{{ $lang->code }}" type="text"
                                                        value="@if (isset($tariff->translations[$lang->code]) && isset($tariff->translations[$lang->code]['schedule'])){{ $tariff->translations[$lang->code]['schedule']['content'] }}@endif"
                                                        placeholder="{{ __('body.Enter schedule') }}..."
                                                        class="form-control" id="tariff-schedule-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tariff-unit-{{ $lang->code }}">
                                                        {{ __('body.Unit') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="unit_{{ $lang->code }}" type="text"
                                                        value="@if (isset($tariff->translations[$lang->code]) && isset($tariff->translations[$lang->code]['unit'])){{ $tariff->translations[$lang->code]['unit']['content'] }}@endif"
                                                        placeholder="{{ __('body.Enter unit') }}..." class="form-control"
                                                        id="tariff-unit-{{ $lang->code }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tariff-destination-{{ $lang->code }}">
                                                            {{ __('body.Destination') }} <span class="text-danger">*</span>
                                                        </label>
                                                        <input name="destination_{{ $lang->code }}" type="text"
                                                            value="@if (isset($tariff->translations[$lang->code]) && isset($tariff->translations[$lang->code]['destination'])){{ $tariff->translations[$lang->code]['destination']['content'] }}@endif"
                                                            placeholder="{{ __('body.Enter destination') }}..."
                                                            class="form-control" id="tariff-destination-{{ $lang->code }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="icon_id">
                                                @lang('body.Icon') <span class="text-danger">*</span>
                                            </label>

                                            <select name="icon_id" id="icon_id" class="select2 form-select">
                                                <option value="">@lang('body.Select')</option>
                                                @foreach ($icons as $icon)
                                                    <option value="{{ $icon['id'] }}" @selected($tariff->icon_id == $icon['id'])
                                                        data-icon-path="{{ $icon->icon }}">
                                                        {{ $icon['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label" for="tariff-image">
                                                {{ __('body.Icon Preview') }}
                                            </label>
                                            <div>
                                                <img src="" id="icon-preview"
                                                    style="display:none; max-height: 37px; height: 37px; width: auto; object-fit: contain; background-color: #D3D3D3;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="service-price">
                                                {{ __('body.Price') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="price" type="text" value="{{ $tariff->price }}"
                                                placeholder="{{ __('body.Enter price') }}..." class="form-control"
                                                id="service-price">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="service-link">
                                                {{ __('body.Link') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="link" type="text" value="{{ $tariff->link }}"
                                                placeholder="{{ __('body.Enter link') }}..." class="form-control"
                                                id="service-link">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="tariff-update"
                                                class="btn btn-primary waves-effect waves-light form-control">
                                                {{ __('body.Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // add active class to the first nav-link
            $('.nav-link').first().addClass('active');
            $('.tab-pane').first().addClass('active');

            $('.nav-link').click(function() {
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });
            $('.tab-pane').click(function() {
                $('.tab-pane').removeClass('active');
                $(this).addClass('active');
            });
        });

        $(document).ready(function() {
            var selectedIconId = $('#icon_id').val();
            var selectedIconPath = $('#icon_id').find(':selected').data('icon-path');

            $('#icon-preview').attr('src', selectedIconPath);
            $('#icon-preview').css('display', 'block');
        });


        $(document).on('change', 'select[id="icon_id"]', function() {
            // get selected option
            var selectedOption = $(this).find(':selected');
            var selectedIconPath = selectedOption.data('icon-path');

            $('#icon-preview').attr('src', selectedIconPath);
            $('#icon-preview').css('display', 'block');
        });
    </script>
@endsection
