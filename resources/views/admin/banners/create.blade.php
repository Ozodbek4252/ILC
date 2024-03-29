@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Create Banner') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.banners.index') }}"
                                    class="btn btn-secondary btn-soft-secondary waves-effect
                                        waves-light d-flex
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

                        <form action="{{ Route('dash.banners.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                @foreach ($langs as $lang)
                                    <div class="tab-pane" id="navtabs-{{ $lang->code }}" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="banner-title">
                                                        {{ __('body.Title') }} @if (env('LOCALE', 'uz') == $lang->code)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <input name="title_{{ $lang->code }}" type="text"
                                                        placeholder="{{ __('body.Enter title') }}..." class="form-control"
                                                        id="banner-title-{{ $lang->code }}">
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
                                            <label class="form-label" for="banner-image">
                                                {{ __('body.File') }} <span class="text-danger">*</span>
                                            </label>
                                            <input name="file" type="file" class="form-control" id="banner-image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check form-switch mb-3" dir="ltr">
                                            <label class="form-check-label"
                                                for="isPublishedSwitch">{{ __('body.Published') }}</label>
                                            <input name="is_published" type="checkbox" class="form-check-input"
                                                id="isPublishedSwitch" checked>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="banner-create"
                                                class="btn btn-primary waves-effect waves-light form-control">
                                                {{ __('body.Create') }}
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
    </script>
@endsection
