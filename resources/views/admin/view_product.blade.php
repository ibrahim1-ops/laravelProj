<!DOCTYPE html>
<html>
  <head> 
 @include('admin.css')


 <style type="text/css">
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
    }

    .table_deg {
        width: 90%;
        max-width: 1100px;
        border-collapse: separate;
        border-spacing: 0;
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08); /* Table shadow */
    }

    th {
        background-color: #1e90ff;
        color: #ffffff;
        padding: 18px;
        text-align: left;
        font-size: 18px;
    }

    td {
        padding: 16px;
        font-size: 16px;
        color: #333;
        border-top: 1px solid #e0e0e0;
        background-color: white;
        transition: box-shadow 0.3s ease;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }

    tr:hover td {
        background-color: #f1f7ff;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05),
                    0 2px 8px rgba(0, 0, 0, 0.07); /* Row hover shadow */
        cursor: default;
    }

    td img {
        max-width: 100px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15); /* Image shadow */
    }
    input[type="search"] 
    {
        width: 500px;
        height: 60px;
        margin-left: 50px;
    }
</style>

   

    
  </head>
  <body>
    
    @include('admin.header')

    @include('admin.sidebar')

      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


          <form action="{{url('product_search')}}" method="get">
            @csrf
            <input type="search" name="search" placeholder="Search">
            <input type="submit" class="btn btn-secondary" value="Search">
          </form>

          <div class="div_deg">
            <table class="table_deg">
                <tr>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                    @foreach($product as $products)
                <tr>
                    <td>{{$products->title}}</td>
                    <td>{!!Str::limit($products->description, 50, '...')!!}</td>
                    <td>{{$products->category}}</td>
                    <td>{{$products->price}}</td>
                    <td>{{$products->quantity}}</td>
                    <td>
                        <img src="products/{{$products->image}}" alt="Product Image">
                    </td>
                    <td><a class="btn btn-success" href="{{url('update_product', $products->id)}}">Update</a></td>
                    <td>
                        <a class="btn btn-danger" onClick="confirmation(event)" href="{{url('delete_product', $products->id)}}">Delete</a>
                    </td>
                </tr>
                    @endforeach
            </table>
          </div>

          <div class="div_deg">
          {{$product->onEachSide(1)->links()}}
          </div>

        


        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>