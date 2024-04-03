@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title">{{ __('body.Socials') }}</h4>
                    <div>
                        <button type="button" class="btn btn-primary waves-effect waves-light create" data-bs-toggle="modal"
                            data-bs-target=".create-social-modal">
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
                                <th>{{ __('body.Icon') }}</th>
                                <th>{{ __('body.Name') }}</th>
                                <th>{{ __('body.Link') }}</th>
                                <th>{{ __('body.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = ($socials->currentPage() - 1) * $socials->perPage();
                            @endphp
                            @foreach ($socials as $social)
                                <tr>
                                    <th scope="row">{{ ++$count }}</th>
                                    <td>
                                        <img src="{{ $social->icon_path }}" style="width: 50px; height: auto;"
                                            alt="">
                                    </td>
                                    <td>{{ $social->name }}</td>
                                    <td>{{ $social->link }}</td>
                                    <td style="width: 250px;">
                                        <button type="button" data-bs-toggle="modal" data-id="{{ $social->id }}"
                                            data-bs-target=".edit-social-modal-{{ $social->id }}"
                                            data-icon-path="{{ $social->icon_path }}"
                                            class="edit btn btn-warning waves-effect waves-light my-2">
                                            <i class="fas fa-pen"></i>
                                            {{ __('body.Edit') }}
                                        </button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target=".delete-social-modal-{{ $social->id }}"
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="fas fa-trash"></i>
                                            {{ __('body.Delete') }}
                                        </button>
                                    </td>
                                </tr>

                                {{--  Delete Modal Beginning  --}}
                                <div class="modal fade delete-social-modal-{{ $social->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="deleteSocialModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteSocialModalLabel">
                                                    {{ __('body.Delete Social') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('dash.socials.destroy', $social->id) }}" method="POST">
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

                                {{--  Edit Modal Beginning  --}}
                                <div class="modal fade edit-social-modal-{{ $social->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editSocialModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSocialModalLabel">
                                                    {{ __('body.Update Social') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{ Route('dash.socials.update', $social->id) }}"
                                                enctype="multipart/form-data" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social-name">
                                                                    {{ __('body.Name') }} <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input name="name" value="{{ $social->name }}"
                                                                    type="text"
                                                                    placeholder="{{ __('body.Enter name') }}..."
                                                                    class="name-edit-{{ $social->id }} form-control"
                                                                    id="social-name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social-link">
                                                                    {{ __('body.Link') }} <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input name="link" value="{{ $social->link }}"
                                                                    type="text"
                                                                    placeholder="{{ __('body.Enter link') }}..."
                                                                    class="form-control link-edit-{{ $social->id }}"
                                                                    id="social-link">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="edit-icon-id">
                                                                    @lang('body.Icon') <span class="text-danger">*</span>
                                                                </label>

                                                                <select name="icon_id" id="edit-icon-id"
                                                                    class="select2 form-select edit-icon">
                                                                    <option value="">@lang('body.Select')</option>
                                                                    @foreach ($icons as $icon)
                                                                        <option value="{{ $icon['id'] }}"
                                                                            @selected($social->icon_id == $icon['id'])
                                                                            data-icon-path="{{ $icon->icon }}"
                                                                            data-id="{{ $social->id }}">
                                                                            {{ $icon['name'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3 d-flex flex-column">
                                                                <label class="form-label" for="social-image">
                                                                    {{ __('body.Icon Preview') }}
                                                                </label>
                                                                <div>
                                                                    <img src=""
                                                                        id="edit-icon-preview-{{ $social->id }}"
                                                                        style="display:none; max-height: 37px; height: 37px; width: auto; object-fit: contain; background-color: #D3D3D3;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('body.Update') }}</button>
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

                {{ $socials->links() }}
            </div>
        </div>
    </div>

    {{--  Create Modal Beginning  --}}
    <div class="modal fade create-social-modal" tabindex="-1" role="dialog" aria-labelledby="createSocialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSocialModalLabel">{{ __('body.Create Social') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ Route('dash.socials.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="create-social-name">
                                        {{ __('body.Name') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="name" type="text" placeholder="{{ __('body.Enter name') }}..."
                                        class="form-control" id="create-social-name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="create-social-link">
                                        {{ __('body.Link') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="link" type="text" placeholder="{{ __('body.Enter link') }}..."
                                        class="form-control" id="create-social-link">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="create-icon-id">
                                        @lang('body.Icon') <span class="text-danger">*</span>
                                    </label>
                                    <select name="icon_id" id="create-icon-id" class="select2 form-select">
                                        <option value="">@lang('body.Select')</option>
                                        @foreach ($icons as $icon)
                                            <option value="{{ $icon['id'] }}" data-icon-path="{{ $icon->icon }}">
                                                {{ $icon['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 d-flex flex-column">
                                    <label class="form-label" for="social-image">
                                        {{ __('body.Icon Preview') }}
                                    </label>
                                    <div>
                                        <img src="" id="create-icon-preview"
                                            style="display:none; max-height: 37px; height: 37px; width: auto; object-fit: contain; background-color: #D3D3D3;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('body.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  Create Modal End  --}}
@endsection

@section('js')
    <script type="text/javascript">
        var socials = @json($socials).data;

        $('.edit').click(function() {
            let socialId = $(this).data('id');
            let filteredArray = socials.find(obj => obj.id === socialId);

            $('.name-edit-' + socialId).val(filteredArray.name);
            $('.link-edit-' + socialId).val(filteredArray.link);

            let iconPath = $(this).data('icon-path');
            icon(iconPath, socialId);
        });

        function icon(path, socialId) {
            $('#edit-icon-preview-' + socialId).attr('src', path);
            $('#edit-icon-preview-' + socialId).css('display', 'block');
        }

        $(document).on('change', `select.edit-icon`, function() {
            var selectedOption = $(this).find(':selected');
            var selectedIconPath = selectedOption.data('icon-path');
            var socialId = selectedOption.data('id');

            console.log(selectedIconPath);
            $('#edit-icon-preview-' + socialId).attr('src', selectedIconPath);
            $('#edit-icon-preview-' + socialId).css('display', 'block');
        });






        // Create Modal
        $('.create').click(function() {
            clearCreateInputs();
        });

        $(document).on('change', 'select[id="create-icon-id"]', function() {
            // get selected option
            var selectedOption = $(this).find(':selected');
            var selectedIconPath = selectedOption.data('icon-path');

            console.log(selectedIconPath);
            $('#create-icon-preview').attr('src', selectedIconPath);
            $('#create-icon-preview').css('display', 'block');
        });

        function clearCreateInputs() {
            $('#create-social-name').val('');
            $('#create-social-link').val('');
            $('#create-icon-preview').css('display', 'none');
            $('#create-icon-id').val('');
        }
    </script>
@endsection
