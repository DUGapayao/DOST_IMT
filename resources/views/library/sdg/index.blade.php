@extends('dashboard')

@section('title', 'Sustainable Development Goals (SDG)')

@section('current-page')
    <span>Library</span> / <span class="current-page">SDG</span>
@endsection

@section('table-content')
    <table id="SDGTable" class="table-content">
        <thead>
            <!-- Search Input Row -->
            <tr>
                <th colspan="3">
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="filterTable()" 
                               placeholder="Search..." title="Type in a title" 
                               class="search-input">
                    </div>
                </th>                             
            </tr>
            <!-- Table Headers -->
            <tr>
                <th onclick="sortTable(0)" class="sortable-column">
                    <span id="sortIcon">
                        <img id="sortIconImage" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" class="sort-icon">
                        TITLE
                    </span>
                </th>
                <th>DESCRIPTION</th>
            </tr>
        </thead>
        <tbody>
        @foreach($allSdg as $Sdg)
            <tr onclick="openEditDialog('{{ $Sdg->Title }}', '{{ $Sdg->Description }}', '{{ route('sdg.update', ['sdg' => $Sdg->id]) }}', '{{ route('sdg.destroy', ['sdg' => $Sdg->id]) }}')">
                <td>{{ $Sdg->Title }}</td>
                <td>{{ $Sdg->Description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Edit/Delete Modal -->
    <dialog id="edit-dialog" class="dialog-container">
        <!-- 'X' Button -->
        <button onclick="closeEditDialog()" class="x-button">&times;</button>
    
        <!-- Header -->
        <h3 class="dialog-title">SDG</h3>
    
        <!-- Edit Form -->
        <form method="POST" action="" id="editForm">
            @csrf
            @method('PUT')
            <div class="form-group">
                <!-- Title Field -->
                <div class="form-field">
                    <label for="editTitle">Title</label>
                    <input type="text" id="editTitle" name="Title" required>
                </div>

                <!-- Description Field -->
                <div class="form-field">
                    <label for="editDescription">Description</label>
                    <textarea id="editDescription" name="Description" required></textarea>
                </div>
            </div>
        </form>
    
        <!-- Delete Form -->
        <form method="POST" action="" id="deleteForm" class="delete-form">
            @csrf
            @method('DELETE')
            <div class="dialog-footer">
                <button type="submit" class="button-cancel">Delete</button>
                <button type="submit" form="editForm" class="button-add">Save</button>
            </div> 
        </form> 
    </dialog>

    <script>
        let sortOrder = 1; // 1 for ascending, -1 for descending

        function sortTable(columnIndex) {
            const table = document.getElementById("SDGTable");
            const tbody = table.tBodies[0];
            const rows = Array.from(tbody.rows);

            rows.sort((a, b) => {
                const cellA = a.cells[columnIndex].innerText.toUpperCase();
                const cellB = b.cells[columnIndex].innerText.toUpperCase();

                if (cellA < cellB) return -sortOrder;
                if (cellA > cellB) return sortOrder;
                return 0;
            });

            // Reorder rows in the table
            rows.forEach(row => tbody.appendChild(row));

            // Toggle sort order and update icon
            sortOrder *= -1;
            const sortIconImage = document.getElementById("sortIconImage");

            if (sortOrder === 1) {
                sortIconImage.src = "{{ asset('image/down-and-up-arrow.png') }}";
            } else {
                sortIconImage.src = "{{ asset('image/up-and-down-arrow.png') }}";
            }
        }

        function openEditDialog(title, description, updateUrl, deleteUrl) {
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
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
            const table = document.getElementById("SDGTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 3; i < rows.length; i++) { // Start at 3 to skip the search input row and header row
                const cell = rows[i].getElementsByTagName("td")[0];
                if (cell) {
                    const txtValue = cell.textContent || cell.innerText;
                    rows[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }
    </script>
@endsection

@section('add-form')
    <!-- 'X' Button -->
    <button onclick="closeAddDialog()" class="x-button">&times;</button>
    <h3 class="dialog-title">SDG</h3>
    <!-- Form for adding a new SDG -->
    <form method="POST" action="{{ route('sdg.store') }}" id="addForm" class="dialog-form">
        @csrf
        <div class="form-group">
            <!-- Title Field -->
            <div class="form-field">
                <label for="addTitle">Title</label>
                <input type="text" id="addTitle" name="Title" required>
            </div>

            <!-- Description Field -->
            <div class="form-field">
                <label for="addDescription">Description</label>
                <textarea id="addDescription" name="Description" required></textarea>
            </div>
        </div>
    </form> 
@endsection
