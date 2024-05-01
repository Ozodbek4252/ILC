@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Update About') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.abouts.index') }}"
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

                        <form action="{{ Route('dash.abouts.update', $about->id) }}" enctype="multipart/form-data"
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
                                                    <label class="form-label" for="about-title-{{ $lang->code }}">
                                                        {{ __('body.Title') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="title_{{ $lang->code }}"
                                                        value="@if (isset($about->translations[$lang->code]) && isset($about->translations[$lang->code]['title'])){{ $about->translations[$lang->code]['title']['content'] }}@endif"
                                                        type="text" placeholder="{{ __('body.Enter title') }}..."
                                                        class="form-control" id="about-title-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="about-sub-title-{{ $lang->code }}">
                                                        {{ __('body.Sub Title') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="sub_title_{{ $lang->code }}"
                                                        value="@if (isset($about->translations[$lang->code]) && isset($about->translations[$lang->code]['sub_title'])){{ $about->translations[$lang->code]['sub_title']['content'] }}@endif"
                                                        type="text" placeholder="{{ __('body.Enter sub title') }}..."
                                                        class="form-control" id="about-sub-title-{{ $lang->code }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="classic-editor-{{ $lang->code }}">
                                                        {{ __('body.Section 1 Description') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="sec1_description_{{ $lang->code }}" class="form-control" rows="5">@if (isset($about->translations[$lang->code]) && isset($about->translations[$lang->code]['sec1_description'])){{ $about->translations[$lang->code]['sec1_description']['content'] }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="classic-editor-{{ $lang->code }}">
                                                        {{ __('body.Section 2 Description') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="sec2_description_{{ $lang->code }}" class="form-control" rows="5">@if (isset($about->translations[$lang->code]) && isset($about->translations[$lang->code]['sec2_description'])){{ $about->translations[$lang->code]['sec2_description']['content'] }}@endif</textarea>
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
                                            <label class="form-label" for="about-background-image">
                                                {{ __('body.Background Image') }}
                                            </label>
                                            <input name="background_image" type="file" class="form-control"
                                                id="about-background-image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="about-sec1-image">
                                                {{ __('body.Section 1 Image') }}
                                            </label>
                                            <input name="sec1_image" type="file" class="form-control"
                                                id="about-sec1-image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label">
                                                {{ __('body.Image Preview') }}
                                            </label>
                                            <img style="background-color: lightgray; width: 200px; height: auto;"
                                                src="{{ $about->background_image_url }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label">
                                                {{ __('body.Image Preview') }}
                                            </label>
                                            <img style="background-color: lightgray; width: 200px; height: auto;"
                                                src="{{ $about->sec1_image_url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="about-sec2-image">
                                                {{ __('body.Section 2 Image') }}
                                            </label>
                                            <input name="sec2_image" type="file" class="form-control"
                                                id="about-sec2-image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label">
                                                {{ __('body.Image Preview') }}
                                            </label>
                                            <img style="background-color: lightgray; width: 200px; height: auto;"
                                                src="{{ $about->sec2_image_url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="about-update"
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
    </script>
@endsection
