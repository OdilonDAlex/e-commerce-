@vite('resources/css/form.css')

<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value}}">
</div>