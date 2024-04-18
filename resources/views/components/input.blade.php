@vite('resources/css/form.css')

<div {{ $class }} >
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value}}" {{ $attributes }} default="">
</div>