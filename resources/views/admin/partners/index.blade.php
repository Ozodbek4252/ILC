@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Partners') }}</h4>
                    <div>
                        <a href="{{ Route('dash.partners.create') }}" class="btn btn-primary waves-effect waves-light">
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
                                <th>{{ __('body.Image') }}</th>
                                <th>{{ __('body.Name') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = ($partners->currentPage() - 1) * $partners->perPage();
                            @endphp
                            @foreach ($partners as $partner)
                                <tr>
                                    <th scope="row">{{ ++$count }}</th>
                                    <td>
                                        <img style="background-color: lightgray; width: 200px; height: auto;"
                                            src="{{ $partner->image_url }}" alt="">

                                    </td>
                                    <th>{{ $partner->name }}</th>
                                    <td>
                                        <a href="{{ Route('dash.partners.edit', $partner->id) }}"
                                            class="btn btn-warning waves-effect waves-light my-2">
                                            <i class="fas fa-pen"></i>
                                            {{ __('body.Edit') }}
                                        </a>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".delete-partner-modal-{{ $partner->id }}"
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash"></i>
                                            {{ __('body.Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Delete Modal Beginning  --}}
                                <div class="modal fade delete-partner-modal-{{ $partner->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deletePartnerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deletePartnerModalLabel">
                                                    {{ __('body.Delete Partner') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('dash.partners.destroy', $partner->id) }}"
                                                method="POST">
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
                {{ $partners->links() }}
            </div>
        </div>
    </div>
@endsection
