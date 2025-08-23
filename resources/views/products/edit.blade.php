@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">✏️ Edit Product</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" 
                value="{{ old('name', $product->name) }}" 
                class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">
            @error('name') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Price (₦)</label>
            <input type="number" step="0.01" name="price" 
                value="{{ old('price', $product->price) }}" 
                class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">
            @error('price') 
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Product Image</label>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" 
                     alt="Product Image" 
                     class="mb-3 w-24 h-24 object-cover rounded-lg border">
            @endif
            <input type="file" name="image" 
                class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="4" 
                class="mt-1 w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                Update Product
            </button>
            <a href="{{ route('products.index') }}" 
               class="text-gray-600 hover:text-gray-800 font-medium transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
