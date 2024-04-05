@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Update News') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.news.index') }}"
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

                        <form action="{{ Route('dash.news.update', $news->id) }}" enctype="multipart/form-data"
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
                                                    <label class="form-label" for="news-title">
                                                        {{ __('body.Title') }} @if (env('LOCALE', 'uz') == $lang->code)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <input name="title_{{ $lang->code }}"
                                                        value="@if (isset($news->translations[$lang->code]) && isset($news->translations[$lang->code]['title'])) {{ $news->translations[$lang->code]['title']['content'] }} @endif"
                                                        type="text" placeholder="{{ __('body.Enter title') }}..."
                                                        class="form-control" id="news-title-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="text-{{ $lang->code }}">
                                                        {{ __('body.Text') }} @if (env('LOCALE', 'uz') == $lang->code)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <textarea name="text_{{ $lang->code }}" id="text-{{ $lang->code }}" class="form-control" rows="5">
@if (isset($news->translations[$lang->code]) && isset($news->translations[$lang->code]['text']))
{{ $news->translations[$lang->code]['text']['content'] }}
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
                                            <label class="form-label" for="news-image">
                                                {{ __('body.Image') }}
                                            </label>
                                            <input name="image" type="file" class="form-control" id="news-image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 d-flex flex-column">
                                            <label class="form-label">
                                                {{ __('body.Image Preview') }}
                                            </label>
                                            <img style="background-color: lightgray; width: 200px; height: auto;"
                                                src="{{ $news->image }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="seo_keywords">
                                                {{ __('body.SEO keywords') }}
                                            </label>
                                            <input name="seo_keywords" type="text" value="{{ $news->seo_keywords }}"
                                                placeholder="{{ __('body.Enter keywords') }}..." class="form-control"
                                                id="news-keywords">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">
                                                {{ __('body.SEO description') }}
                                            </label>
                                            <input name="seo_description" type="text" value="{{ $news->seo_description }}"
                                                placeholder="{{ __('body.Enter description') }}..." class="form-control"
                                                id="description">
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
                                                id="isPublishedSwitch" @checked($news->is_published)>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="news-update"
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
