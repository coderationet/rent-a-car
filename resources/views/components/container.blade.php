@props(['class' => '$class'])
<div {{ $attributes->merge(['class' => 'container mx-auto ' . $class]) }}>
    {{ $slot }}
</div>
