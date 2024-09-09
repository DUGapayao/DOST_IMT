@extends('dashboard')

@section('title', 'DOST Agencies')

@section('current-page')
    <span>Library</span> / <span class="current-page">DOST Agencies</span>
@endsection

@section('table-content')
    <table id="agencyTable" class="table-content">
        <thead>
            <!-- Search Input Row -->
            <tr>
                <th colspan="5">
                    <div style="text-align: right; padding-bottom: 10px; position: relative;">
                        <input type="text" id="searchInput" onkeyup="filterTable()" 
                               placeholder="Search..." title="Type in a title" 
                               style="width: 200px; padding-right: 30px; background: url('{{ asset('image/search.png') }}') no-repeat right 5px center; background-size: 15px; background-color: white; color: #333; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                </th>
            </tr>
            <!-- Black Line Row -->
            <tr>
                <th colspan="5" style="border-bottom: 2px solid rgb(138, 138, 138); padding: 0;"></th>
            </tr>
            <!-- Table Headers -->
            <tr>
                <th onclick="sortTable(0)" style="cursor: pointer;">
                    <span id="sortIconAgencies">
                        <img id="sortIconImage" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" style="width: 18px; height: 18px; vertical-align: middle;">
                        AGENCIES:
                    </span>
                </th>
                <th onclick="sortTable(1)" style="cursor: pointer;">
                    <span id="sortIconAcronym">
                        <img id="sortIconImageAcronym" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" style="width: 18px; height: 18px; vertical-align: middle;">
                        ACRONYM:
                    </span>
                </th>
                <th onclick="sortTable(2)" style="cursor: pointer;">
                    <span id="sortIconAgencyGroup">
                        <img id="sortIconImageAgencyGroup" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" style="width: 18px; height: 18px; vertical-align: middle;">
                        AGENCY GROUP:
                    </span>
                </th>
                <th>CONTACT:</th>
                <th>WEBSITE:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allAgencies as $Agency)
            <tr onclick="openEditDialog('{{ $Agency->Agencies }}', '{{ $Agency->Acronym }}', '{{ $Agency->Agency_Group }}', '{{ $Agency->Contact }}', '{{ $Agency->Website }}', '{{ route('agency.update', ['agency' => $Agency->id]) }}', '{{ route('agency.destroy', ['agency' => $Agency->id]) }}')">
                <td class="truncate" title="{{ $Agency->Agencies }}">{{ $Agency->Agencies }}</td>
                <td>{{ $Agency->Acronym }}</td>
                <td>{{ $Agency->Agency_Group }}</td>
                <td>{{ $Agency->Contact }}</td>
                <td>{{ $Agency->Website }}</td>
            </tr>            
            @endforeach
        </tbody>
    </table>

    <!-- Edit/Delete Modal -->
    <dialog id="edit-dialog">
        <div class="dialog-container" style="width: 400px; padding: 20px; position: relative;">
            <!-- 'X' Button -->
            <button onclick="closeEditDialog()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
    
            <!-- Header -->
            <h3 style="margin-bottom: 20px;">EDIT AGENCY</h3>
    
            <!-- Edit Form -->
            <form method="POST" action="" id="editForm">
                @csrf
                @method('PUT')
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <!-- Agencies Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editAgencies" style="flex-shrink: 0; width: 100px;">Agencies:</label>
                        <input type="text" id="editAgencies" name="Agencies" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>

                    <!-- Acronym Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editAcronym" style="flex-shrink: 0; width: 100px;">Acronym:</label>
                        <input type="text" id="editAcronym" name="Acronym" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>

                    <!-- Agency Group Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editAgencyGroup" style="flex-shrink: 0; width: 100px;">Group:</label>
                        <input type="text" id="editAgencyGroup" name="Agency_Group" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                    
                    <!-- Contact Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editContact" style="flex-shrink: 0; width: 100px;">Contact:</label>
                        <input type="text" id="editContact" name="Contact" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>

                    <!-- Website Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editWebsite" style="flex-shrink: 0; width: 100px;">Website:</label>
                        <input type="text" id="editWebsite" name="Website" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                </div>
            </form>

            <!-- Delete Form -->
            <form method="POST" action="" id="deleteForm" style="display: inline;">
                @csrf
                @method('DELETE')
                <div style="text-align: right;">
                    <button type="submit" class="button-cancel" style="margin-right: 10px; margin-top: 15px;">Delete</button>
                    <button type="submit" form="editForm" class="button-add">Save</button>
                </div> 
            </form> 
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
    </script>
@endsection

@section('add-form')
    <h3 style="margin-bottom: 20px;">Add New DOST Agency</h3>
    <form method="POST" action="{{ route('agency.store') }}" id="addForm" style="margin-bottom: 20px;">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="Agencies" style="flex-shrink: 0; width: 100px;">Agencies:</label>
                <input type="text" id="Agencies" name="Agencies" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="Acronym" style="flex-shrink: 0; width: 100px;">Acronym:</label>
                <input type="text" id="Acronym" name="Acronym" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="AgencyGroup" style="flex-shrink: 0; width: 100px;">Group:</label>
                <input type="text" id="Agency_Group" name="Agency_Group" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>            
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="Contact" style="flex-shrink: 0; width: 100px;">Contact:</label>
                <input type="text" id="Contact" name="Contact" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="Website" style="flex-shrink: 0; width: 100px;">Website:</label>
                <input type="text" id="Website" name="Website" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>
    </form>
@endsection
