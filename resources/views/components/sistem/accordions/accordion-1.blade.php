<div>
    @foreach ($categories as $category)
         
              <div class="">
                  <p class="text-center font-bold text-purple-900 text-2xl my-4">{{$category->name}}</p>

                  {{-- accordion --}}
                  @foreach ($category->subcategories as $subcategory)
                  <div class="max-w-2xl my-1 mx-auto">
                      <div class="bg-white rounded-xl border-2 border-purple-100">
                          <div class="accordion-header py-2 px-6 cursor-pointer flex items-center justify-between p-3">
                              <span class="font-semibold text-lg">{{$subcategory->name}}</span>
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                              </svg>
                          </div>

                          <div class="accordion-body max-h-0 overflow-hidden transition-all duration-200 ease-out">
                              @foreach ($subcategory->products as $product)
                              <div class="p-4 border-t flex justify-between items-start">
                                  <div>
                                      <p class="text-base font-semibold">{{$product->name}}</p>
                                      <p class="text-sm text-gray-600">{{$product->description}}</p>
                                  </div>
                                  <div>
                                      <p class="font-extrabold text-purple-700">${{ number_format($product->price, 2,",",".") }}</p>
                                  </div>
                              </div>
                              @endforeach

                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
    @endforeach

    <script>
        const accordionHeader = document.querySelectorAll('.accordion-header')
    
        accordionHeader.forEach(accordionHeader => {
            accordionHeader.addEventListener('click', event => {
                accordionHeader.classList.toggle('active')
                const accordionBody = accordionHeader.nextElementSibling
                if(accordionHeader.classList.contains('active')) {
                    accordionBody.style.maxHeight= accordionBody.scrollHeight + "px"
                }else{
                    accordionBody.style.maxHeight = 0
                }
            })
        })
    </script>
    <style>
        .accordion-header.active svg{
            @apply transition ease-in-out duration-300;
            transform: rotate(-90deg); 
        }
    </style>
</div>   