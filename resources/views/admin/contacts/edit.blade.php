@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">{{ __('body.Update Contact') }}</h4>

                            <div class="my-2">
                                <a href="{{ Route('dash.contacts.index') }}"
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

                        <form action="{{ Route('dash.contacts.update', $contact->id) }}" enctype="multipart/form-data"
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
                                                    <label class="form-label" for="contact-address-{{ $lang->code }}">
                                                        {{ __('body.Address') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="address_{{ $lang->code }}"
                                                        value="@if (isset($contact->translations[$lang->code]) && isset($contact->translations[$lang->code]['address'])) {{ $contact->translations[$lang->code]['address']['content'] }} @endif"
                                                        type="text" placeholder="{{ __('body.Enter address') }}..."
                                                        class="form-control" id="contact-address-{{ $lang->code }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="contact-schedule-{{ $lang->code }}">
                                                        {{ __('body.Schedule') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <input name="schedule_{{ $lang->code }}"
                                                        value="@if (isset($contact->translations[$lang->code]) && isset($contact->translations[$lang->code]['schedule'])) {{ $contact->translations[$lang->code]['schedule']['content'] }} @endif"
                                                        type="text" placeholder="{{ __('body.Enter schedule') }}..."
                                                        class="form-control" id="contact-schedule-{{ $lang->code }}">
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
                                            <label class="form-label" for="service-phone">
                                                {{ __('body.Phone') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="phone" type="text" value="{{ $contact->phone }}"
                                                placeholder="{{ __('body.Enter phone') }}..." class="form-control"
                                                id="service-phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="service-email">
                                                {{ __('body.Email') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="email" type="text" value="{{ $contact->email }}"
                                                placeholder="{{ __('body.Enter email') }}..." class="form-control"
                                                id="service-email">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="p-3 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="form-label" style="opacity: 0;">|</label>
                                            <button type="submit" id="contact-update"
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
