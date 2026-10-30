@php
    use Illuminate\Contracts\Support\Htmlable;
    use Illuminate\Support\Arr;

    $brandName = 'ZenyDesk ERP';
    $brandLogo = asset('images/zenydesk-erp-logo.png') . '?v=' . filemtime(public_path('images/zenydesk-erp-logo.png'));
    $brandLogoHeight = filament()->getBrandLogoHeight() ?? '2.4rem';
@endphp

<div {{ $attributes->class(['fi-logo flex items-center']) }}>
    <img
        alt="{{ $brandName }}"
        src="{{ $brandLogo }}"
        class="h-8 sm:h-9 w-auto object-contain transition duration-200 hover:opacity-90"
        style="height: {{ $brandLogoHeight }}; max-height: 2.8rem;"
    />
</div>
