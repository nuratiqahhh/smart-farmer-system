<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ADMIN VIEW USERS
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::query()

            ->when($search, function ($query, $search) {

                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%');

            })

            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // prevent deleting yourself
        if ($user->id == auth()->id()) {

            return back()->with(
                'error',
                'You cannot delete your own account.'
            );

        }

        $user->delete();

        return back()->with(
            'success',
            'User deleted successfully.'
        );
    }
}