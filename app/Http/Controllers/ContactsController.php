<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = [];
        for ($i = 1; $i <= 10; $i++) {
            $result[] = [
                "id" => $i,
                "name" => "custom name " . $i,
                "phone" => "6122222222" . $i,
                "role" => "employee",
            ];
        }

        return response()->json($result);
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
