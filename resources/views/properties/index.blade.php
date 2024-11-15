<x-app-layout>
    <!-- Button to Open Modal -->
    <div class="w-[95%] mx-auto">
   

    <div class="container mx-auto mt-4">
        <h2 class="text-2xl font-bold mb-4">Properties List</h2>
    
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex justify-end m-5">
            <button data-modal-target="static-modal" data-modal-toggle="static-modal" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                    type="button">
                Add Property
            </button>
        </div>
        <!-- Table for displaying properties -->
        <table id="example" class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Category ID</th>
                    <th class="px-4 py-2 text-left">Destination ID</th>
                    <th class="px-4 py-2 text-left">Property Name</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">District/City</th>
                    <th class="px-4 py-2 text-left">Address</th>
                    <th class="px-4 py-2 text-left">Latitude/Longitude</th>
                    <th class="px-4 py-2 text-left">Image</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <form action="{{ route('properties.update', $property->property_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">
                                <textarea name="category_id" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->category_id }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="destination_id" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->destination_id }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="property_name" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->property_name }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="description" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->description }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="district-city" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->{'district-city'} }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="address" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->address }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="lat-long" class="resize-none w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">{{ $property->{'lat-long'} }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                @if($property->main_img)
                                    <img src="{{ asset('images/' . $property->main_img) }}" alt="Property Image" class="w-16 h-16 object-cover">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <select name="isactive" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                    <option value="1" {{ $property->isactive ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$property->isactive ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </td>
                            <td class="px-4 py-2">
                                <button type="submit" class="text-blue-600 hover:underline">Save</button> |
                            </td>
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>

   <!-- Main Modal -->
<div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" 
class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full max-h-full">
<div class="relative p-4 w-full max-w-2xl max-h-full">
   <!-- Modal Content -->
   <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
       <!-- Modal Header -->
       <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
           <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add New Property</h3>
           <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" 
                   data-modal-hide="static-modal">
               <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"/>
               </svg>
               <span class="sr-only">Close modal</span>
           </button>
       </div>
       <!-- Modal Body -->
       <div class="p-6 space-y-6">
        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-2">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category ID</label>
                    <input type="number" id="category_id" name="category_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="destination_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Destination ID</label>
                    <input type="number" id="destination_id" name="destination_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="property_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Property Name</label>
                    <input type="text" id="property_name" name="property_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea id="description" name="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white"></textarea>
                </div>
                <div>
                    <label for="district-city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">District/City</label>
                    <input type="text" id="district-city" name="district-city" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <input type="text" id="address" name="address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="lat-long" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Latitude/Longitude</label>
                    <input type="text" id="lat-long" name="lat-long" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="main_img" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" id="main_img" name="main_img" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label for="isactive" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
                    <select id="isactive" name="isactive" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full inline-flex justify-center rounded-lg px-4 py-2 bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Submit
                </button>
            </div>
        </form>
        
       </div>
   </div>
</div>
</div>

</div>
</x-app-layout>
