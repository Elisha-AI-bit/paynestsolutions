<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'risk_score' => 'required|integer|min:0|max:100',
            'monthly_income' => 'required|numeric|min:0',
        ]);

        $user->update($request->only('risk_score', 'monthly_income'));

        return back()->with('success', 'User profile updated successfully.');
    }
}
