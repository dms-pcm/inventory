<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Item;
use App\Models\Item_history;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = Item::with(['user.item_history'])->orderBy('created_at', 'DESC');
        $items = DB::table('items')->get();
        // $data = Item_history::join('')
        $history = DB::table('item_histories')->get();
        // $edit = DB::table('items')->find(2);
        // $edit = Item::find('id');
        // $items = $items->paginate(10);
        // return view('items.index', compact('items'));
        return view('items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'code' => 'required|string|unique:items',
            'stock_min' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $items = Item::create([
            'name' => $request->name,
            'code' => $request->code,
            'stock_min' => $request->stock_min,
            'stock' => $request->stock,
        ]);
        $history = Item_history::create([
            'item_id' => $items->id,
            'type' => 1,
            'amount' => $request->stock,
        ]);
        return redirect(route('items.index'))->with(['success' => 'Data Telah Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        // $items = DB::table('items')->find($code);
        return view('items.edit', ['item' => $item]);
        // return view('items.edit')->with(compact('items');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $items = Item::find($id);
        $this->validate($request, [
            'name' => 'required|string',
            'code' => 'required|string',
            'stock_min' => 'required|numeric',
            // 'stock' => 'required|numeric',
        ]);
        $items->update([
            'name' => $request->name,
            'code' => $request->code,
            'stock_min' => $request->stock_min,
            // 'stock' => $request->stock - $request->amount
        ]);
        return redirect(route('items.index'))->with(['success' => 'Data Telah Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Item::find($id);
        $items->delete();
        return redirect(route('items.index'));
    }
}
