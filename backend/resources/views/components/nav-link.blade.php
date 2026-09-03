@props(['active'])


@php

$classes = ($active ?? false)

? 'inline-flex items-center px-1 pt-1 border-b-2 border-black text-sm font-medium text-black'

: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-black hover:border-gray-300';

@endphp



<a {{ $attributes->merge(['class'=>$classes]) }}>

{{ $slot }}

</a>