@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.SEO') }}</h4>
                    <div>
                        <button type="button" class="btn btn-warning waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".edit-seo-modal">
                            <i class="fas fa-pen"></i>
                            {{ __('body.Edit') }}
                        </button>
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
                                <td>{{ __('body.Keywords') }}</td>
                                <td>
                                    {{ $seo->keywords }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Description') }}</td>
                                <td>
                                    {{ $seo->description }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{--  Edit Modal Beginning  --}}
    <div class="modal fade edit-seo-modal" tabindex="-1" role="dialog" aria-labelledby="editSeoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSeoModalLabel">{{ __('body.Update SEO') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ Route('dash.seos.update', $seo->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="seo-keywords">
                                        {{ __('body.Keywords') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="keywords" value="{{ $seo->keywords }}" type="text"
                                        placeholder="{{ __('body.Enter keywords') }}..." class="form-control" id="seo-keywords">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="seo-description">
                                        {{ __('body.Description') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="description" value="{{ $seo->description }}" type="text"
                                        placeholder="{{ __('body.Enter description') }}..." class="form-control" id="seo-description">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('body.Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  Edit Modal End  --}}
@endsection
