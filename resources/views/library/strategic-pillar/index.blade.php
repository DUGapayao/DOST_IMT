@extends('dashboard')

@section('title', 'Strategic Pillar')

@section('current-page')
    <span>Library</span> / <span class="current-page">Strategic Pillar</span>
@endsection

@section('table-content')
    <table id="strategicTable" class="table-content">
        <thead>
            <!-- Blue Row -->
            <tr class="head-color">
                <th colspan="5" class="head-color">&nbsp;</th> <!-- Empty cells, spans all columns -->
            </tr>
            <!-- Search Input Row -->
            <tr>
                <th colspan="2">
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="filterTable()" 
                               placeholder="Search..." title="Type in a title" class="search-input">
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
            </tr>
        </thead>
        <tbody>
        @foreach($allStrategicPillar as $StrategicPillar)
            <tr onclick="openEditDialog('{{ $StrategicPillar->Title }}', '{{ route('strategic-pillar.update', ['strategicPillar' => $StrategicPillar->id]) }}', '{{ route('strategic-pillar.destroy', ['strategicPillar' => $StrategicPillar->id]) }}')">
                <td>{{ $StrategicPillar->Title }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Edit/Delete Modal -->
    <dialog id="edit-dialog" class="dialog-container">

        <div class="dialog-header">
            <!-- Header -->
            <h3 class="dialog-title">Strategic Pillar</h3>
            <!-- 'X' Button -->
            <button onclick="closeEditDialog()" class="x-button">&times;</button>
        </div>

        <div class="dialog-content">
            <!-- Edit Form -->
            <form method="POST" action="" id="editForm">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="editTitle">Title</label>
                    <input type="text" id="editTitle" name="Title" required>
                </div>
            </form>
        </div>

        <!-- Delete Form -->
        <form method="POST" action="" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="dialog-footer">
                <button type="submit" class="button-cancel">Delete</button>
                <button type="submit" form="editForm" class="button-add">Save</button>
            </div> 
        </form> 
    </dialog>

    <script>
        let sortOrder = 1;

        function sortTable(columnIndex) {
            const table = document.getElementById("strategicTable");
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

            sortOrder *= -1;
            const sortIconImage = document.getElementById("sortIconImage");
            sortIconImage.src = sortOrder === 1 ? "{{ asset('image/down-and-up-arrow.png') }}" : "{{ asset('image/up-and-down-arrow.png') }}";
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
            const table = document.getElementById("strategicTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 3; i < rows.length; i++) {
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
    <!-- Add Form -->
    <div id="add-dialog" class="dialog-container">
        <div class="dialog-header">
            <h3 class="dialog-title">Strategic Pillar</h3>
            <!-- 'X' Button -->
            <button onclick="closeAddDialog()" class="x-button">&times;</button>
        </div>
        <div class="dialog-content">
            <form method="POST" action="{{ route('strategic-pillar.store') }}" id="addForm" class="dialog-form">
                @csrf
                <div class="form-field">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="Title" required>
                </div>
            </form> 
        </div>
    </div>
@endsection
