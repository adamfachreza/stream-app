@extends('member.layouts.base')

@section('title', 'Setting')

{{-- @section('title-description', 'Our selected movies for your mood'); --}}

@section('content')

<form method="POST" action="{{ route('member.update', $user->id) }}">
    @csrf
    @method('PUT')
     {{-- Alert Here --}}
     @if ($errors->any())
     <div class="alert alert-danger text-base text-white">
       <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
       </ul>
     </div>
   @endif
<!-- Benefits -->
<div class="flex flex-col gap-6 font-medium text-base text-white mt-[10px] px-[18px]">
    <label for="name">Your Name</label>
    <div class="flex gap-4 items-center">
        <input type="text"
                id="name"
                name="name"
                value="{{ $user->name }}"
                class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline outline-stream-gray outline-1 text-base focus:outline-indigo-600 input-stream"
                placeholder="Your name" />
            @error('name')
                <div style="color: red">{{ $message }}</div>
            @enderror
    </div>
</div>

<div class="flex flex-col gap-6 font-medium text-base text-white mt-[10px] px-[18px]">
    <label for="name">Phone Number</label>
    <div class="flex gap-4 items-center">
        <input type="text"
                id="phone_number"
                name="phone_number"
                value="{{ $user->phone_number }}"
                class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline outline-stream-gray outline-1 text-base focus:outline-indigo-600 input-stream"
                placeholder="Phone Number" />
            @error('phone_number')
                <div style="color: red">{{ $message }}</div>
            @enderror
    </div>
</div>

<div class="flex flex-col gap-6 font-medium text-base text-white mt-[10px] px-[18px]">
    <label for="name">Password</label>
    <div class="flex gap-4 items-center">
        <input type="password"
                id="password"
                name="password"
                value="{{ old('password') }}"
                class="rounded-full py-3 pr-3 pl-6 text-stream-dark placeholder:text-stream-gray placeholder:font-normal font-medium outline outline-stream-gray outline-1 text-base focus:outline-indigo-600 input-stream"
                placeholder="Password" />
            @error('password')
                <div style="color: red">{{ $message }}</div>
            @enderror
    </div>
</div>

{{-- <div class="flex flex-col gap-6 font-medium text-base text-white mt-[10px] px-[18px]">
    <label for="avatar">Avatar</label>
    <div class="flex gap-4 items-center">
        <input type="file" name="avatar">
        @if ($user->avatar)
          <br>
          <img src="{{ asset('storage/avatar/'.$user->avatar) }}" height="150" >
        @endif
    </div>
</div> --}}
<button
type="submit"
class="py-[13px] px-[58px] bg-[#5138ED] rounded-full text-center  mt-[40px] px-[18px]">
<span class="text-white font-semibold text-base">
    Update
</span>
</button>
<!-- /Benefits -->
</form>



@endsection
