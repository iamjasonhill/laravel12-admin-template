<x-layouts.admin title="Email Logs">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Email Logs</h2>
        <p class="text-gray-600 dark:text-gray-400">View and manage all email communications.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Email Logs</h3>
            <div class="flex space-x-2">
                <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Search</button>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Subject</th>
                            <th class="px-4 py-3">Recipient</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Quote Reference</th>
                            <th class="px-4 py-3">Sent At</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750">
                            <td class="px-4 py-3 whitespace-nowrap">1</td>
                            <td class="px-4 py-3">Your Quote Confirmation</td>
                            <td class="px-4 py-3">customer@example.com</td>
                            <td class="px-4 py-3">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">John Smith</a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">MOV-12345</a>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">Apr 17, 2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Delivered
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline mr-2">View</a>
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Resend</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-750">
                            <td class="px-4 py-3 whitespace-nowrap">2</td>
                            <td class="px-4 py-3">Booking Confirmation</td>
                            <td class="px-4 py-3">customer2@example.com</td>
                            <td class="px-4 py-3">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Jane Doe</a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">MOV-12346</a>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">Apr 16, 2025</td>
                            <td class="px-4 py-3">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Delivered
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline mr-2">View</a>
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Resend</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">2</span> of <span class="font-medium">2</span> results
                </div>
                <div class="flex space-x-1">
                    <button class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm disabled:opacity-50">Previous</button>
                    <button class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm disabled:opacity-50">Next</button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
