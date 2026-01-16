 @forelse($products as $product)
     <div class="col-sm-4">
         <div class="product-image-wrapper" data-id="{{ $product->id }}">
             <div class="single-products">
                 <div class="productinfo text-center">
                     {{-- Image --}}
                     <img src="{{ asset('storage/products/full/' . $product->images->first()->image) }}"
                         style="height: 320px" alt="Product Image..." />

                     {{-- Price --}}
                     <h2>$ {{ $product->price }}</h2>

                     {{-- Name --}}
                     <p>{{ $product->name }}</p>

                     <a href="#" class="btn btn-default add-to-cart">
                         <i class="fa fa-shopping-cart"></i> Add to cart</a>
                 </div>

                 <a href="{{ route('products.show', $product->id) }}">
                     <div class="product-overlay">
                         <div class="overlay-content">
                             <h2>$ {{ $product->price }}</h2>
                             <p>{{ $product->name }}</p>
                             <a href="#" class="btn btn-default add-to-cart"><i
                                     class="fa fa-shopping-cart"></i>Add to cart</a>
                         </div>
                     </div>
                 </a>
             </div>
             <div class="choose">
                 <ul class="nav nav-pills nav-justified">
                     <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a>
                     </li>
                     <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                 </ul>
             </div>
         </div>
     </div>
 @empty
     <h3 class="text-center col-12">
         Not found product
     </h3>
 @endforelse
