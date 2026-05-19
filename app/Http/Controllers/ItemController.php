<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\activity_log;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function Item(Request $request)
    {
        $query     = Item::with('kategori');
        $search    = $request->search;
        $searchBy  = $request->search_by; // 'item' | 'category' | null (both)

        if ($request->filled('search')) {
            if ($searchBy === 'item') {
                // Search by item name only
                $query->where('item_name', 'like', '%' . $search . '%');
            }
            if ($searchBy === 'category') {
                // Search by category name only
                $query->whereHas('kategori', function ($k) use ($search) {
                    $k->where('nama_kategori', 'like', '%' . $search . '%');
                });
            }
        }

        $items      = $query->paginate(10)->appends($request->only(['search', 'search_by']));
        $categories = Kategori::all();

        // Admin gets the admin view with full CRUD; staff gets the stock-update-only view
        if (auth()->user()->role === 'Admin') {
            return view('admin.item_management', compact('items', 'categories'));
        }

        return view('staff.item_management', compact('items', 'categories'));
    }

    public function addItems(Request $request)
    {
        $request->validate([
            'items'              => 'required|array|min:1|max:3',
            'items.*.item_name'  => 'required|string|max:100',
            'items.*.id_kategori'=> 'required|exists:kategoris,id',
            'items.*.item_qty'   => 'required|integer|min:0',
        ]);

        foreach ($request->items as $itemData) {
            Item::create([
                'item_name'   => $itemData['item_name'],
                'id_kategori' => $itemData['id_kategori'],
                'item_qty'    => $itemData['item_qty'],
            ]);
        }

        return redirect()->route('Item');
    }

    public function editItem(Request $request, $id)
    {
        $request->validate([
            'item_name'   => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id',
            'item_qty'    => 'required|integer|min:0',
        ]);

        $item = Item::findOrFail($id);
        $jenis_mutasi = " ";
        $perubahan = 0;

        if($request->item_qty > $item->item_qty ){
            $jenis_mutasi = "Increase";
            $perubahan = $request->item_qty - $item->item_qty;
        }

        if($request->item_qty < $item->item_qty){
            $jenis_mutasi = "Decrease";
            $perubahan = $item->item_qty - $request->item_qty;
        }

        activity_log::create([
            'nama_user'       => Auth::User()->name,
            'nama_item'       => $request->item_name,
            'jenis_mutasi'  => $jenis_mutasi === 'Increase' ? 'Order In' : 'Order Out',
            'sebelum_qty' => $item->item_qty,
            'perubahan_qty' => $perubahan,
            'tgl_transaksi' => now(),
        ]);

        $item->item_name   = $request->item_name;
        $item->id_kategori = $request->id_kategori;
        $item->item_qty    = $request->item_qty;
        $item->save();

        return redirect()->route('Item');
    }

    public function deleteItem($id)
    {
        Item::destroy($id);
        return redirect()->route('Item');
    }

     public function bulkDeleteItems(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);
        Item::whereIn('id', $request->ids)->delete();
        return redirect()->route('Item');
    }

    
}
