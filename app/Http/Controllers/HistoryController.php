<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Item;
use App\Models\Item_history;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = Item::with(['user.item_history'])->orderBy('created_at', 'DESC');
        // $items = DB::table('items')->get();
        $items = Item::find($id);
        $history = DB::table('item_histories')->get();
        // $edit = DB::table('items')->find(2);
        // $edit = Item::find('id');
        // $items = $items->paginate(10);
        // return view('items.index', compact('items'));
        return view('history.index', ['history' => $history, 'items' => $items]);
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
        $items = Item::find($id);
        $history = DB::table('item_histories')->get();
        return view('history.index', ['history' => $history, 'items' => $items]);
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
            'type' => 'required|numeric',
            // 'code' => 'required|string|unique:items',
            'amount' => 'required|numeric',
            // 'stock' => 'required|numeric',
        ]);

        $history = Item_history::create([
            'item_id' => $items->id,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);
        if($request->type == 0) {
            $items->update([
                // 'name' => $request->name,
                // 'code' => $request->code,
                // 'stock_min' => $request->stock_min,
                'stock' => $items->stock -= $request->amount
            ]);
        }elseif($request->type != 0) {
            // dd($items->stock);
            $items->update([
                // 'name' => $request->name,
                // 'code' => $request->code,
                // 'stock_min' => $request->stock_min,
                'stock' => $items->stock += $request->amount
            ]);
        }
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
        //
    }
}
