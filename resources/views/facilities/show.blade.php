<x-app-layout>
    <div class="container w-[90%] mx-auto py-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Property Facility Details</h1>

        <!-- Property Information -->
        <div class="mb-8 p-6 bg-gray-50 shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">Property Name: <span class="text-blue-600">{{ $property->property_name }}</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <p class="text-gray-700"><strong>District/City:</strong> {{ $property->district_city }}</p>
                <p class="text-gray-700"><strong>Address:</strong> {{ $property->address }}</p>
            </div>
        </div>
        <button data-modal-target="static-modal" data-modal-toggle="static-modal" 
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
        type="button">
    Add Property
</button>
        <!-- Facilities Section -->
        @if($property->facilities->isEmpty())
            <p class="text-gray-500 text-center">No facilities found for this property.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($property->facilities as $facility)
                    <div class="bg-white p-6 shadow-lg rounded-lg border border-gray-200 transform hover:scale-105 hover:shadow-xl transition duration-300">
                       
                        <form action="{{ route('facilities.update', $facility->facility_type) }}" method="POST" class="mt-4">

                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label class="block font-medium text-gray-700">Facility Type:</label>
                                <textarea name="facility_type" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $facility->facility_type }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label class="block font-medium text-gray-700">Facility Name:</label>
                                <textarea name="facility_name" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{  $facility->facilty_name }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label class="block font-medium text-gray-700">Value:</label>
                                <textarea name="value" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{  $facility->value }}</textarea>
                            </div>

                           
                            <div class="flex space-x-2 mt-4">
                                <button type="button" onclick="enableEdit(this)"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button type="submit"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 hidden save-button">Save</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>




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
                    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Add New Facility</h2>
                        <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4 grid-cols-1 sm:grid-cols-2">
                                <!-- Property ID -->
                                <div>
                                    <label for="property_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Property ID</label>
                                    <input type="number" id="property_id" name="property_id" required  readonly
                                      value="{{$id}}"  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <!-- Facility Type -->
                                <div>
                                    <label for="facility_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facility Type</label>
                                    <input type="text" id="facility_type" name="facility_type" required
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <!-- Facility Name -->
                                <div>
                                    <label for="facility_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facility Name</label>
                                    <input type="text" id="facility_name" name="facility_name" required
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <!-- Value -->
                                <div>
                                    <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Value</label>
                                    <input type="text" id="value" name="value" required
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <!-- Image -->
                                <div>
                                    <label for="img" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                    <input type="file" id="img" name="img"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <!-- Active -->
                                <div>
                                    <label for="isactive" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
                                    <select id="isactive" name="isactive" required
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <!-- Serial No -->
                                <div>
                                    <label for="serialno" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Serial No</label>
                                    <input type="text" id="serialno" name="serialno"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white">
                                </div>
                            </div>
                    
                            <div class="mt-6 flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Add Facility
                                </button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
</x-app-layout>

<script>
    function enableEdit(button) {
        const form = button.closest('form'); // Select the closest form element
        form.querySelectorAll('textarea').forEach(textarea => textarea.disabled = false); // Enable all textarea fields
        form.querySelectorAll('input').forEach(input => input.disabled = false); // Enable all input fields (if any)
        button.classList.add('hidden'); // Hide the Edit button
        form.querySelector('.save-button').classList.remove('hidden'); // Show the Save button
    }
</script>
