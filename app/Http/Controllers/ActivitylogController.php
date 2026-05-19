<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\activity_log;

class ActivitylogController extends Controller
{
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
        return view('staff.activity_log', compact('logs'));
    }
}
