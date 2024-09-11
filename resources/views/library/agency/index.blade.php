@extends('dashboard')

@section('title', 'Agencies')

@section('current-page')
    <span>Library</span> / <span class="current-page">Agencies</span>
@endsection

@section('table-content')
    <table id="agencyTable" class="table-content">
        <thead>
            <!-- Search and Filter Input Row -->
            <tr>
                <th colspan="5">
                    <div class="search-and-filter">
                        <!-- Filter Icon on the left -->
                        <div class="filter-icon-container">
                            <img src="{{ asset('image/filter.png') }}" alt="Filter Icon" class="filter-icon" onclick="openFilterDialog()">
                            Filter
                        </div>
                        <!-- Search Input on the right -->
                        <div class="search-container">
                            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search..." title="Type in a title">
                        </div>
                    </div>
                </th>
            </tr>
            <!-- Table Headers -->
            <tr>
                <th onclick="sortTable(0)" class="sortable-column">
                    <span id="sortIconAgencies" class="sort-header">
                        <img id="sortIconImage" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" class="sort-icon">
                        NAME OF AGENCY
                    </span>
                </th>
                <th onclick="sortTable(1)" class="sortable-column">
                    <span id="sortIconAcronym" class="sort-header">
                        <img id="sortIconImageAcronym" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" class="sort-icon">
                        ALIAS
                    </span>
                </th>
                <th onclick="sortTable(2)" class="sortable-column">
                    <span id="sortIconAgencyGroup" class="sort-header">
                        <img id="sortIconImageAgencyGroup" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" class="sort-icon">
                        GROUP
                    </span>
                </th>
                <th>CONTACT DETAILS</th>
                <th>AGENCY OFFICIAL WEBSITE LINK</th>
            </tr>                      
        </thead>
        <tbody>
            @foreach($allAgencies as $Agency)
            <tr onclick="openEditDialog('{{ $Agency->Agencies }}', '{{ $Agency->Acronym }}', '{{ $Agency->Agency_Group }}', '{{ $Agency->Contact }}', '{{ $Agency->Website }}', '{{ route('agency.update', ['agency' => $Agency->id]) }}', '{{ route('agency.destroy', ['agency' => $Agency->id]) }}')">
                <td class="truncate" title="{{ $Agency->Agencies }}">{{ $Agency->Agencies }}</td>
                <td>{{ $Agency->Acronym }}</td>
                <td class="truncate">{{ $Agency->Agency_Group }}</td>
                <td>{{ $Agency->Contact }}</td>
                <td>{{ $Agency->Website }}</td>
            </tr>            
            @endforeach
        </tbody>
    </table>

    <!-- Edit/Delete Modal -->
    <dialog id="edit-dialog">
        <div class="dialog-container">
            <!-- 'X' Button -->
            <button class="x-button" onclick="closeEditDialog()">&times;</button>
    
            <!-- Header -->
            <h3 class="dialog-title">AGENCY</h3>
    
            <!-- Edit Form -->
            <form method="POST" action="" id="editForm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <!-- Agencies Field -->
                    <div class="form-field">
                        <label for="editAgencies">Name of Agency</label>
                        <input type="text" id="editAgencies" name="Agencies">
                    </div>
            
                    <!-- Acronym Field -->
                    <div class="form-field">
                        <label for="editAcronym">Alias (short name)</label>
                        <input type="text" id="editAcronym" name="Acronym" required>
                    </div>
            
                    <!-- Agency Group Field -->
                    <div class="form-field">
                        <label for="editAgencyGroup">Group</label>
                        <select id="editAgencyGroup" name="Agency_Group" required>
                            <option value="" disabled selected>Select Group</option>
                            <option value="Advisory Bodies">Advisory Bodies</option>
                            <option value="Scientific and Technological Service Institutes">Scientific and Technological Service Institutes</option>
                            <option value="Research and Development Institute">Research and Development Institute</option>
                            <option value="Sectoral Planning Councils">Sectoral Planning Councils</option>
                        </select>
                    </div>                    
                    <!-- Contact Field -->
                    <div class="form-field">
                        <label for="editContact">Contact Details</label>
                        <input type="text" id="editContact" name="Contact" required>
                    </div>
            
                    <!-- Website Field -->
                    <div class="form-field">
                        <label for="editWebsite">Agency Official Website Link</label>
                        <input type="text" id="editWebsite" name="Website" required>
                    </div>
                </div>
            </form>

            <!-- Delete Form -->
            <form method="POST" action="" id="deleteForm" style="display: inline;">
                @csrf
                @method('DELETE')
                <div class="dialog-footer">
                    <button type="submit" class="button-cancel">Delete</button>
                    <button type="submit" form="editForm" class="button-add">Save</button>
                </div> 
            </form> 
        </div>
    </dialog>

    <!-- Filter Modal -->
    <dialog id="filter-dialog">
        <div class="dialog-container">
            <!-- 'X' Button -->
            <button class="x-button" onclick="closeFilterDialog()">&times;</button>

            <!-- Header -->
            <h3 class="dialog-title">Filter By:</h3>

            <!-- Filter Form -->
            <div class="filter-form">
                <div class="form-field">
                    <label for="filterAgencyGroup">Group</label>
                    <select id="filterAgencyGroup">
                        <option value="">All Group</option>
                        <option value="Advisory Bodies">Advisory Bodies</option>
                        <option value="Scientific and Technological Service Institutes">Scientific and Technological Service Institutes</option>
                        <option value="Research and Development Institute">Research and Development Institute</option>
                        <option value="Sectoral Planning Councils">Sectoral Planning Councils</option>
                    </select>
                </div>
                <div class="dialog-footer">
                    <button type="button" class="button-add" onclick="applyFilter()">Apply Filter</button>
                </div>
            </div>
        </div>
    </dialog>


    <script>
        let sortOrder = 1;
        let currentSortColumn = -1;

        function sortTable(columnIndex) {
            const table = document.getElementById("agencyTable");
            const tbody = table.tBodies[0];
            const rows = Array.from(tbody.rows);

            rows.sort((a, b) => {
                const cellA = a.cells[columnIndex].innerText.toUpperCase();
                const cellB = b.cells[columnIndex].innerText.toUpperCase();

                if (cellA < cellB) return -sortOrder;
                if (cellA > cellB) return sortOrder;
                return 0;
            });

            rows.forEach(row => tbody.appendChild(row));

            // Reset sort icons
            document.querySelectorAll('[id^="sortIconImage"]').forEach(icon => {
                icon.src = "{{ asset('image/up-and-down-arrow.png') }}";
            });

            // Update the current column icon
            const sortIconImage = document.getElementById(`sortIconImage${['', 'Acronym', 'AgencyGroup'][columnIndex]}`);
            if (sortIconImage) {
                sortIconImage.src = sortOrder === 1 ? "{{ asset('image/up-and-down-arrow.png') }}" : "{{ asset('image/down-and-up-arrow.png') }}";
            }

            // Toggle sort order for next click
            sortOrder *= -1;
            currentSortColumn = columnIndex;
        }

        function openEditDialog(agencies, acronym, agencyGroup, contact, website, updateUrl, deleteUrl) {
            document.getElementById('editAgencies').value = agencies;
            document.getElementById('editAcronym').value = acronym;
            document.getElementById('editAgencyGroup').value = agencyGroup;
            document.getElementById('editContact').value = contact;
            document.getElementById('editWebsite').value = website;
            document.getElementById('editForm').action = updateUrl;
            document.getElementById('deleteForm').action = deleteUrl;
            document.getElementById('edit-dialog').showModal();
        }

        function closeEditDialog() {
            document.getElementById('edit-dialog').close();
        }
    
        function filterTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toUpperCase();
            const table = document.getElementById("agencyTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 3; i < rows.length; i++) { // Start at 3 to skip the search input row and header row
                const cells = rows[i].getElementsByTagName("td");
                if (cells.length > 0) {
                    const agenciesCell = cells[0].textContent || cells[0].innerText;
                    const acronymCell = cells[1].textContent || cells[1].innerText;
                    const groupCell = cells[2].textContent || cells[2].innerText;

                    const showRow = agenciesCell.toUpperCase().indexOf(filter) > -1 ||
                                    acronymCell.toUpperCase().indexOf(filter) > -1 ||
                                    groupCell.toUpperCase().indexOf(filter) > -1;

                    rows[i].style.display = showRow ? "" : "none";
                }
            }
        }

        function openFilterDialog() {
            document.getElementById('filter-dialog').showModal();
        }

        function closeFilterDialog() {
            document.getElementById('filter-dialog').close();
        }

        function applyFilter() {
            const selectedGroup = document.getElementById('filterAgencyGroup').value.toUpperCase();
            const table = document.getElementById("agencyTable");
            const rows = table.getElementsByTagName("tr");

            // Loop through the table rows starting from the row after the headers and search/filter row
            for (let i = 2; i < rows.length; i++) { // Start at 2 to skip header and search/filter rows
                const cells = rows[i].getElementsByTagName("td");
                if (cells.length > 0) {
                    const groupCell = cells[2].textContent || cells[2].innerText;

                    // Show row if the selected group is empty (i.e., "All Group") or matches the group cell
                    const showRow = selectedGroup === "" || groupCell.toUpperCase() === selectedGroup;
                    rows[i].style.display = showRow ? "" : "none";
                }
            }

            closeFilterDialog(); // Close the modal after applying the filter
        }


    </script>
@endsection

@section('add-form')
    <!-- 'X' Button -->
    <button class="x-button" onclick="closeAddDialog()">&times;</button>
    
    <h3 class="dialog-title">Agency</h3>
    
    <form method="POST" action="{{ route('agency.store') }}" id="addForm" class="dialog-form">
        @csrf
        <div class="form-group">
            <div class="form-field">
                <label for="Agencies">Name of Agency</label>
                <input type="text" id="Agencies" name="Agencies" required>
            </div>
            <div class="form-field">
                <label for="Acronym">Alias (short name)</label>
                <input type="text" id="Acronym" name="Acronym" required>
            </div>
            <div class="form-field">
                <label for="Agency_Group">Group</label>
                <select id="Agency_Group" name="Agency_Group" required>
                    <option value="" disabled selected>Select Group</option>
                    <option value="Advisory Bodies">Advisory Bodies</option>
                    <option value="Scientific and Technological Service Institutes">Scientific and Technological Service Institutes</option>
                    <option value="Research and Development Institute">Research and Development Institute</option>
                    <option value="Sectoral Planning Councils">Sectoral Planning Councils</option>
                </select>
            </div>

            <div class="form-field">
                <label for="Contact">Contact Details</label>
                <input type="text" id="Contact" name="Contact" required>
            </div>
            <div class="form-field">
                <label for="Website">Agency Official Website Link</label>
                <input type="text" id="Website" name="Website" required>
            </div>
        </div>
    </form>
@endsection
