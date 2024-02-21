<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    public function index()
    {
        return Group::all();
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
        $group = new Group;
        $group->group_name = $request->group["group_name"];
        $group->group_description = $request->group["group_description"];
        $group->email = $request->group["email"];
        $group->creator_id = $request->group["creator_id"];
        $group->save();

        if ($request->hasFile('group_picture')) {
            $group_picture = $request->file('group_picture');
            $imageName = uniqid() . '_' . $group_picture->getClientOriginalName();
            $group_picture->move(public_path('storage/photos'), $imageName);
            $group->group_picture = 'photos/' . $imageName;
            $group->save();
        }

        return response()->json($group);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $group = Group::find($id);

        return response()->json($group);
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
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['error' => 'Group Not Found'], 404);
        }

        $group->group_name = $request->input('group_name');
        $group->group_description = $request->input('group_description');

        if ($request->hasFile('group_picture')) {
            $oldPicture = $group->group_picture;
            if ($oldPicture) {
                unlink(public_path('storage/' . $oldPicture));
            }

            $group_picture = $request->file('group_picture');
            $imageName = uniqid() . '_' . $group_picture->getClientOriginalName();
            $group_picture->move(public_path('storage/photos'), $imageName);

            $group->group_picture = 'photos/' . $imageName;
        }
        if ($request->hasFile('group_icon')) {
            $oldPicture = $group->group_icon;
            if ($oldPicture) {
                unlink(public_path('storage/' . $oldPicture));
            }

            $group_icon = $request->file('group_icon');
            $iconName = uniqid() . '_' . $group_icon->getClientOriginalName();
            $group_icon->move(public_path('storage/photos'), $iconName);

            $group->group_icon = 'photos/' . $iconName;
        }

        $group->save();

        return response()->json($group);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::find($id);

        if ($group) {
            $group->delete();
            return "Group Successfully Deleted.";
        }
        return "Group Not Found";
    }

    public function getUsersInGroup($id)
    {
        $group = Group::findOrFail($id);
        $users = $group->users;

        return response()->json($users);
    }
}
