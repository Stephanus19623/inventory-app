<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class inventory_controller extends Controller
{
    // List all the items
    public function index()
   {
        $items = Item::all();
        return view('inventory.index', compact('items'));
   }


   // Borrow an item(tools)
   public function borrow(Request $request, $id)
   {
    $item = Item::findOrFail($id);
    if ($item->quantity > 0) {
        // Create new transaction (borrowed)
        Transaction::create([
            'item_id'=> $item->id,
            'user_id'=> 1, 
            'status' => 'borrowed',
        ]);
        // Delete the item
        $item->quantity--;
        $item->save();
        return redirect()->route('inventory.index');
    }

    return redirect()->route('inventory.index')->with('error', 'Item is out of stock!');


   }
   
   // Return the item(tools)
   public function return($id)
   {
        $transaction = Transaction::where('item_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($transaction) {
            $item = $transaction->item;
            $transaction->status = 'returned';
            $transaction->save();

            // Increase the item(tools) quantity
            $item->quantity++;
            $item->save();

            return redirect()->route('inventory.index');

        }

        return redirect()->route('inventory.index')->with('error', 'No borrowed transactions!');
   }
}