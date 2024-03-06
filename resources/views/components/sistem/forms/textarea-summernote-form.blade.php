@props(['disabled' => false])

<div wire:ignore>
    <textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
    resize-none 
    block w-full 
    text-sm form-input text-gray-900  bg-white rounded-lg shadow-md
    my-1 p-2 

    focus:outline-none 
    focus:shadow-outline-primary
    focus:border-primary-400
    focus:ring 
    focus:ring-primary-950 
    focus:ring-offset-0
    ']) !!} cols="30" rows="10"></textarea>
</div>

@push('scripts')
  <script>
    // document.addEventListener('livewire:load', () => {
      // Runs after Livewire is loaded but before it's initialized
      // on the page...
      $('#summernote-description').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callback: {
            onChange: function(contents, $editable) {
                cibsike.log('onChange:', contentes, $editable);
            }
        }
      });
    // })
  </script>
@endpush