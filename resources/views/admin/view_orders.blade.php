<!DOCTYPE html>
<html>
  <head> 
 @include('admin.css')

 <style>
    .table_center {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 0;
    }

    table {
        border-collapse: collapse;
        width: 90%;
        max-width: 1100px;
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        transition: box-shadow 0.3s ease-in-out;
        text-align: center; /* Center all content */
    }

    th {
        background-color: #2f3542;
        color: #ffffff;
        font-weight: 600;
        padding: 16px;
        font-size: 16px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #444;
    }

    td {
        padding: 14px 16px;
        border-bottom: 1px solid #e6e6e6;
        font-size: 15px;
        color: #333;
        transition: background-color 0.2s ease-in-out;
    }

    tr:hover td {
        background-color: #f5f5f5;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }

    tr:last-child td {
        border-bottom: none;
    }

    table:hover {
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.18);
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
        
        <div class="table_center">

        <table>
            <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Status</th>
                <th>Change Status</th>
                <th>Print PDF</th>
            </tr>
            @foreach($data as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->rec_address}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->product->title}}</td>
                <td>{{$data->product->price}}</td>
                <td>
                    <img src="products/{{$data->product->image}}" style="height: 100px; width: 100px">
                </td>
                
                <td>
                    @if($data->status == 'pending')
                    <span style="color: red">{{$data->status}}</span>
                    @elseif($data->status == 'On The Way')
                    <span style="color: blue">{{$data->status}}</span>
                    @else
                    <span style="color: green">{{$data->status}}</span>
                    @endif
                </td>

                <td>
                 <a class="btn btn-primary" href="{{ url('on_the_way/' . $data->id) }}">On the Way</a>
                 <a class="btn btn-success" href="{{ url('delivered/' . $data->id) }}">Delivered</a>
                </td>

                <td>
                    <a class="btn btn-secondary" href="{{ url('print_pdf/' . $data->id) }}">Print PDF</a>
                </td>


                </tr>
            @endforeach
        </table>

    </div>

        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
   
   <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>