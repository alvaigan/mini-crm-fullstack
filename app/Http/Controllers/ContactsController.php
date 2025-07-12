<?php

namespace App\Http\Controllers;

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

        try {
            $data = Contacts::with('role');

            if ($role != null) {
                $data = $data->where('role_id',  $role);
            }

            if ($company != null) {
                $data = $data->where('company', 'like', "%". $company ."%");
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

    public function call_logs_list() {
        $result = [];
        for ($i = 1; $i <= 10; $i++) {

            $status = "Completed";

            if ($i % 2 == 0) {
                $status = "Missed";
            }

            $result[] = [
                "id" => $i,
                "name" => "custom name " . $i,
                "timestamp" => "6122222222" . $i,
                "duration" => $i . " minutes",
                "status" => $status,
            ];
        }

        return response()->json($result);
    }
}
