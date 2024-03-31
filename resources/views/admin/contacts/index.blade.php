@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Contacts') }}</h4>
                    <div>
                        <a href="{{ Route('dash.contacts.edit', $contact->id) }}"
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
                                <td>{{ __('body.Phone') }}</td>
                                <td>{{ $contact->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Email') }}</td>
                                <td>{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Address') }}</td>
                                <td>
                                    {{ isset($contact->translations['address']) ? $contact->translations['address']['content'] : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('body.Schedule') }}</td>
                                <td>
                                    {{ isset($contact->translations['schedule']) ? $contact->translations['schedule']['content'] : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
