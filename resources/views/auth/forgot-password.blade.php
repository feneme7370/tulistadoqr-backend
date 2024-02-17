<x-guest-layout>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div
          class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
        >
          <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
              <img
                aria-hidden="true"
                class="object-cover w-full h-full dark:hidden"
                src="{{asset('archives/sistem/img/image_forgot.jpg')}}"
                alt="Office"
              />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
              <div class="w-full">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h1
                    class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
                    >
                    Olvidaste tu clave?
                    </h1>

                    {{-- <x-sistem.forms.validation-errors class="mb-4" />

                    <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
                    <x-sistem.forms.input-form id="email" type="email" placeholder="{{ __('Email') }}" :value="old('email')" name="email" wire:model="email"
                    autofocus /> --}}
    
                    <!-- You should  use a button here, as the anchor is only used for the example  -->

                
                    {{-- <x-sistem.buttons.primary-btn type="submit" class="w-full mt-4" wire:loading.attr="disabled" title="Recuperar"/>       --}}
                    <a href="https://api.whatsapp.com/send/?phone=5492396513953&amp;text=Quiero recuperar mi cuenta" target="_blank" class="flex items-center justify-center gap-1
                    px-2 py-1 text-sm font-medium text-white rounded-lg
                    
                    transition-colors duration-150 
                    
                    bg-purple-700 
                    
                    border border-transparent  
                    
                    active:bg-purple-800 
                    
                    hover:bg-purple-800 
                    
                    focus:border-purple-300 
                    focus:outline-none  
                    focus:shadow-outline-purple 
                    focus:ring 
                    focus:ring-purple-700 
                    focus:ring-offset-0">Recuperar</a>

                </form>

                <hr class="my-8" />

                <p class="mt-1">
                    <a
                      class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                      href="{{route('login')}}"
                    >
                      Iniciar sesion
                    </a>
                  </p>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-guest-layout>
