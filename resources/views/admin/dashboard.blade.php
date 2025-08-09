<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as Admin!") }}
                </div>

                <!-- Complaint Status Button -->
                <div class="mt-4">
                    <a href="{{ route('admin.complaints') }}" 
                       class="btn btn-primary px-4 py-2 shadow-sm"
                       style="font-size: 1rem; font-weight: bold;">
                        📋 View & Update Complaint Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
