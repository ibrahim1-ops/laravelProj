<!DOCTYPE html>
<html>

<head>
 @include('home.css')

 <style>
  /* Main Container */
  .category-slider-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    text-align: center;
  }
  
  .section-title {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 30px;
    font-weight: 600;
  }
  
  /* Slider Container */
  .category-slider-container {
    position: relative;
    width: 100%;
    padding: 0 40px;
  }
  
  /* Slider Track */
  .category-slider-track {
    display: flex;
    gap: 30px;
    padding: 20px 0;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
  }
  
  .category-slider-track::-webkit-scrollbar {
    display: none;
  }
  
  /* Category Slide */
  .category-slide {
    scroll-snap-align: center;
    flex: 0 0 auto;
    text-align: center;
    text-decoration: none;
    width: 150px;
    transition: transform 0.3s ease;
  }
  
  .category-slide:hover {
    transform: translateY(-5px);
  }
  
  /* Circle Image */
  .circle-image-container {
    width: 120px;
    height: 120px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border: 2px solid #f8f8f8;
    transition: all 0.3s ease;
  }
  
  .circle-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .circle-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    color: #666;
    background: #f5f5f5;
  }
  
  .category-name {
    font-size: 0.95rem;
    color: #444;
    font-weight: 500;
    margin-top: 8px;
  }
  
  /* Hover Effects */
  .category-slide:hover .circle-image-container {
    border-color: #00bcd4;
    box-shadow: 0 6px 20px rgba(0, 155, 238, 0.2);
  }
  
  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .category-slider-container {
      padding: 0 20px;
    }
    
    .category-slide {
      width: 130px;
    }
    
    .circle-image-container {
      width: 100px;
      height: 100px;
    }
  }
  
  @media (max-width: 480px) {
    .category-slide {
      width: 110px;
    }
    
    .circle-image-container {
      width: 80px;
      height: 80px;
    }
    
    .category-name {
      font-size: 0.85rem;
    }
  }
</style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <!-- slider section -->
    @include('home.slider')
    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <div class="category-slider-wrapper">
  <h3 class="section-title">Shop by Category</h3>
  <div class="category-slider-container">
    <div class="category-slider-track">
      @foreach(App\Models\Category::all() as $cat)
        <a href="{{ url('category/' . $cat->category_name) }}" class="category-slide">
          <div class="circle-image-container">
            @if($cat->image)
              <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->category_name }}" class="circle-image">
            @else
              <div class="circle-image-placeholder">
                {{ substr($cat->category_name, 0, 1) }}
              </div>
            @endif
          </div>
          <div class="category-name">{{ $cat->category_name }}</div>
        </a>
      @endforeach
    </div>
  </div>
</div>






  <!-- shop section -->
  @include('home.product')
  <!-- end shop section -->







  <!-- contact section -->



  <!-- end contact section -->

   @include('home.contact')

  <!-- info section -->

@include('home.footer')

  <!-- end info section -->

</body>

</html>