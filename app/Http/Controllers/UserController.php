<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(string $id)
    {
        return User::find($id);
    }

    public function edit(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ]);
        }
        $user->update([
            'type' => $request['type'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
        ]);
    }
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found']);
        }

        if ($request->hasFile('image')) {

            $oldPicture = $user->image;
            if ($oldPicture) {
                unlink(public_path('storage/' . $oldPicture));
            }
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/photos'), $imageName);

            $user->image = 'photos/' . $imageName;
            $user->save();

            return response()->json(['message' => 'Image uploaded successfully', 'user' => $user]);
        }

        return response()->json(['message' => 'No image provided']);
    }
}
