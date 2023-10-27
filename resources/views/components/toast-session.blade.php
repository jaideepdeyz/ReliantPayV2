<script src="{{ asset('auth/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
@if (Session::has('message'))
    <script>
        $.toast({
            heading: '{{ Session::get('message.heading') }}',
            text: '{{ Session::get('message.text') }}',
            showHideTransition: 'slide',
            icon: '{{ Session::get('message.heading') }}',
            position: 'top-right'
        })
    </script>
@endif
