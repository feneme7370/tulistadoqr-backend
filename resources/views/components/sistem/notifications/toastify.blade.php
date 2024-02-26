@props(['title' => '', 'messageSuccess' => '', 'toastifyError' => ''])

{{-- @if(session()->has('messageSuccess'))
    <script>
        toastr.options = {
            "closeButton" : true,
            "progressBar" : true,
            "timeOut" : 2000,
        }
        toastr.success("{{$messageSuccess}}", "{{$title}}");
    </script>
@endif --}}
@if(session()->has('toastifyError'))
    <script>
        Livewire.on('toastifyError', () => {
        Toastify({
            text: 'error',
            duration: 4000,
            // destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
            background: "#990000",
            color: "#FFE5E5",
            },
            onClick: function(){} // Callback after click
        }).showToast();
        })
    </script>
@endif