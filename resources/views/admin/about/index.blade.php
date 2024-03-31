@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.About') }}</h4>
                    <div>
                        <a href="{{ Route('dash.abouts.edit', $about->id) }}"
                            class="btn btn-warning waves-effect waves-light my-2">
                            <i class="fas fa-pen"></i>
                            {{ __('body.Edit') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('body.Name') }}</th>
                                <th>{{ __('body.Value') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('body.Title') }}</td>
                                <td>
                                    {{ isset($about->translations['title']) ? $about->translations['title']['content'] : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Sub Title') }}</td>
                                <td>
                                    {{ isset($about->translations['sub_title']) ? $about->translations['sub_title']['content'] : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Background Image') }}</td>
                                <td>
                                    <img style="background-color: lightgray; width: 200px; height: auto;"
                                        src="{{ $about->background_image_url }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Section 1 Image') }}</td>
                                <td>
                                    <img style="background-color: lightgray; width: 200px; height: auto;"
                                        src="{{ $about->sec1_image_url }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Section 1 Description') }}</td>
                                <td>
                                    {{ isset($about->translations['sec1_description']) ? $about->translations['sec1_description']['content'] : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Section 2 Image') }}</td>
                                <td>
                                    <img style="background-color: lightgray; width: 200px; height: auto;"
                                        src="{{ $about->sec2_image_url }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Section 2 Description') }}</td>
                                <td>
                                    {{ isset($about->translations['sec2_description']) ? $about->translations['sec2_description']['content'] : '' }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
