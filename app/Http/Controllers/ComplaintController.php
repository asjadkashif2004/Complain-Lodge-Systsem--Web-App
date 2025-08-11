<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * USER: Dashboard (stats + recent)
     * Route name: complaints.dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Simple stats for the logged-in user
        $stats = [
            'total'      => Complaint::where('user_id', $user->id)->count(),
            'pending'    => Complaint::where('user_id', $user->id)->where('status', 'Pending')->count(),
            'inProgress' => Complaint::where('user_id', $user->id)->where('status', 'In Progress')->count(),
            'resolved'   => Complaint::where('user_id', $user->id)->where('status', 'Resolved')->count(),
            'rejected'   => Complaint::where('user_id', $user->id)->where('status', 'Rejected')->count(),
        ];

        $recent = Complaint::where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

        return view('complaints.dashboard', compact('user', 'stats', 'recent'));
    }

    /**
     * USER: List own complaints (with optional pagination)
     */
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10); // was ->get(); paginate is nicer in UI

        return view('complaints.index', compact('complaints'));
    }

    /**
     * USER: Create form
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * USER: Store complaint
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        Complaint::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => 'Pending',
        ]);

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Complaint lodged successfully!');
    }

    /**
     * ADMIN: List all complaints
     * (Use this only if your admin routes point to ComplaintController;
     * otherwise, keep this in AdminController.)
     */
    public function adminIndex()
    {
        $complaints = Complaint::latest()->paginate(15);
        return view('admin.index', compact('complaints'));
    }

    /**
     * ADMIN: Update status
     * (If your admin routes use AdminController instead, remove this here.)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:Pending,In Progress,Resolved,Rejected'],
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;
        $complaint->save();

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * ADMIN (or owner): Show a complaint
     * If you plan to allow users to view their own complaint detail on a shared view,
     * this check protects access. If this action is admin-only behind middleware,
     * you can simplify it.
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);

        // If not admin, ensure user owns it
        if (!(Auth::user()->role === 'admin') && $complaint->user_id !== Auth::id()) {
            abort(403);
        }

        // If you have an admin view:
        if (Auth::user()->role === 'admin') {
            return view('admin.show', compact('complaint'));
        }

        // Otherwise a user detail view (if you have one):
        return view('complaints.show', compact('complaint'));
    }
}
