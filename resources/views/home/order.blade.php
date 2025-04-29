<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @include('home.css')

    <style type="text/css">
    .div_center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
        font-family: Arial, sans-serif;
    }

    th, td {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f8f8f8;
        font-weight: bold;
        color: #333;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    td img {
        width: 80px;
        height: auto;
        border-radius: 5px;
    }
</style>


</head>
<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->


        <div class="div_center">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                </tr>


                @foreach($order as $order)
                <tr>
                    <td>{{$order->product->title}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        <img src="/products/{{$order->product->image}}" style="height: 100px; width: 100px">
                    </td>
                </tr>

                @endforeach

            </table>
        </div>




    </div>




    @include('home.footer')
</body>
</html>