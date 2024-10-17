<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return StaffResource::collection(Staff::where('user_id', Auth::user()->id)->get());
        return StaffResource::collection(Staff::all());

    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create(Request $request)
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        $request->validated($request->all());
        $staff = Staff::create([
            'user_id' => Auth::user()->id,
            'surname' => $request->surname,
            'other_name' => $request->other_name,
            'date_of_birth' => $request->date_of_birth,
            'id_photo' => $request->id_photo? base64_encode($request->id_photo) : null,
            'file_path' => Storage::get($request->id_photo)
        ]);

        return new StaffResource($staff);
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return new StaffResource($staff);
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
    public function update(Request $request, Staff $staff)
    {
//        if(Auth::user()->id !== $staff->user_id){
//            return $this->error('', 'You do not have permission to view this task', 403);
//            // Use Staff ID 3 for demo
//        }

        $staff->update($request->all());

        return new StaffResource($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return response()->json('Staff has been deleted.', 204);
    }
}
