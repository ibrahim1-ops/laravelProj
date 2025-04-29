<!DOCTYPE html>
<html>

<head>
<style type="text/css">
  .div_deg {
    padding: 30px;
    margin: 50px auto;
    max-width: 800px;
    background-color: #f9f9f9;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }

  .div_deg table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
  }

  .div_deg th,
  .div_deg td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  .div_deg th {
    background-color: #4CAF50;
    color: white;
  }

  .div_deg tr:hover {
    background-color: #f1f1f1;
  }
  .cart_value {
    margin: 30px auto;
    max-width: 800px;
    padding: 20px;
    background-color: #ffffff;
    border: 2px solid #4CAF50;
    border-radius: 10px;
    text-align: center;
    font-family: 'Arial', sans-serif;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .cart_value h3 {
    margin: 0;
    font-size: 24px;
    color: #4CAF50;
  }
  .order_deg {
  max-width: 500px;
  margin: 50px auto;
  padding: 30px;
  border: 1px solid #ddd;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  background-color: #fff;
  font-family: Arial, sans-serif;
}

.order_deg form div {
  margin-bottom: 20px;
}

.order_deg label {
  display: block;
  font-weight: bold;
  margin-bottom: 8px;
  color: #333;
}

.order_deg input[type="text"],
.order_deg textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 16px;
}

.order_deg textarea {
  resize: vertical;
  min-height: 80px;
}

.order_deg .btn {
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 6px;
  cursor: pointer;
  border: none;
}

.order_deg .btn-primary {
  background-color: #007bff;
  color: white;
}

.order_deg .btn-primary:hover {
  background-color: #0056b3;
}

</style>


  @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
  </div>

  


    <div class="div_deg">


      




  <table>

      <tr>
        <th>Product Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Remove</th>
      </tr>

      <?php

        $value = 0;

      ?>

      @foreach($cart as $cart)

      <tr>
          <td>{{$cart->product->title}}</td>
          <td>{{$cart->product->price}}</td>
          <td>
            <img src="/products/{{$cart->product->image}}" style="height: 100px; width: 100px">
        </td>
        <td>
        <a class="btn btn-danger" href="{{url('delete_cart/'.$cart->id)}}">Remove</a>
        </td>
      </tr>


      <?php

      $value = $value + $cart->product->price;  
    
      ?>

      @endforeach

  </table>

     </div>

     <div class="cart_value">
        <h3>Total value of cart is: ${{$value}}</h3>
     </div>

     <div class="order_deg">
        <form action="{{url('confirm_order')}}" method="post">
          @csrf
           <div>
            <label for="">Reciver Name</label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
           </div>  
           
           <div>
            <label for="">Reciver Address</label>
            <textarea name="address">{{Auth::user()->address}}</textarea>
           </div>    

           <div>
            <label for="">Reciver Phone</label>
            <input type="text" name="phone" value="{{Auth::user()->phone}}">
           </div>    

           <div>
            <input class="btn btn-primary" type="submit" value="Cash On Delivery">
           </div>    

           <a class="btn btn-success" href="{{url('stripe',$value)}}">Pay Using Card</a>

        </form>
      </div>


  <!-- info section -->
  @include('home.footer')
  <!-- end info section -->
</body>

</html>
