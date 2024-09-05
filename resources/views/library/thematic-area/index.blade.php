@extends('dashboard')

@section('title', 'DOST Thematic Area')

@section('current-page', 'DOST Thematic Area')

@section('table-content')
    <table id="thematicTable" class="table-content">
        <thead>
            <!-- Search Input Row -->
            <tr>
                <th colspan="2">
                    <div style="text-align: right; padding-bottom: 10px; position: relative;">
                        <input type="text" id="searchInput" onkeyup="filterTable()" 
                               placeholder="Search..." title="Type in a title" 
                               style="width: 200px; padding-right: 30px; background: url('{{ asset('image/search.png') }}') no-repeat right 5px center; background-size: 15px; background-color: white; color: #333; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                </th>                             
            </tr>
            <!-- Black Line Row -->
            <tr>
                <th colspan="2" style="border-bottom: 2px solid rgb(138, 138, 138); padding: 0;"></th>
            </tr>
            <!-- Table Headers -->
            <tr>
                <th onclick="sortTable(0)" style="cursor: pointer;">
                    <span id="sortIcon">
                        <img id="sortIconImage" src="{{ asset('image/up-and-down-arrow.png') }}" alt="Sort Icon" style="width: 18px; height: 18px; vertical-align: middle;">
                        TITLE:
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($allThematicArea as $ThematicArea)
            <tr onclick="openEditDialog('{{ $ThematicArea->Title }}', '{{ route('thematic-area.update', ['thematicArea' => $ThematicArea->id]) }}', '{{ route('thematic-area.destroy', ['thematicArea' => $ThematicArea->id]) }}')">
                <td>{{ $ThematicArea->Title }}</td>
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
            <h3 style="margin-bottom: 20px;">EDIT THEMATIC AREA</h3>
    
            <!-- Edit Form -->
            <form method="POST" action="" id="editForm">
                @csrf
                @method('PUT')
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                    <label for="editTitle" style="flex-shrink: 0;">Title:</label>
                    <input type="text" id="editTitle" name="Title" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
            </form>
    
            <!-- Delete Form -->
            <form method="POST" action="" id="deleteForm" style="display: inline;">
                @csrf
                @method('DELETE')
                <div style="text-align: right;">
                    <button type="submit" class="button-cancel" style="margin-right: 10px;">Delete</button>
                    <button type="submit" form="editForm" class="button-add">Save</button>
                </div> 
            </form> 
        </div>
    </dialog>

    <script>
        let sortOrder = 1; // 1 for ascending, -1 for descending

        function sortTable(columnIndex) {
            const table = document.getElementById("thematicTable");
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

        function openEditDialog(title, updateUrl, deleteUrl) {
            document.getElementById('editTitle').value = title;
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
            const table = document.getElementById("thematicTable");
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
    <h3 style="margin-bottom: 20px;">Add New Thematic Area</h3>
    <!-- Form for adding a new thematic area -->
    <form method="POST" action="{{ route('thematic-area.store') }}" id="addForm" style="margin-bottom: 20px;">
        @csrf
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <label for="title" style="flex-shrink: 0;">Title:</label>
            <input type="text" id="title" name="Title" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
    </form> 
@endsection
