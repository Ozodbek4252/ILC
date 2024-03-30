@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Requests') }}</h4>
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
                                <th>{{ __('body.CreatedAt') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = ($requests->currentPage() - 1) * $requests->perPage();
                            @endphp
                            @foreach ($requests as $request)
                                <tr>
                                    <th scope="row">{{ ++$count }}</th>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->phone }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->message }}</td>
                                    <td>{{ $request->created_at }}</td>
                                    <td style="width: 250px;">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".delete-request-modal-{{ $request->id }}"
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash"></i>
                                            {{ __('body.Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Delete Modal Beginning  --}}
                                <div class="modal fade delete-request-modal-{{ $request->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteRequestModalLabel">
                                                    {{ __('body.Delete Request') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('dash.requests.destroy', $request->id) }}"
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

                {{ $requests->links() }}
            </div>
        </div>
    </div>
@endsection
