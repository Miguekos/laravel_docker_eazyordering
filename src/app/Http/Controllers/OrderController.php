<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Log;
use App\Models\Order;
//use App\Mail\OrderCreated;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Notifications\OrderCreated;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function store()
    {
        #Crear orden
        $order = Order::create([
            'warehouse_id' => 2,
            'manager_id' => Auth::id(),
            'date' => now(),
            'total' => \Cart::getTotal(),
        ]);

        #Obtener y asociar cada item del carrito a la orden
        $cartItems = \Cart::getContent();

        foreach ($cartItems as $item) {            
            $order->products()->attach($item->id, ['quantity' => $item->quantity, 'unit_price' => $item->price]);
        }

        #Generar excel y enviar por correo a: Warehouse y Manager
        $this->storeExcel($order->id);

        try {
            //Mail::send(new OrderCreated($order));
            $order->warehouse->notify(new OrderCreated($order));
        } catch (\Exception $e) {            
            Log::critical('error email OrderCreated: '.$order->id.' '. $e->getMessage());
        }

        #Limpiar carrito  
        \Cart::clear();
        
        session()->flash('message', 'Order Created Successfully.');
  
        return redirect()->route('cart');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('order_view', compact('order'));
    }

    public function storeExcel($id) 
    {
        Excel::store(new OrdersExport($id), 'order_'.$id.'.xlsx');
    }

    public function exportExcel($id) 
    {
        return Excel::download(new OrdersExport($id), 'order_'.$id.'.xlsx');
    }
}
