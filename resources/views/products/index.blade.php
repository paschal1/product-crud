@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Product Management</h1>
        <a href="{{ route('products.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow-md transition">
           + Add Product
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Product Table --}}
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wider">
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-left">Image</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4 font-medium text-gray-800">{{ $product->name }}</td>
                    <td class="p-4 text-gray-600">
                        ₦{{ number_format($product->price, 2) }}
                    </td>
                    <td class="p-4">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 alt="Product Image" 
                                 class="w-16 h-16 object-cover rounded-md shadow-sm">
                        @else
                            <span class="text-gray-400 italic">No Image</span>
                        @endif
                    </td>
                    <td class="p-4 text-center space-x-3">
                        <a href="{{ route('products.show', $product) }}" 
                           class="text-blue-600 hover:underline font-medium">View</a>
                        <a href="{{ route('products.edit', $product) }}" 
                           class="text-yellow-600 hover:underline font-medium">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:underline font-medium"
                                    onclick="return confirm('Delete this product?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">No products available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        <div class="flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
