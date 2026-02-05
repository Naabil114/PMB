@php
$steps = [
    1 => 'Prodi',
    2 => 'Pendidikan',
    3 => 'Jadwal',
    4 => 'Selesai'
];
@endphp

<div class="mb-4">
    <ul class="nav nav-pills nav-justified">
        @foreach($steps as $num => $label)
            <li class="nav-item">
                <span class="nav-link
                    {{ $currentStep == $num ? 'active' : ($currentStep > $num ? 'bg-success text-white' : 'bg-light') }}">
                    Step {{ $num }}<br>{{ $label }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
