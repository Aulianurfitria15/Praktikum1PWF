<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-indigo-50 to-white min-h-screen">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl border border-gray-200">
                <div class="p-8 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center justify-between gap-3 mb-8">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('product.index') }}"
                               class="p-2 rounded-full text-indigo-600 hover:text-white hover:bg-indigo-500 transition border border-indigo-100 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <div>
                                <h2 class="text-2xl font-bold text-indigo-700 tracking-tight">Product Detail</h2>
                                <p class="text-sm text-gray-500 mt-0.5">ID: <span class="font-semibold text-indigo-600">#{{ $product->id }}</span></p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @can('update', $product)
                                @php $editUrl = route('product.edit', $product->id); @endphp
                            @else
                                @php $editUrl = null; @endphp
                            @endcan
                            @can('delete', $product)
                                @php $deleteUrl = route('product.delete', $product->id); @endphp
                            @else
                                @php $deleteUrl = null; @endphp
                            @endcan
                            @if($editUrl || $deleteUrl)
                                <x-edit-delete-buttons :edit-url="$editUrl" :delete-url="$deleteUrl" />
                            @endif
                        </div>
                    </div>

                    {{-- Detail Card --}}
                    <div class="rounded-xl border border-gray-100 divide-y divide-gray-100 bg-white shadow-sm">
                        {{-- Name --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Product Name</div>
                            <div class="text-base font-bold text-gray-900">{{ $product->name }}</div>
                        </div>

                        {{-- Quantity --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Quantity</div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-semibold
                                    {{ $product->quantity > 10
                                        ? 'bg-green-100 text-green-800 border border-green-300'
                                        : 'bg-red-100 text-red-800 border border-red-300' }}">
                                    {{ $product->quantity }}
                                    <span class="ml-2 font-normal {{ $product->quantity > 10 ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $product->quantity > 10 ? 'In Stock' : 'Low Stock' }}
                                    </span>
                                </span>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Price</div>
                            <div class="text-base font-mono font-bold text-indigo-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                        {{-- Owner --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Owner</div>
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-base font-bold uppercase shadow">
                                    {{ substr($product->user->name ?? '?', 0, 1) }}
                                </div>
                                <span class="text-base text-gray-900 font-semibold">{{ $product->user->name ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Category</div>
                            <div>
                                @if($product->kategori)
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            {{ $product->kategori->name }}
                                        </span>
                                        <a href="{{ route('category.show', $product->kategori) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                            View category
                                        </a>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                        Uncategorized
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Created At --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Created At</div>
                            <div class="text-sm text-gray-700 font-medium">
                                {{ $product->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                        {{-- Updated At --}}
                        <div class="flex items-start px-6 py-4 gap-4">
                            <div class="w-36 shrink-0 text-xs font-semibold text-gray-500 uppercase tracking-wide pt-1">Updated At</div>
                            <div class="text-sm text-gray-700 font-medium">
                                {{ $product->updated_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>