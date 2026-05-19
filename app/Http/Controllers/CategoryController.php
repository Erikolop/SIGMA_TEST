<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Item;
use App\Models\activity_log;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function detailCategory(Request $request, $id)
    {
        $category = Kategori::findOrFail($id);

        $query = Item::where('id_kategori', $id);

        if ($request->filled('search')) {
            $query->where('item_name', 'like', '%' . $request->search . '%');
        }

        $items = $query->paginate(10)->appends($request->only('search'));

        return view('admin.category_detail', compact('category', 'items'));
    }

    public function categoryManagement(Request $request)
    {
        $query = Kategori::with('items');

        if ($request->filled('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(10)->appends($request->only('search'));
        return view('admin.category', compact('categories'));
    }

    public function deleteCategory($id)
    {
        Kategori::destroy($id);
        return redirect()->route('categoryManagement');
    }

    public function bulkDeleteCategories(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);
        Kategori::whereIn('id', $request->ids)->delete();
        return redirect()->route('categoryManagement');
    }

    public function editCategory(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->route('categoryManagement');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('categoryManagement');
    }

    public function editItemFromDetail(Request $request, $categoryId, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:100',
            'item_qty'  => 'required|integer|min:0',
        ]);

        $item = Item::where('id', $id)->where('id_kategori', $categoryId)->firstOrFail();

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
        $item->item_name = $request->item_name;
        $item->item_qty  = $request->item_qty;
        $item->save();

        return redirect()->route('detailCategory', $categoryId);
    }
}
