@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white rounded-2xl shadow-lg p-6">
    
    <!-- Product Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4 border-b pb-2">
        {{ $product->name }}
    </h1>

    <!-- Product Image -->
    @if($product->image)
        <div class="flex justify-center mb-6">
            <img src="{{ asset('storage/'.$product->image) }}" 
                 alt="Product Image" 
                 class="w-72 h-72 object-cover rounded-xl shadow-md">
        </div>
    @endif

    <!-- Product Price -->
    <p class="text-lg font-semibold text-green-600 mb-3">
        Price: ₦{{ number_format($product->price, 2) }}
    </p>

    <!-- Product Description -->
    <p class="text-gray-700 leading-relaxed mb-6">
        {{ $product->description }}
    </p>

    <!-- Back Button -->
    <div class="flex justify-end">
        <a href="{{ route('products.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
            ← Back to Products
        </a>
    </div>
</div>
@endsection
