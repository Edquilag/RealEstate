<nav x-data="{ open: false }" class="bg-white border-b border-black shadow-sm">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="flex justify-between h-16">


<div class="flex">


<div class="shrink-0 flex items-center">

<a href="{{ Auth::check() ? route('dashboard') : url('/') }}">

<x-application-logo class="block h-9 w-auto fill-current text-black" />

</a>

</div>



@if(Auth::check())

@php
$isDashboardActive = request()->routeIs('dashboard');

$isBrokerSectionActive =
request()->routeIs('broker.properties.*')
|| request()->routeIs('broker.inquiries.*');

$isClientSectionActive =
request()->routeIs('properties.*')
|| request()->routeIs('inquiries.*');
@endphp



<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">


<x-nav-link 
:href="route('dashboard')" 
:active="$isDashboardActive">

Dashboard

</x-nav-link>



@if(Auth::user()->role === 'broker')


<x-nav-link 
:href="url('/broker')"
:active="request()->is('broker')">

Broker

</x-nav-link>


<x-nav-link 
:href="route('broker.properties.index')"
:active="request()->routeIs('broker.properties.*')">

My Properties

</x-nav-link>



<x-nav-link 
:href="route('broker.inquiries.index')"
:active="request()->routeIs('broker.inquiries.*')">

My Inquiries

</x-nav-link>

<x-nav-link 
:href="route('broker.conversations.index')"
:active="request()->routeIs('broker.conversations.*')">

Messages

</x-nav-link>



@elseif(Auth::user()->role === 'client')


<x-nav-link 
:href="url('/client')"
:active="request()->is('client')">

Client

</x-nav-link>



<x-nav-link 
:href="route('properties.index')"
:active="request()->routeIs('properties.*')">

Browse Properties

</x-nav-link>

<x-nav-link 
:href="route('conversations.index')"
:active="request()->routeIs('conversations.*')">

Messages

</x-nav-link>


@endif


</div>


@endif


</div>



@if(Auth::check())


<div class="hidden sm:flex sm:items-center sm:ms-6">


<x-dropdown align="right" width="48">


<x-slot name="trigger">


<button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-black hover:bg-gray-100">


<div>

{{ Auth::user()->name }}

<small>
({{ Auth::user()->role }})
</small>


</div>


</button>


</x-slot>



<x-slot name="content">


<x-dropdown-link :href="route('profile.edit')">

Profile

</x-dropdown-link>



<form method="POST" action="{{ route('logout') }}">

@csrf


<x-dropdown-link 
:href="route('logout')"
onclick="event.preventDefault(); this.closest('form').submit();">

Log Out

</x-dropdown-link>


</form>


</x-slot>


</x-dropdown>


</div>


@else


<div class="hidden sm:flex sm:items-center">


<a href="{{ route('login') }}"
class="px-4 py-2">

Login

</a>


<a href="{{ route('register') }}"
class="px-4 py-2">

Register

</a>


</div>


@endif



</div>


</div>


</nav>