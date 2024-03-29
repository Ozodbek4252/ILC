<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Profile\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        try {
            /**
             * @var User
             */
            $user = auth()->user();

            $imagePath = $user->image;
            if ($request->hasFile('profile_image')) {
                if (Storage::exists('/public/' . $user->image)) {
                    Storage::delete('/public/' . $user->image);
                }
                // Store the image in a directory: 'public/users/'
                $imagePath = $request->file('profile_image')->store('users', 'public');
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'profile_image' => $imagePath,
            ]);

            toastr('Updated successfully');

            return redirect()->route('profile');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
            ]);
        }
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request)
    {
        try {
            /**
             * @var User
             */
            $user = auth()->user();

            // Check if the current password matches the user's existing password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            toastr('Password updated successfully');

            return redirect()->route('profile');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
                'message' => $e->getMessage()
            ]);
        }
    }
}
