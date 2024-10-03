<div class="left-bar" id="sidebar">
    <div class="nav-container" id="nav-container-id" style="display: flex;">
        <nav class="nav-class">
            <ul>
                <button class="button-faqs" id="faqs-dropdown">
                    <div class="list-faqs-container"> 
                        <div class="action-faqs-container">
                            FAQS
                        </div>
                        <div id="faqs-dropdown-icon" class="faqs-icon-container">
                            @include('svg.dropdown-icon')
                        </div>
                    </div>
                </button>

                @php
                    $faqsContent = [
                        'How to Select Primary Indicators' => url('/faqs') . '#1',
                        'How to Select Secondary Indicators' => url('/faqs') . '#2',
                    ];
                @endphp
            

                <div id="faqs-content" class="subfaqs-container">
                    <ul>
                        @foreach ($faqsContent as $label => $action)
                        <div class="list-item-container">
                            <div class="hyphen-container">
                                <div class="circle"></div>
                            </div>
                            <li><a href={{ $action }}>{{ $label }}</a></li>
                        </div>
                        @endforeach
                    </ul>
                </div>


                <button class="button-online-help" id="online-help-dropdown">
                    <div class="list-online-help-container"> 
                        <div class="action-online-help-container">
                            Online Help
                        </div>
                        <div id="online-help-dropdown-icon" class="online-help-icon-container">
                            @include('svg.dropdown-icon')
                        </div>
                    </div>
                </button>
                
                @php
                    $helpContent = [
                        'How to Sign In' => url('/online-help') . '#1',
                        'How to Request Forgot Password' => url('/online-help') . '#2',
                        'How to Select Primary Indicators' => url('/online-help') . '#3',
                        'How to Select Secondary Indicators' => url('/online-help') . '#4',
                    ];
                @endphp

                <div id="online-help-content" class="subhelp-container">
                    <ul>
                        @foreach ($helpContent as $label => $action)
                        <div class="list-item-container">
                            <div class="hyphen-container">
                                <div class="circle"></div>
                            </div>
                            <li><a href={{ $action }}>{{ $label }}</a></li>
                        </div>
                        @endforeach
                    </ul>
                </div>

                <div class="list-about-container">
                    <div class="action-about-container">
                        <li><a href="/about">About</a></li>
                    </div>
                </div>
                
                <div class="footer-container">
                    <p>
                        Copyright 2024 DOST. All rights reserved | <a href="/terms" class="action-terms-container">Terms and Conditions</a>
                    </p>
                </div>                
            </ul>
        </nav>
    </div>

    <div class="collapse-container" id="collapse-container-id">
        <button class="button-collapse" onclick="collapseSidebar()">
            <div id="collapse-icon-id" class="collapse-icon-container">
                @include('svg.dropleft-icon')
            </div>
        </button>
    </div>
</div>
