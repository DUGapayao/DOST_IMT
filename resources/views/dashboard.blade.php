<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" >
        <link rel="stylesheet" href="{{ asset('css/dashboard_page.css') }}">

        <script defer src="{{ asset('js/dashboard.js') }}"></script>
        <title>DOST-IMT</title>
    </head>
    <body>
        <div class="whole-container">
            <div class="navigation-container">
                <div class="logo-container">
                    <div class="image-logo">
                        <img src="{{ asset('image/logo-ims.png') }}" class="image-ims" alt="IMS Logo">
                    </div>
                    <div class="text-system">
                        <div class="center-txt-container">
                            <div class="text-indicators">Indicators</div>
                            <div class="text-mgmt-sys">Management System</div>
                        </div>
                    </div>
                </div>

                <div class="right-container">
                    <div class="notif-container">
                        @include('svg.notif-icon')
                    </div>
                    
                    <div class="vline-container">
                        <div class="vertical-line"></div>
                    </div>

                    <div class="profile-container">
                        <div class="image-profile">
                            <img src="{{ asset('image/profile-pic.png') }}" class="image-profile" alt="Profile Image">
                        </div>
                        <!-- <div class="text-name">Romulo</div> !-->
                    </div>
                </div>
                <!-- Insert navigation elements here !-->
            </div>

            <div class="main-container">
                <div id="sidebar" class="left-bar" style="display: flex;">
                    <!-- Insert dashboard and library navigation here !-->
                    <div class="nav-container">
                        <nav class="nav">
                            <ul>
                                <div class="list-dashboard-container {{ request()->is('dashboard') ? 'active' : '' }}">
                                    <div class="dboard-icon-container">
                                        @include('svg.dashboard-icon')
                                    </div>
                                    <div class="action-dashboard-container">
                                        <li><a href="/login">Dashboard</a></li>
                                    </div>
                                </div>
                                
                                <div class="line-container"></div>

                                <button class="button-library" onclick="toggleContent()">
                                    <div class="list-library-container">
                                        <div class="library-icon-container">
                                            @include('svg.library-icon')
                                        </div>
                                        <div class="action-library-container">
                                            Library
                                        </div>
                                        <div class="dropdown-icon-container">
                                            @include('svg.dropdown-icon')
                                        </div>
                                    </div>
                                </button>

                                <div id="hidden-content" class="sublibrary-container">
                                    <ul>
                                        <div class="list-users-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/users">Users</a></li>
                                        </div>

                                        <div class="list-agencies-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/login">DOST Agencies</a></li>
                                        </div>

                                        <div class="list-indicators-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/login">Indicators</a></li>
                                        </div>

                                        <div class="list-pillars-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/login">DOST Strategic Pillar</a></li>
                                        </div>

                                        <div class="list-thematic-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/thematic-area">DOST Thematic Area</a></li>
                                        </div>

                                        <div class="list-priority-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/login">DOST Priority</a></li>
                                        </div>

                                        <div class="list-sdg-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/login">SDG</a></li>
                                        </div>

                                        <div class="list-hnrda-container">
                                            <div class="hyphen-container">
                                                <div class="line-hyphen"></div>
                                            </div>
                                            <li><a href="/hnrda">HNRDA</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </ul>
                        </nav>
                    </div>                    
                </div>

                <!-- Collapsible Sidebar !--> 
                <div class="collapse-container">
                    <button class="button-collapse" onclick="collapseSidebar()">
                        <div id="collapse-icon-id" class="collapse-icon-container">
                            @include('svg.dropleft-icon')
                        </div>
                    </button>
                </div>  

                <div id="main-content-id" class="main-content">
                    <!-- Insert dashboard/library main content here !-->

                    <div class="title-block">
                        <div class="text-title">
                            @yield('title')
                        </div>
                    
                        <div class="title-bottom">
                            <div class="page-identifier">
                                <span>Library</span> / <span class="current-page">@yield('current-page')</span>
                            </div>
                    
                            <div class="add-container">
                                <button onclick="showAddDialog()" class="button-add">+ ADD NEW</button>
                                @yield('add-new')
                            </div>
                        </div>
                    </div>
                    
                    <dialog id="add-dialog">
                        <div class="dialog-container" style="height: 210px; width: 500px;">
                            @yield('add-form')
                            <div style="text-align: right;">
                                <button onclick="closeAddDialog()" class="button-cancel" style="margin-right: 18px;">CANCEL</button>
                                <button type="submit" form="addForm" class="button-add">SAVE</button>
                            </div>    
                        </div>
                    </dialog>
                    
                    <div class="table-container">
                        <table class="table-content">
                            @yield('table-content')
                            <!--
                            <thead>
                                <tr>
                                    <th>Header 1</th>
                                    <th>Header 2</th>
                                    <th>Header 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1, Cell 1</td>
                                    <td>Row 1, Cell 2</td>
                                    <td>Row 1, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 2, Cell 1</td>
                                    <td>Row 2, Cell 2</td>
                                    <td>Row 2, Cell 3</td>
                                </tr>
                                <tr>
                                    <td>Row 3, Cell 1</td>
                                    <td>Row 3, Cell 2</td>
                                    <td>Row 3, Cell 3</td>
                                </tr>
                            </tbody>
                            !-->
                        </table>
                    </div>

                     <div class="analytics-container">
                        <div class="data1-container"></div>
                        <div class="data2-container"></div>
                        <div class="data3-container"></div>
                        <div class="data4-container"></div>
                     </div>

                     <div class="indicators-container">
                        <div class="upper-indicator-container">
                            <div class="filter-container"></div>
                            <div class="search-container"></div>
                        </div>
                        <div class="table-indicators">
                            <!-- Insert table here !-->
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </body>
</html>