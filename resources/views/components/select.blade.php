@props(['disabled' => false, 'default' => 'All', 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-800 focus:ring-blue-800 disabled:opacity-50 disabled:pointer-events-none',
]) !!}>
    <option value="0" selected>
        {{ $default }}
    </option>

    @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>
