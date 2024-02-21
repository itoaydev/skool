<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    public function index()
    {
        return Group::all(); //Get all the data from group model table
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
        $newGroup = new Group;
        $newGroup->group_name = $request->group["group_name"];
        $newGroup->group_description = $request->group["group_description"];
        $newGroup->email = $request->group["email"];
        $newGroup->creator_id = $request->group["creator_id"];
        $newGroup->save();

        if ($request->hasFile('group_picture')) {
            $link = $request->file('group_picture')->store('photos', 'public');
            $newGroup->group_picture = $link;
            $newGroup->save();

            $newGroup->group_picture = asset('storage/' . $newGroup->group_picture);
        }

        return response()->json($newGroup);
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
        $existingGroup = Group::find($id);

        if (!$existingGroup) {
            return response()->json(['error' => 'Group Not Found'], 404);
        }

        $existingGroup->group_name = $request->input('group_name');
        $existingGroup->group_description = $request->input('group_description');

        if ($request->hasFile('group_picture')) {
            $oldPicture = $existingGroup->group_picture;
            if ($oldPicture) {
                Storage::disk('public')->delete($oldPicture);
            }

            $group_picture = $request->file('group_picture');
            $imageName = time() . '_' . $group_picture->getClientOriginalName();
            $group_picture->move(public_path('storage/photos'), $imageName);

            $existingGroup->group_picture = 'photos/' . $imageName;
        }
        if ($request->hasFile('group_icon')) {
            $oldPicture = $existingGroup->group_icon;
            if ($oldPicture) {
                Storage::disk('public')->delete($oldPicture);
            }

            $group_icon = $request->file('group_icon');
            $iconName = time() . '_' . $group_icon->getClientOriginalName();
            $group_icon->move(public_path('storage/photos'), $iconName);

            $existingGroup->group_icon = 'photos/' . $iconName;
        }

        $existingGroup->save();

        return response()->json($existingGroup);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $existingGroup = Group::find($id);

        if ($existingGroup) {
            $existingGroup->delete();
            return "Group Successfully Deleted.";
        }
        return "Group Not Found";
    }

    public function getUsersInGroup($groupId)
    {
        $group = Group::findOrFail($groupId);
        $users = $group->users;

        return response()->json($users);
    }
}
