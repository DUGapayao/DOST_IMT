<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <!-- Include the profile picture upload form -->
                    <form method="post" action="{{ route('profile.update.photo') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('put')
                        <!-- Profile Picture Upload -->
                        @include('profile.partials.profile-picture-upload')
                    </form>

                    <!-- Password update form -->
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        @include('profile.partials.update-password-form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
