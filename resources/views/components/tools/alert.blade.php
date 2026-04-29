@props(['type' => null])
<div class="notifications">
    <div class="notify {{ $type }}">
        {!!  $type == 'Success' ? '<i class="fa-solid fa-circle-check"></i>' : '' !!}
        <div class="content">
            <div class="title">{{ $type }}</div>
            <span>{{ $slot }}</span>
        </div>
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>


@push('external_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function (e) {
            setTimeout(function () {
                document.querySelector('.notifications').style.display = 'none' ;
            }, 3000);
        })
    </script>
@endpush