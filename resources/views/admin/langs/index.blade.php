@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Langs') }}</h4>
                    <div>
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".create-lang-modal">
                            <i class="fas fa-plus"></i>
                            {{ __('body.Create') }}
                        </button>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('body.Image') }}</th>
                                <th>{{ __('body.Code') }}</th>
                                <th>{{ __('body.Name') }}</th>
                                <th>{{ __('body.Published') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = ($langs->currentPage() - 1) * $langs->perPage();
                            @endphp
                            @foreach ($langs as $lang)
                                <tr>
                                    <th scope="row">{{ ++$count }}</th>
                                    <td>
                                        <img src="{{ asset('/' . $lang->icon) }}" style="width: 50px; height: auto;"
                                            alt="{{ $lang->name }}">
                                    </td>
                                    <td>{{ $lang->code }}</td>
                                    <td>{{ $lang->name }}</td>
                                    <td>
                                        @if ($lang->is_published)
                                            <span class="badge bg-primary">{{ __('body.Published') }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ __('body.Not Published') }}</span>
                                        @endif
                                    </td>
                                    <td style="width: 250px;">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".edit-lang-modal-{{ $lang->id }}"
                                            class="btn btn-warning waves-effect waves-light my-2">
                                            <i class="fas fa-pen"></i>
                                            {{ __('body.Edit') }}
                                        </button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".delete-lang-modal-{{ $lang->id }}"
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash"></i>
                                            {{ __('body.Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Delete Modal Beginning  --}}
                                <div class="modal fade delete-lang-modal-{{ $lang->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteLangModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteLangModalLabel">{{ __('body.Delete Lang') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('langs.destroy', $lang->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    {{ __('body.Do you really want to delete this?') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ __('body.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  Delete Modal End  --}}

                                {{--  Edit Modal Beginning  --}}
                                <div class="modal fade edit-lang-modal-{{ $lang->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editLangModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLangModalLabel">{{ __('body.Update Lang') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('langs.update', $lang->id) }}"
                                                enctype="multipart/form-data" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <img src="{{ asset('/' . $lang->icon) }}"
                                                                    style="width: 50px; height: auto;"
                                                                    alt="{{ $lang->name }}">
                                                                    {{ __('body.Icon Preview') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="lang-code">
                                                                    {{ __('body.Code') }} <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="code" value="{{ $lang->code }}"
                                                                    type="text" placeholder="{{ __('body.Enter code') }}..."
                                                                    class="form-control" id="lang-code">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="lang-name">
                                                                    {{ __('body.Name') }} <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="name" value="{{ $lang->name }}"
                                                                    type="text" placeholder="{{ __('body.Enter name') }}..."
                                                                    class="form-control" id="lang-name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="lang-icon">
                                                                    {{ __('body.Icon') }}
                                                                </label>
                                                                <input name="icon" type="file" class="form-control"
                                                                    id="lang-icon">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-end">
                                                            <div class="form-check form-switch mb-3" dir="ltr">
                                                                <label class="form-check-label"
                                                                    for="isPublishedSwitch">{{ __('body.Published') }}</label>
                                                                <input name="is_published" type="checkbox"
                                                                    class="form-check-input" id="isPublishedSwitch"
                                                                    @checked($lang->is_published)>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $langs->links() }}
            </div>
        </div>
    </div>

    {{--  Create Modal Beginning  --}}
    <div class="modal fade create-lang-modal" tabindex="-1" role="dialog" aria-labelledby="createLangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLangModalLabel">{{ __('body.Create Lang') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ Route('langs.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lang-code">
                                        {{ __('body.Code') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="code" type="text" placeholder="{{ __('body.Enter code') }}..."
                                        class="form-control" id="lang-code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lang-name">
                                        {{ __('body.Name') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="name" type="text" placeholder="{{ __('body.Enter name') }}..."
                                        class="form-control" id="lang-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lang-icon">
                                        {{ __('body.Icon') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="icon" type="file" class="form-control" id="lang-icon">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-3" dir="ltr">
                                    <label class="form-check-label" for="isPublishedSwitch">{{ __('body.Published') }}</label>
                                    <input name="is_published" type="checkbox" class="form-check-input"
                                        id="isPublishedSwitch" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('body.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  Create Modal End  --}}
@endsection
