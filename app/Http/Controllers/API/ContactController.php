<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Contact\ApiContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('translations.lang')->orderBy('updated_at', 'desc')->get();

        return ApiContactResource::collection($contacts);
    }
}
