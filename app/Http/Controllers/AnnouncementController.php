<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $announcementsQuery = Announcements::LeftJoin('announcement_read',function($join) use ($user) {
            $join->on('announcements.id','=','announcement_read.announcement_id')->where('announcement_read.user_id',$user->id);
        })
            ->select('announcements.*','announcement_read.read_at');

        $customers = User::all('id','name');
        $announcementList = Announcements::all('id','title');

        Log::info("Query Statement = ".$announcementsQuery->toSql());
        $announcements = $announcementsQuery->get();

        return view('announcement-list',compact('announcements','customers','announcementList'));
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
        $selectedUser = User::find($request->customer_id);
        $announcement = Announcements::find($id);
        $selectedUser->readAnnoucement()->syncWithoutDetaching([
            $announcement->id => [
                'read_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
