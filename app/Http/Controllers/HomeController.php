<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Stripe;

use Session;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype','user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $deliverd = Order::where('status','delivered')->get()->count();
        return view('admin.index',compact('user','product','order','deliverd'));
    }

    public function home(){

        $product = Product::all();

        if(Auth::id()){

        $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id',$user_id)->count();

        }

        else{

            $count = '';

        }

        return view('home.index',compact('product','count'));

    }

    public function login_home(){
        
        $product = Product::all();

        if(Auth::id()){

            $user = Auth::user();
    
            $user_id = $user->id;
    
            $count = Cart::where('user_id',$user_id)->count();
    
            }
    
            else{
    
                $count = '';
    
            }

        return view('home.index',compact('product','count'));
        
    } 

    public function product_details($id){

        $data = Product::find($id);

        if(Auth::id()){

            $user = Auth::user();
    
            $user_id = $user->id;
    
            $count = Cart::where('user_id',$user_id)->count();
    
            }
    
            else{
    
                $count = '';
    
            }

        return view('home.product_details',compact('data','count'));

    }

    public function add_cart($id){

        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save(); 

        toastr()->timeout(5000)->closeButton()->addSuccess('Product Added to the Cart Successfully');

        return redirect()->back();
    }

    public function mycart(){

        // $user = Auth::user();
        // $user_id = $user->id;
        // $product = Cart::where('user_id',$user_id)->get();

        if(Auth::id()){

            $user = Auth::user();
    
            $user_id = $user->id;
    
            $count = Cart::where('user_id',$user_id)->count();
            
            $cart = Cart::where('user_id',$user_id)->get();
            }


        return view('home.mycart',compact('count','cart'));

    }

    public function delete_cart($id){

        $data = Cart::find($id);
        $data->delete();

        toastr()->timeout(5000)->closeButton()->addSuccess('Product Removed from the Cart Successfully');

        return redirect()->back();

    }

    public function confirm_order(Request $request){

        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id',$user_id)->get();

        foreach($cart as $carts){

            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->product_id = $carts->product_id;
            $order->save();

            

        }

        $cart_remove = Cart::where('user_id',$user_id)->get();
        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }

        toastr()->timeout(5000)->closeButton()->addSuccess('Order Placed Successfully');
        return redirect()->back();

    }

    public function myorders(){

        // $user_id = Auth::user()->id;
        // $order = Order::where('user_id',$user_id)->get();

        $user = Auth::user()->id;
        $count = Cart::where('user_id',$user)->get()->count();
        $order = Order::where('user_id',$user)->get();

        return view('home.order',compact('count','order'));

    }


    public function stripe($value)
    {

        return view('home.stripe',compact('value'));

    }

    public function stripePost(Request $request, $value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from complete." 

        ]);

      

        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id',$user_id)->get();

        foreach($cart as $carts){

            $order = new Order;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->status = 'paid';
            $order->product_id = $carts->product_id;
            $order->save();

            

        }

        $cart_remove = Cart::where('user_id',$user_id)->get();
        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }

        toastr()->timeout(5000)->closeButton()->addSuccess('Order Placed Successfully');
        return redirect('mycart');

    }

    public function products_by_category($category_name)
{
    $product = Product::where('category', $category_name)->get();

    if(Auth::check()) {
        $user = Auth::user();
        $user_id = $user->id;
        $count = Cart::where('user_id', $user_id)->count();
    } else {
        $count = '';
    }

    return view('home.products_by_category', compact('product', 'count', 'category_name'));
}

}
