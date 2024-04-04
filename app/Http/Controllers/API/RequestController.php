<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Models\Request as ModelsRequest;
use Exception;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'nullable|email',
                'message' => 'nullable|string',
            ]);

            ModelsRequest::create($request->all());

            TelegramController::sendMessageToGroup($request);

            return response()->json(['message' => trans('body.Request created successfully')]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error. Can\'t create request']);
        }
    }
}
