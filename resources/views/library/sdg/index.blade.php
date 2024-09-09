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
                    <div style="text-align: right; padding-bottom: 10px; position: relative;">
                        <input type="text" id="searchInput" onkeyup="filterTable()" 
                               placeholder="Search..." title="Type in a title" 
                               style="width: 200px; padding-right: 30px; background: url('{{ asset('image/search.png') }}') no-repeat right 5px center; background-size: 15px; background-color: white; color: #333; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                </th>                             
            </tr>
            <!-- Black Line Row -->
            <tr>
                <th colspan="3" style="border-bottom: 2px solid rgb(138, 138, 138); padding: 0;"></th>
            </tr>
            <!-- Table Headers -->
            <tr>
                <th onclick="sortTable(0)" style="cursor: pointer;">
                    <span id="sortIcon">
                        <img id="sortIconImage" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" style="width: 18px; height: 18px; vertical-align: middle;">
                        TITLE:
                    </span>
                </th>
                <th>DESCRIPTION:</th>
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
    <dialog id="edit-dialog">
        <div class="dialog-container" style="width: 400px; padding: 20px; position: relative;">
            <!-- 'X' Button -->
            <button onclick="closeEditDialog()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
    
            <!-- Header -->
            <h3 style="margin-bottom: 20px;">EDIT SDG</h3>
    
            <!-- Edit Form -->
            <form method="POST" action="" id="editForm">
                @csrf
                @method('PUT')
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <!-- Title Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editTitle" style="flex-shrink: 0; width: 100px;">Title:</label>
                        <input type="text" id="editTitle" name="Title" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>

                    <!-- Description Field -->
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label for="editDescription" style="flex-shrink: 0; width: 100px;">Description:</label>
                        <textarea id="editDescription" name="Description" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
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
    <h3 style="margin-bottom: 20px;">Add New SDG</h3>
    <!-- Form for adding a new SDG -->
    <form method="POST" action="{{ route('sdg.store') }}" id="addForm" style="margin-bottom: 20px;">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <!-- Title Field -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="editTitle" style="flex-shrink: 0; width: 100px;">Title:</label>
                <input type="text" id="editTitle" name="Title" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <!-- Description Field -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="editDescription" style="flex-shrink: 0; width: 100px;">Description:</label>
                <textarea id="editDescription" name="Description" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
            </div>
        </div>
    </form> 
@endsection

