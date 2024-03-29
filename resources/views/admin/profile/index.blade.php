@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between px-5">
                        <div class="col-lg-5">
                            <div class="mt-5 mt-lg-4">
                                <h5 class="font-size-14 mb-4">
                                    <i class="mdi mdi-arrow-right text-primary me-1"></i>
                                    {{ __('profile.Update Credentials') }}
                                </h5>
                                <form id="profile-change-id" action="{{ Route('profile.update') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="profile-name" class="col-sm-3 col-form-label">
                                            {{ __('profile.Name') }}</label>
                                        <div class="col-sm-9">
                                            <input name="name" value="{{ $user->name }}" type="text" disabled
                                                class="form-control" placeholder="{{ __('profile.Enter name') }}..."
                                                id="profile-name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="profile-email"
                                            class="col-sm-3 col-form-label">{{ __('profile.Email') }}</label>
                                        <div class="col-sm-9">
                                            <input name="email" value="{{ $user->email }}" type="email"
                                                class="form-control" placeholder="{{ __('profile.Enter email') }}..."
                                                disabled id="profile-email">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="profile-image"
                                            class="col-sm-3 col-form-label">{{ __('profile.Image') }}</label>
                                        <div class="col-sm-9">
                                            <input name="profile_image" value="{{ $user->profile_image }}" type="file"
                                                class="form-control" disabled id="profile-image">
                                        </div>
                                    </div>
                                    @if ($user->profile_image)
                                        <div class="row mb-4">
                                            <label for="profile-image"
                                                class="col-sm-3 col-form-label">{{ __('profile.Image Preview') }}</label>
                                            <div class="col-sm-9">
                                                <img @if ($user->profile_image == null || !Storage::exists('/public/' . $user->profile_image)) src="{{ asset('assets/images/user-regular-204.png') }}"
                                                    @else
                                                        src="{{ asset('storage/' . $user->profile_image) }}" @endif
                                                    style="width: 200px; height: auto;" alt="">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">
                                            <div>
                                                <button type="button" class="btn btn-primary w-md"
                                                    id="enable-edit-btn">{{ __('profile.Edit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mt-5 mt-lg-4">
                                <h5 class="font-size-14 mb-4">
                                    <i class="mdi mdi-arrow-right text-primary me-1"></i>
                                    {{ __('profile.Update Password') }}
                                </h5>
                                <form action="{{ Route('profile.updatePassword') }}" method="POST">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="profile-current-password" class="col-sm-3 col-form-label">
                                            {{ __('profile.Current Password') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input name="current_password" type="password" class="form-control"
                                                placeholder="{{ __('profile.Enter current password') }}..."
                                                id="profile-current-password">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="profile-new-password" class="col-sm-3 col-form-label">
                                            {{ __('profile.New Password') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input name="password" type="password" class="form-control"
                                                placeholder="{{ __('profile.Enter new password') }}..."
                                                id="profile-new-password">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="profile-password-confirm" class="col-sm-3 col-form-label">
                                            {{ __('profile.Confirm Password') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                placeholder="{{ __('profile.Confirm password') }}..."
                                                id="profile-password-confirm">
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary w-md">{{ __('profile.Update') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            let formSubmitted = false;

            $('#enable-edit-btn').click(function() {
                let nameInput = $('#profile-name');
                let emailInput = $('#profile-email');
                let imageInput = $('#profile-image');
                nameInput.prop('disabled', false);
                emailInput.prop('disabled', false);
                imageInput.prop('disabled', false);

                if (!formSubmitted) {
                    // Prevent default form submission behavior
                    event.preventDefault();
                    $(this).attr('type', 'submit');
                    $(this).text("{{ __('profile.Update') }}");
                    formSubmitted = true; // Update form submission state
                } else {
                    $('#profile-change-id').submit(); // Replace 'your-form-id' with your actual form ID
                }
            });
        });
    </script>
@endsection
