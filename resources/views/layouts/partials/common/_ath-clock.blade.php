<div id="clock" class="bg-light text-dark p-2 text-center">
    @php
        $clock = new \App\Helpers\ATH\ATHDateTime();
    @endphp
    {{ $clock->format('Y, l d/m G:i:s') }}
</div>

{{-- <script>
    $(document).ready(function() {
        setInterval(function() {
            $("#clock").load("#clock");
        }, 1000);
    });
</script> --}}