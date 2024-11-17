<x-app-layout>
    <div class="container w-[95%] mx-auto">
        <h1 class="text-2xl font-bold mb-4">Property Details</h1>
        <div class="border p-4 mb-6">
            <p class="text-xl"><strong>Name:</strong> {{ $property->property_name }}</p>
            <p><strong>ID:</strong> {{ $property->property_id }}</p>
        </div>
        <div class="float-right mr-36">
            <!-- Button to Open Modal for Adding Summaries -->
            <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                class="block mb-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Add Summary
            </button>
        </div>
        <!-- Flowbite Modal for Adding Summaries -->
        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Property Summary
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form action="{{ route('property-summary.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property_id }}">
                        <div class="p-4 md:p-5 space-y-4">
                            <!-- Dynamically Added Rows -->
                            <div id="summaryFields">
                                <div class="summaryRow grid grid-cols-3 gap-4 mb-4">
                                    <div class="form-group">
                                        <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                                        <input type="text" name="value[]"
                                            class="form-control mt-1 p-2 border border-gray-300 rounded-md w-full"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                        <input type="file" name="image[]"
                                            class="form-control mt-1 p-2 rounded-md w-full">
                                    </div>

                                    <div class="form-group">
                                        <label for="display" class="block text-sm font-medium text-gray-700">Display</label>
                                        <select name="display[]"
                                            class="form-control mt-1 p-2 border border-gray-300 rounded-md w-full"
                                            required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Add More Button -->
                            <button type="button" id="addMoreBtn"
                                class="text-white bg-green-500 px-4 py-2 rounded-md hover:bg-green-600 mt-4">
                                Add More
                            </button>
                            <!-- Remove Row Button -->
                            <button type="button" id="removeRowBtn"
                                class="text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600 mt-4">
                                Remove Last Row
                            </button>
                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-50 focus:outline-none bg-blue-500 rounded-lg border border-gray-200 hover:bg-blue-600 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 w-full sm:w-auto"
                                data-modal-hide="static-modal">
                                Save Summaries
                            </button>
                            <button type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 w-full sm:w-auto"
                                data-modal-hide="static-modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table to Show Existing Summaries -->
        <div class="w-[90%] mt-12 mx-auto">
            <table id="example" class="table-auto w-full mt-6 border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Value</th>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Display</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($summaries as $summary)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $summary->value }}</td>
                            <td class="px-4 py-2 border">{{ $summary->image }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($summary->display) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Add More Button functionality for adding new rows
        const addMoreBtn = document.getElementById('addMoreBtn');
        const removeRowBtn = document.getElementById('removeRowBtn');
        const summaryFields = document.getElementById('summaryFields');

        addMoreBtn.addEventListener('click', () => {
            const newSummaryRow = document.querySelector('.summaryRow').cloneNode(true);

            // Clear input values in the cloned row
            newSummaryRow.querySelectorAll('input, select').forEach(input => input.value = '');

            summaryFields.appendChild(newSummaryRow);
        });

        removeRowBtn.addEventListener('click', () => {
            const rows = document.querySelectorAll('.summaryRow');
            if (rows.length > 1) {
                rows[rows.length - 1].remove();
            } else {
                alert('At least one row must remain!');
            }
        });
    </script>
</x-app-layout>
