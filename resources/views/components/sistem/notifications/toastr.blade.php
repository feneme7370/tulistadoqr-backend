@props(['title' => '', 'messageSuccess' => '', 'messageError' => ''])

@if(session()->has('messageSuccess'))
    <script>
        toastr.options = {
            "closeButton" : true,
            "progressBar" : true,
            "timeOut" : 2000,
        }
        toastr.success("{{$messageSuccess}}", "{{$title}}");
    </script>
@endif
@if(session()->has('messageError'))
    <script>
        toastr.options = {
            "closeButton" : true,
            "progressBar" : true,
            "timeOut" : 2000,
        }
        toastr.error("{{$messageError}}", "{{$title}}");
    </script>
@endif