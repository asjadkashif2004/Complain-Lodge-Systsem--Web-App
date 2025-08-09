<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Admin dashboard logic
        return view('admin.dashboard');
    }
    // Show all complaints to the admin
    public function index()
    {
        $complaints = Complaint::all(); // Fetch all complaints
        return view('admin.complaints', compact('complaints')); // Pass correct variable
    }

    // Update complaint status
    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);  // Find complaint by ID
        $request->validate([
            'status' => 'required|string'
        ]);

        $complaint->status = $request->input('status');  // Update status
        $complaint->save();

        return redirect()->route('admin.complaints')->with('success', 'Status updated successfully.');
    }
    

}
