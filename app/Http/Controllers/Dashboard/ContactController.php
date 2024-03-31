<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\ViewModels\Contact\ContactViewModel;
use App\Models\Contact;
use App\Models\Lang;
use App\ViewModels\Contact\IndexContactViewModel;
use Exception;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $langs = Lang::where('is_published', true)->get();
        $contact = Contact::with('translations.lang')->first();

        $contact =  Contact::with('translations.lang')->find($contact->id);
        $contact = new IndexContactViewModel($contact);
        return view('admin.contacts.index', compact('langs', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $langs = Lang::where('is_published', true)->get();

        $contact =  Contact::with('translations.lang')->find($contact->id);
        $contact = new ContactViewModel($contact);
        return view('admin.contacts.edit', compact('langs', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {
            DB::beginTransaction();

            $contact->update([
                'phone' => $request->input('phone'),
                'email' => $request->input('email')
            ]);
            $contact->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('address_' . $lang->code)) {
                    $contact->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'address',
                        ],
                        [
                            'content' => $request->input('address_' . $lang->code),
                        ]
                    );
                }

                if ($request->input('schedule_' . $lang->code)) {
                    $contact->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'schedule',
                        ],
                        [
                            'content' => $request->input('schedule_' . $lang->code),
                        ]
                    );
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.contacts.index');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
            ]);
        }
    }
}
