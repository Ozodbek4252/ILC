@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Banners') }}</h4>
                    <div>
                        <a href="{{ Route('dash.banners.create') }}" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-plus"></i>
                            {{ __('body.Create') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('body.File') }}</th>
                                <th>{{ __('body.Title') }}</th>
                                <th>{{ __('body.Published') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = ($pagination->currentPage() - 1) * $pagination->perPage();
                            @endphp
                            @foreach ($pagination->items() as $banner)
                                <tr>
                                    <th scope="row">{{ ++$count }}</th>
                                    <td>
                                        @if ($banner->type == 'image')
                                            <img style="background-color: lightgray; width: 200px; height: auto;"
                                                src="{{ $banner->file }}" alt="">
                                        @elseif ($banner->type == 'video')
                                            <video style="background-color: lightgray; width: 200px; height: auto;" controls
                                                muted autoplay loop>
                                                <source src="{{ $banner->file }}" type="{{ $banner->file_type }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </td>
                                    <td>
                                        {{ isset($banner->translations['title']) ? $banner->translations['title']['content'] : '' }}
                                    </td>
                                    <td>
                                        @if ($banner->is_published)
                                            <span class="badge bg-primary">{{ __('body.Published') }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ __('body.Not Published') }}</span>
                                        @endif
                                    </td>
                                    <td style="width: 250px;">
                                        <a href="{{ Route('dash.banners.edit', $banner->id) }}"
                                            class="btn btn-warning waves-effect waves-light my-2">
                                            <i class="fas fa-pen"></i>
                                            {{ __('body.Edit') }}
                                        </a>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".delete-banner-modal-{{ $banner->id }}"
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash"></i>
                                            {{ __('body.Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Delete Modal Beginning  --}}
                                <div class="modal fade delete-banner-modal-{{ $banner->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteBannerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteBannerModalLabel">
                                                    {{ __('body.Delete Banner') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('dash.banners.destroy', $banner->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    {{ __('body.Do you really want to delete this?') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('body.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  Delete Modal End  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pagination->links() }}
            </div>
        </div>
    </div>
@endsection
