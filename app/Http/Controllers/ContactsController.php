<?php

namespace App\Http\Controllers;

use App\Models\CallLogs;
use App\Models\Contacts;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusCode = 200;
        $result = [
            'message' => 'ok',
            'data' => [],
        ];

        $role = $request->query('role') ?? null;
        $company = $request->query('company') ?? null;
        $is_favorite = $request->query('is_favorite') ?? null;


        try {
            $data = Contacts::with('role');

            if ($role != null) {
                $data = $data->where('role_id', $role);
            }

            if ($company != null) {
                $data = $data->where('company', 'like', '%' . $company . '%');
            }

            if ($is_favorite != null) {
                $is_favorite = filter_var($is_favorite, FILTER_VALIDATE_BOOLEAN);

                $data = $data->where('is_favorite', $is_favorite);
            }

            $data = $data->orderBy('name', 'asc')->get();

            $result['data'] = $data;
        } catch (Exception $e) {
            Log::error($e);
            $result = [];
            $result['message'] = $e->getMessage();
            $result['data'] = $e->getCode();
        }

        return response()->json($result, $statusCode);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function call_logs_list(Request $request)
    {
        $statusCode = 200;
        $result = [
            'message' => 'ok',
            'data' => [],
        ];

        $from = $request->query('from') ?? null;
        $to = $request->query('to') ?? null;

        try {
            $data = CallLogs::query();

            if (! empty($from) && ! empty($to)) {
                $data = $data->whereBetween('created_at', [$from, $to]);
            }

            $data = $data->get();

            $result['data'] = $data;
        } catch (Exception $e) {
            Log::error($e);
            $result = [];
            $result['message'] = $e->getMessage();
            $result['data'] = $e->getCode();
        }

        return response()->json($result, $statusCode);
    }

    public function add_call_log(Request $request)
    {
        $contact = $request->input('contact_name');
        $duration = $request->input('duration');
        $status = $request->input('status');

        $statusCode = 200;
        $result = [
            'message' => 'ok',
            'data' => [],
        ];

        try {
            $call_log = CallLogs::create(
                [
                    'contact_name' => $contact,
                    'duration' => $duration,
                    'status' => $status,
                ]
            );

            $result['data'] = $call_log;
        } catch (Exception $e) {
            Log::error($e);
            $result = [];
            $result['message'] = $e->getMessage();
            $result['data'] = $e->getCode();
            $statusCode = 500;
        }

        return response()->json($result, $statusCode);
    }

    public function toggle_favorite($id)
    {
        $statusCode = 200;
        $result = [
            'message' => 'ok',
            'data' => [],
        ];

        try {
            $contact = Contacts::find($id);

            $contact->is_favorite = !$contact->is_favorite;

            $contact->save();

            $result['data'] = $contact;
        } catch (Exception $e) {
            Log::error($e);
            $result = [];
            $result['message'] = $e->getMessage();
            $result['data'] = $e->getCode();
            $statusCode = 500;
        }

        return response()->json($result, $statusCode);
    }
}
