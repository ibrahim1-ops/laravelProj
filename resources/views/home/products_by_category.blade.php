<!DOCTYPE html>
<html>

<head>
  @include('home.css')
</head>

<body>
  <div class="hero_area">
    @include('home.header')
  </div>

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Products in "{{ $category_name }}"
        </h2>
      </div>
      <div class="row">
        @if(count($product) > 0)
          @foreach($product as $prod)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
              <div class="img-box">
                <img src="/products/{{$prod->image}}" alt="{{$prod->title}}">
              </div>
              <div class="detail-box">
                <h6>{{$prod->title}}</h6>
                <h6>Price <span>${{$prod->price}}</span></h6>
              </div>
              <div style="padding: 15px">
                <a class="btn btn-danger" href="{{url('product_details', $prod->id)}}">Details</a>
                <a class="btn btn-primary" href="{{url('add_cart', $prod->id)}}">Add to Cart</a>
              </div>
            </div>
          </div>
          @endforeach
        @else
          <div class="col-12 text-center">
            <p>No products found in this category.</p>
          </div>
        @endif
      </div>
    </div>
  </section>

  @include('home.footer')
</body>

</html>