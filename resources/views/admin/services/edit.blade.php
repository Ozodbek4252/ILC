@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Update Service') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.services.index') }}"
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

                        <form action="{{ Route('dash.services.update', $service->id) }}" enctype="multipart/form-data"
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
                                                    <label class="form-label" for="service-name">
                                                        {{ __('body.Name') }} @if (env('LOCALE', 'uz') == $lang->code)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <input name="name_{{ $lang->code }}"
                                                        value="@if (isset($service->translations[$lang->code]) && isset($service->translations[$lang->code]['name'])) {{ $service->translations[$lang->code]['name']['content'] }} @endif"
                                                        type="text" placeholder="{{ __('body.Enter name') }}..."
                                                        class="form-control" id="service-name-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="classic-editor-{{ $lang->code }}">
                                                        {{ __('body.Description') }} @if (env('LOCALE', 'uz') == $lang->code)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <textarea name="description_{{ $lang->code }}" class="form-control" rows="5">
@if (isset($service->translations[$lang->code]) && isset($service->translations[$lang->code]['description']))
{{ $service->translations[$lang->code]['description']['content'] }}
@endif
</textarea>
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
                                                    <option value="{{ $icon['id'] }}" @selected($service->icon_id == $icon['id'])
                                                        data-icon-path="{{ $icon->icon }}">
                                                        {{ $icon['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label" for="service-image">
                                                {{ __('body.Icon Preview') }}
                                            </label>
                                            <div>
                                                <img src="" id="icon-preview"
                                                    style="display:none; max-height: 37px; height: 37px; width: auto; object-fit: contain; background-color: #D3D3D3;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="secondary_icon_id">
                                                @lang('body.Secondary Icon') <span class="text-danger">*</span>
                                            </label>

                                            <select name="secondary_icon_id" id="secondary_icon_id" class="select2 form-select">
                                                <option value="">@lang('body.Select')</option>
                                                @foreach ($icons as $icon)
                                                    <option value="{{ $icon['id'] }}" @selected($service->secondary_icon_id == $icon['id'])
                                                        data-icon-path="{{ $icon->icon }}">
                                                        {{ $icon['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label" for="service-image">
                                                {{ __('body.Secondary Icon Preview') }}
                                            </label>
                                            <div>
                                                <img src="" id="secondary-icon-preview"
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
                                            <label class="form-label" for="service-image">
                                                {{ __('body.Image') }}
                                            </label>
                                            <input name="image" type="file" class="form-control" id="service-image">
                                        </div>
                                    </div>
                                    {{--  <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="service-link">
                                                {{ __('body.Link') }}
                                            </label>
                                            <input name="link" type="text" value="{{ $service->link }}"
                                                placeholder="{{ __('body.Enter link') }}..." class="form-control"
                                                id="service-link">
                                        </div>
                                    </div>  --}}
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label">
                                                {{ __('body.Image Preview') }}
                                            </label>
                                            <img style="background-color: lightgray; width: 200px; height: auto;"
                                                src="{{ $service->image_url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="service-update"
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

        $(document).ready(function() {
            var selectedIconId = $('#secondary_icon_id').val();
            var selectedIconPath = $('#secondary_icon_id').find(':selected').data('icon-path');

            $('#secondary-icon-preview').attr('src', selectedIconPath);
            $('#secondary-icon-preview').css('display', 'block');
        });


        $(document).on('change', 'select[id="icon_id"]', function() {
            // get selected option
            var selectedOption = $(this).find(':selected');
            var selectedIconPath = selectedOption.data('icon-path');

            $('#icon-preview').attr('src', selectedIconPath);
            $('#icon-preview').css('display', 'block');
        });

        $(document).on('change', 'select[id="secondary_icon_id"]', function() {
            // get selected option
            var selectedOption = $(this).find(':selected');
            var selectedIconPath = selectedOption.data('icon-path');

            $('#secondary-icon-preview').attr('src', selectedIconPath);
            $('#secondary-icon-preview').css('display', 'block');
        });
    </script>
@endsection
