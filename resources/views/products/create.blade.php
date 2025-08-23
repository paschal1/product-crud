@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">➕ Add New Product</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Product Name --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-3 shadow-sm">
            @error('name') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Price --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Price (₦)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-3 shadow-sm">
            @error('price') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Image --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Product Image</label>
            <input type="file" name="image"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-3 shadow-sm">
            @error('image') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4"
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-3 shadow-sm">{{ old('description') }}</textarea>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('products.index') }}" 
               class="text-gray-600 hover:text-gray-900 transition">← Cancel</a>

            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                💾 Save Product
            </button>
        </div>
    </form>
</div>
@endsection
