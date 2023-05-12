@extends('member.layouts.base')

@section('title', 'Watch Today')

@section('title-description', 'Our selected movies for your mood');

@section('content')

<!-- Stop Subscribe -->
<div class="rounded-2xl bg-[#19152E] p-[30px] w-max">
    <div class="text-xl text-white font-semibold">
        Free 1 Week
    </div>
    <p class="text-base text-white leading-[30px] max-w-[500px] mt-3 mb-[30px]">
        If you wish to stop subscribe our movies please continue
        by clicking the button below. Make sure that you have read our
        terms & conditions beforehand.
    </p>
    <a href="#" class="px-8 py-3 mt-3 text-center bg-indigo-600 rounded-3xl lg:mt-0">
        <span class="font-semibold text-white text-base justify-center items-center">Take it</span>
    </a>
</div>
<!-- /Stop Subscribe -->


@endsection
