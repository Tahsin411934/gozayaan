<x-app-layout>
    <!-- Button to Open Modal -->
    <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block mb-44 float-right mt-10 mr-16 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add Property Image
    </button>

    <!-- Existing Property Images Section outside of Modal -->
    <div class="mt-28">
        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Existing Property Images</h3>
        <div class="grid grid-cols-3 gap-6">
            @if($propertyImages->isNotEmpty())
                @foreach($propertyImages as $image)
                    <div class="relative group">
                        <!-- Image Display -->
                        <div class="relative overflow-hidden rounded-lg shadow-lg hover:scale-105 transform transition-all duration-300">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Property Image" class="w-full h-40 object-cover">
                            <div class="absolute top-0 left-0 bg-gradient-to-t from-black to-transparent text-white p-2 text-xs font-semibold">{{
                                $image->caption }}</div>
                        </div>
                        <!-- Delete Button -->
                        <form action="{{ route('property_images.destroy', $image->image_id) }}" method="POST" class="absolute top-2 right-2 group-hover:block hidden">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-600 rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">No images found for this property.</p>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add Property Image</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="max-w-2xl mx-auto mt-8 shadow-xl bg-white p-10">
                    <form action="{{ route('property_images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="property_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Property ID</label>
                            <input type="number" id="property_id" name="property_id" value="{{ old('property_id', $property_id) }}" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                            @error('property_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input type="file" id="path" name="path" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                            @error('path')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="caption" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Caption</label>
                            <input type="text" id="caption" name="caption" value="{{ old('caption') }}" 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                            @error('caption')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Add Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    @if (session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        })
    @endif
</script>
