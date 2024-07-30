<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LineIdController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'line_id' => 'nullable|string',
        ]);
    
        DB::table('users')
            ->where('id', $user->id)
            ->update(['line_id' => $request->line_id]);

        return redirect()->route('profile.edit')->with('success', 'Line ID updated successfully.');
    }

}
