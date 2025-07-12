<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $statusCode = 200;
        $result = [
            'message' => 'ok',
            'data' => [],
        ];

        try {

            $data = Roles::get();
            $result['data'] = $data;
        } catch (Exception $e) {
            Log::error($e);
            $result = [];
            $result['message'] = $e->getMessage();
            $result['data'] = $e->getCode();
        }

        return response()->json($result, $statusCode);
    }
}
