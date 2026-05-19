<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\User;
use App\Models\activity_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalItems       = Item::count();
        $outOfStock       = Item::where('item_qty', 0)->count();
        $lowStock         = Item::where('item_qty', '<', 20)->where('item_qty', '>', 0)->count();
        $recentLogs       = activity_log::with('user', 'item')->orderByDesc('tgl_transaksi')->limit(5)->get();
        $lowestStockItems = Item::with('kategori')->orderBy('item_qty')->limit(5)->get();

        return view('admin.dashboard', compact('totalItems', 'outOfStock', 'lowStock', 'recentLogs', 'lowestStockItems'));
    }

    public function staffManagement(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate(10)->appends($request->only('search'));
        return view('admin.staff', compact('users'));
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:Admin,Staff',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('staffManagement');
    }

    public function editStaff(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:Admin,Staff',
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('staffManagement');
    }

    public function deleteStaff($id)
    {
        User::destroy($id);
        return redirect()->route('staffManagement');
    }

    public function bulkDeleteStaff(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);
        User::whereIn('id', $request->ids)->delete();
        return redirect()->route('staffManagement');
    }

    public function activityLog(Request $request)
    {
        $query = activity_log::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_user', 'like', '%' . $search . '%')
                  ->orWhere('nama_item', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('tgl_transaksi', $request->date);
        }

        $logs = $query->orderByDesc('tgl_transaksi')->paginate(10)->withQueryString();
        return view('admin.activity_log', compact('logs'));
    }
}
