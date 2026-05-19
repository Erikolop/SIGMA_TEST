<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\activity_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
  
    public function dashboard()
    {
        // Admin users get redirected to admin dashboard
        if (Auth::user()->role === 'Admin') {
            return redirect()->route('adminDashboard');
        }

        $totalItems       = Item::count();
        $lowStock         = Item::where('item_qty', '<', 100)->where('item_qty', '>', 0)->count();
        $lowestStockItems = Item::with('kategori')->orderBy('item_qty')->limit(5)->get();

        return view('staff.dashboard', compact('totalItems', 'lowStock', 'lowestStockItems'));
    }

    public function viewItem()
    {
        return redirect()->route('Item');
    }

   
    public function itemManagement()
    {
        $items = Item::with('kategori')->get();
        return view('staff.item_management', compact('items'));
    }

    


    public function activityLog()
    {
        // Admin users get redirected to admin activity log
        if (Auth::user()->role === 'Admin') {
            return redirect()->route('adminActivityLog');
        }

        $logs = activity_log::with('user', 'item')->orderByDesc('tgl_transaksi')->paginate(10);

        return view('staff.activity_log', compact('logs'));
    }

    public function itemProcess(Request $request)
    {
        $request->validate([
            'item_id'       => 'required|exists:items,id',
            'jenis_mutasi'  => 'required|in:Increase,Decrease',
            'perubahan_qty' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($request->item_id);
        $sebelum = $item->item_qty;

        if ($request->jenis_mutasi === 'Increase') {
            $item->item_qty += $request->perubahan_qty;
        } else {
            $item->item_qty = max(0, $item->item_qty - $request->perubahan_qty);
        }
        $item->save();

        activity_log::create([
            'nama_user'       => Auth::User()->name,
            'nama_item'       => $item->item_name,
            'jenis_mutasi'  => $request->jenis_mutasi === 'Increase' ? 'Order In' : 'Order Out',
            'sebelum_qty' => $sebelum,
            'perubahan_qty' => $request->perubahan_qty,
            'tgl_transaksi' => now(),
        ]);

        return redirect()->route('Item')->with('success', 'Stock updated successfully.');
    }
}
