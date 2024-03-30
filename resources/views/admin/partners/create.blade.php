@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Create Partner') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.partners.index') }}"
                                    class="btn btn-secondary btn-soft-secondary waves-effect
                                        waves-light d-flex
                                        align-items-center justify-content-between">
                                    <i class='bx bx-arrow-back'></i>
                                    {{ __('body.Back') }}
                                </a>
                            </div>
                        </div>

                        <form action="{{ Route('dash.partners.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="partner-image">
                                                {{ __('body.Image') }} <span class="text-danger">*</span>
                                            </label>
                                            <input name="image" type="file" class="form-control" id="partner-image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="partner-name">
                                                {{ __('body.Name') }}
                                            </label>
                                            <input name="name" type="text" class="form-control"
                                                placeholder="{{ __('body.Enter name') }}..." id="partner-name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="partner-create"
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
