@extends('master-data.layout.main')
@section('title')
    Master Data SuperAdmin Kapasitas
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="h4 fw-semibold text-dark mb-3">Data Kapasitas</p>

                <button class="btn btn-primary mb-3" id="add-kapasitas">+ Tambah Kapasitas</button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="kapasitas-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Division</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $data = \App\Models\KapasitasM::all(); @endphp
                            @foreach ($data as $d)
                            <tr data-id="{{ $d->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td contenteditable="true" class="editable" data-field="name">{{ $d->name }}</td>
                                <td>
                                    <select class="editable-select form-select" data-field="jenis">
                                        <option value="Crane" {{ $d->jenis == 'Crane' ? 'selected' : '' }}>Crane</option>
                                        <option value="Forklift" {{ $d->jenis == 'Forklift' ? 'selected' : '' }}>Forklift</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="editable-select form-select" data-field="division">
                                        <option value="Warehouse" {{ $d->division == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                        <option value="Produksi" {{ $d->division == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                                    </select>
                                </td>
                                <td><button class="btn btn-danger btn-sm delete-row">Hapus</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let counter = {{ count($data) + 1 }};

    const tableBody = document.querySelector('#kapasitas-table tbody');

    // Add new row
    document.getElementById('add-kapasitas').addEventListener('click', function() {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${counter++}</td>
            <td contenteditable="true" class="new" data-field="name"></td>
            <td>
                <select class="form-select new-select" data-field="jenis">
                    <option value="Crane">Crane</option>
                    <option value="Forklift">Forklift</option>
                </select>
            </td>
            <td>
                <select class="editable-select form-select" data-field="division">
                    <option value="Warehouse" {{ $d->division == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                    <option value="Produksi" {{ $d->division == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                </select>
            </td>
            <td><button class="btn btn-success btn-sm save-row">Simpan</button></td>
        `;
        tableBody.appendChild(row);
    });

    // Save new row
    tableBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('save-row')) {
            const row = e.target.closest('tr');
            const name = row.querySelector('[data-field="name"]').innerText.trim();
            const jenis = row.querySelector('[data-field="jenis"]').value;
            const division = row.querySelector('[data-field="division"]').value;

            if (!name) {
                Swal.fire('Peringatan', 'Nama tidak boleh kosong', 'warning');
                return;
            }

            fetch(`{{ route("superadmin.kapasitas.store") }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ name, jenis })
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan!'
                }).then(() => location.reload());
            })
            .catch(error => {
                console.error('Tambah error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal menyimpan data.'
                });
            });
        }
    });

    // Update inline editable content (on blur)
    tableBody.addEventListener('blur', function(e) {
        if (e.target.classList.contains('editable') && e.target.isContentEditable) {
            const cell = e.target;
            const field = cell.dataset.field;
            const value = cell.innerText.trim();
            const id = cell.closest('tr').dataset.id;

            if (!id) return; // Skip if no id (new rows)

            fetch(`{{ route('superadmin.kapasitas.update', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ field, value })
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal update');
                return res.json();
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data kapasitas berhasil diupdate!'
                });
            })
            .catch(error => {
                console.error('Update error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengupdate kapasitas. Cek konsol untuk detail.'
                });
            });
        }
    }, true);

    // Update select inline change
    tableBody.addEventListener('change', function(e) {
        if (e.target.classList.contains('editable-select')) {
            const select = e.target;
            const field = select.dataset.field;
            const value = select.value;
            const id = select.closest('tr').dataset.id;

            fetch(`{{ route('superadmin.kapasitas.update', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ field, value })
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal update');
                return res.json();
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data kapasitas berhasil diupdate!'
                });
            })
            .catch(error => {
                console.error('Update error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengupdate kapasitas. Cek konsol untuk detail.'
                });
            });
        }
    });

    // Delete row
    tableBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-row')) {
            const row = e.target.closest('tr');
            const id = row.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('superadmin.kapasitas.delete', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal hapus');
                        row.remove();
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                    })
                    .catch(error => {
                        console.error('Hapus error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal menghapus data.'
                        });
                    });
                }
            });
        }
    });
});
</script>

    {{-- //trailler --}}
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="h4 fw-semibold text-dark mb-3">Data Trailer</p>

                    <button class="btn btn-primary mb-3" id="add-trailler">+ Tambah Trailer</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="trailler-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Mobil</th>
                                    <th>Pengguna</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $traler = \App\Models\TrailerNameM::all(); @endphp
                                @foreach ($traler as $d)
                                <tr data-id="{{ $d->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td contenteditable="true" class="editable" data-field="no_mobil">{{ $d->no_mobil }}</td>
                                    <td contenteditable="true" class="editable" data-field="pengguna">{{ $d->pengguna }}</td>
                                    
                                    <td><button class="btn btn-danger btn-sm delete-row">Hapus</button></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('add-trailler').addEventListener('click', function () {
    const table = document.querySelector('#trailler-table tbody');
    const number = table.rows.length + 1;

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${number}</td>
        <td contenteditable="true" class="editable" data-field="no_mobil">Baru</td>
        <td contenteditable="true" class="editable" data-field="pengguna">Baru</td>
        <td><button class="btn btn-success btn-sm save-row">Simpan</button></td>
    `;
    table.appendChild(newRow);

    attachEventsToRow(newRow);
});

function attachEventsToRow(row) {
    row.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('blur', function () {
            const id = row.dataset.id;
            if (!id) return;

            const field = this.dataset.field;
            const value = this.textContent.trim();

            fetch(`{{ route('superadmin.trailer.update', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ field, value })
            })
            .then(res => res.json())
            .then(() => {
                Swal.fire('Berhasil', 'Data diperbarui!', 'success');
            })
            .catch(() => {
                Swal.fire('Gagal', 'Tidak bisa memperbarui data.', 'error');
            });
        });
    });

    const saveBtn = row.querySelector('.save-row');
    if (saveBtn) {
        saveBtn.addEventListener('click', function () {
            const no_mobil = row.querySelector('[data-field="no_mobil"]').textContent.trim();
            const pengguna = row.querySelector('[data-field="pengguna"]').textContent.trim();

            fetch(`{{ route('superadmin.trailer.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ no_mobil, pengguna })
            })
            .then(res => res.json())
            .then(data => {
                row.setAttribute('data-id', data.id);
                saveBtn.outerHTML = `<button class="btn btn-danger btn-sm delete-row">Hapus</button>`;
                attachDeleteEvent(row);
                Swal.fire('Berhasil', 'Data trailer disimpan.', 'success');
            })
            .catch(() => {
                Swal.fire('Gagal', 'Gagal menyimpan data.', 'error');
            });
        });
    }

    attachDeleteEvent(row);
}

function attachDeleteEvent(row) {
    const delBtn = row.querySelector('.delete-row');
    if (!delBtn) return;

    delBtn.addEventListener('click', function () {
        const id = row.dataset.id;

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                if (id) {
                    fetch(`{{ route('superadmin.trailer.delete', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(() => {
                        row.remove();
                        Swal.fire('Berhasil', 'Data dihapus.', 'success');
                    })
                    .catch(() => {
                        Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                    });
                } else {
                    row.remove();
                    Swal.fire('Dihapus', 'Baris yang belum disimpan dihapus.', 'success');
                }
            }
        });
    });
}

// Inisialisasi untuk baris awal
document.querySelectorAll('#trailler-table tbody tr').forEach(attachEventsToRow);
</script>



</div>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let counter = {{ count($data) + 1 }};

    document.getElementById('add-kapasitas').addEventListener('click', function() {
        const table = document.querySelector('#kapasitas-table tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${counter++}</td>
            <td contenteditable="true" class="new" data-field="name"></td>
            <td>
                <select class="form-select new-select" data-field="jenis">
                    <option value="Crane">Crane</option>
                    <option value="Forklift">Forklift</option>
                </select>
            </td>
            <td><button class="btn btn-success btn-sm save-row">Simpan</button></td>
        `;
        table.appendChild(row);
    });

    // Simpan data baru
    document.querySelector('#kapasitas-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('save-row')) {
            const row = e.target.closest('tr');
            const name = row.querySelector('[data-field="name"]').innerText.trim();
            const jenis = row.querySelector('[data-field="jenis"]').value;

            fetch(`{{ route("superadmin.kapasitas.store") }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ name, jenis })
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil ditambahkan!'
                }).then(() => location.reload());
            })
            .catch(error => {
                console.error('Tambah error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal menyimpan data.'
                });
            });
        }
    });

    // Update data inline (input + select)
    document.querySelectorAll('.editable-select').forEach(select => {
        select.addEventListener('change', function() {
            const field = this.dataset.field;
            const value = this.value;
            const id = this.closest('tr').dataset.id;

            fetch(`{{ route('superadmin.kapasitas.update', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ field, value })
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal update');
                return res.json();
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data kapasitas berhasil diupdate!'
                });
            })
            .catch(error => {
                console.error('Update error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengupdate kapasitas. Cek konsol untuk detail.'
                });
            });
        });
    });


    // Hapus data
    document.querySelector('#kapasitas-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-row')) {
            const row = e.target.closest('tr');
            const id = row.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('superadmin.kapasitas.delete', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal hapus');
                        row.remove();
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                    })
                    .catch(error => {
                        console.error('Hapus error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal menghapus data.'
                        });
                    });
                }
            });
        }
    });
});
</script>
@endsection
