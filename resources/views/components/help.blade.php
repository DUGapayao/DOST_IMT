<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('css/layout-app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/terms-privacy.css') }}">
        <link rel="stylesheet" href="{{ asset('css/help.css') }}">

        <script defer src="{{ asset('js/app.js') }}"></script>

        @stack('style')
    </head>
    <body>
        @include('layouts.navigation-draft')


        <div class="main-container">
            @include('layouts.help-sidebar')

            <div id="main-content-id" class="main-content">
                @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif


                {{ $slot }}
            </div>
        </div>

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
    </body>

    @stack('script')

    <script>
        // FAQs Dropdown
        const faqsDropdown = document.getElementById('faqs-dropdown');
        const faqsContent = document.getElementById('faqs-content');
        const isFaqsDropdownOpen = @json(session('faqs_dropdown_open', false));
    
        if (isFaqsDropdownOpen) {
            faqsContent.style.display = 'block';
        }
    
        faqsDropdown.addEventListener('click', function() {
            const isCurrentlyOpen = faqsContent.style.display === 'block';
            faqsContent.style.display = isCurrentlyOpen ? 'none' : 'block';
    
            fetch('{{ route('store.faqs.dropdown.state') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ open: !isCurrentlyOpen })
            });
        });
    
        // Online Help Dropdown
        const helpDropdown = document.getElementById('online-help-dropdown');
        const helpContent = document.getElementById('online-help-content');
        const isHelpDropdownOpen = @json(session('help_dropdown_open', false));
    
        if (isHelpDropdownOpen) {
            helpContent.style.display = 'block';
        }
    
        helpDropdown.addEventListener('click', function() {
            const isCurrentlyOpen = helpContent.style.display === 'block';
            helpContent.style.display = isCurrentlyOpen ? 'none' : 'block';
    
            fetch('{{ route('store.help.dropdown.state') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ open: !isCurrentlyOpen })
            });
        });
    </script>    
</html>