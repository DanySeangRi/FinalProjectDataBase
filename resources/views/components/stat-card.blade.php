@props([
    'icon' => '',       // raw svg markup
    'iconBg' => '#EEF2FF',
    'iconColor' => '#4F46E5',
    'value' => '0',
    'label' => '',
])

<div class="bg-white rounded-2xl border border-slate-200 p-5 flex flex-col gap-4 hover:shadow-sm transition-shadow">
    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: {{ $iconBg }}; color: {{ $iconColor }}">
        {!! $icon !!}
    </div>
    <div>
        <p class="text-2xl font-bold text-slate-900 leading-none">{{ $value }}</p>
        <p class="text-sm text-slate-400 mt-1.5">{{ $label }}</p>
    </div>
</div>
