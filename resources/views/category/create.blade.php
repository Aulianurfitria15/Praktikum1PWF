<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center gap-4 mb-8">
                        <a href="{{ route('category.index') }}" 
                           class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Add Category</h2>
                            <p class="text-sm text-gray-500 mt-0.5">Fill in the details to add a new category</p>
                        </div>
                    </div>

                    {{-- Alert Messages --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-700 font-semibold mb-2">Error validasi:</p>
                            <ul class="text-red-600 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('category.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Category Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Category Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                placeholder="e.g. Electronic"
                                class="w-full px-4 py-2.5 rounded-lg border text-sm 
                                {{ $errors->has('name') ? 'border-red-600 bg-red-50' : 'border-gray-300 bg-white' }} 
                                text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                required
                            >
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex gap-3 pt-2">
                            <button 
                                type="submit" 
                                class="flex-1 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-black font-semibold rounded-lg transition"
                            >
                                Save Category
                            </button>
                            <a 
                                href="{{ route('category.index') }}" 
                                class="flex-1 px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-black font-semibold rounded-lg transition text-center"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
