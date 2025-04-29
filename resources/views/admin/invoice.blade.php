<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Invoice</h1>

    <center>

    <h3>Customer Name: {{ $data->name }}</h3>

    <h3>Customer Address: {{ $data->rec_address }}</h3>

    <h3>Customer Phones: {{ $data->phone }}</h3>

    <h2>Product Title: {{ $data->product->title }}</h2>

    <h2>Price: {{ $data->product->price }}</h2>

    <img src="{{ $imageSrc }}" alt="Product Image" width="200">



    </center>

</body>
</html>