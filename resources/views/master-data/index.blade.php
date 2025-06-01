@extends('master-data.layout.main')
@section('title')
    Master Data SuperAdmin
    
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="h4 fw-semibold text-dark mb-3">Shift Data</p>

                    <button class="btn btn-primary mb-3" id="add-row">+ Tambah Shift</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="shift-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Shift</th>
                                    <th>Description</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $data = \App\Models\ShftM::all(); @endphp
                                @foreach ($data as $d)
                                <tr data-id="{{ $d->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td contenteditable="true" class="editable" data-field="shift">{{ $d->shift }}</td>
                                    <td contenteditable="true" class="editable" data-field="description">{{ $d->description }}</td>
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

    {{-- Team Lead --}}
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="h4 fw-semibold text-dark mb-3">Team Leader Data</p>
                    @php 
                                    $data = \App\Models\TeamLeadM::all(); 
                                    $allUsers = \App\Models\User::where('role', 0)->get();
                                    $typeOptions = [
                                        // "SP" => "Ship Mark",
                                        "MP" => "Mapping",
                                        "FC" => "Form Check",
                                        "OP" => "Open Packing",
                                        "PL" => "Packing List",
                                        // "CK" => "Checklist Kendaraan",
                                        "SL" => "Scan Layout",
                                        "CD" => "Coil Damage",
                                        "L8" => "Packing L08",
                                    ];
                                @endphp
                    <button class="btn btn-primary mb-3" id="add-rowtl">+ Tambah Team Leader</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="teamlead-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Active</th>
                                    <th>Name</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $d)
                            <tr data-id="{{ $d->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <select class="form-select select-user">
                                        @foreach($allUsers as $user)
                                            <option value="{{ $user->id }}" data-name="{{ $user->name }}" {{ $d->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <div class="ml-3 form-check form-check-inline type-checkboxes">
                                        @php $selectedTypes = json_decode($d->type, true) ?? []; @endphp
                                        @foreach ($typeOptions as $key => $label)
                                            <input class="form-check-input type-checkbox me-2" type="checkbox" id="type_{{ $d->id }}_{{ $key }}" value="{{ $key }}"
                                                {{ in_array($key, $selectedTypes) ? 'checked' : '' }}>
                                            <label class="form-check-label me-2" for="type_{{ $d->id }}_{{ $key }}">{{ $label }}</label>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select select-active">
                                        <option value="1" {{ $d->active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $d->active == 0 ? 'selected' : '' }}>Nonactive</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control input-name" value="{{ $d->name }}">
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-row">Hapus</button>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kondisi --}}
        


</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function saveChange(id, field, value) {
        fetch(`{{ route('superadmin.teamlead.update', '') }}/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ field, value })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Berhasil!', 'Data berhasil diupdate.', 'success');
            } else {
                Swal.fire('Gagal!', 'Gagal update data.', 'error');
            }
        })
        .catch(() => {
            Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
        });
    }

    // On name change
    document.querySelectorAll('.input-name').forEach(input => {
        input.addEventListener('blur', function () {
            const tr = this.closest('tr');
            const id = tr.dataset.id;
            saveChange(id, 'name', this.value.trim());
        });
    });

    // On type checkbox change
    document.querySelectorAll('.type-checkboxes').forEach(container => {
        container.querySelectorAll('.type-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const tr = this.closest('tr');
                const id = tr.dataset.id;
                const checkedValues = Array.from(tr.querySelectorAll('.type-checkbox:checked')).map(c => c.value);
                saveChange(id, 'type', JSON.stringify(checkedValues));
            });
        });
    });

    // On active select change
    document.querySelectorAll('.select-active').forEach(select => {
        select.addEventListener('change', function () {
            const tr = this.closest('tr');
            const id = tr.dataset.id;
            saveChange(id, 'active', this.value);
        });
    });

    // On user select change (auto fill name)
    document.querySelectorAll('.select-user').forEach(select => {
        select.addEventListener('change', function () {
            const tr = this.closest('tr');
            const id = tr.dataset.id;
            const userId = this.value;
            const nameInput = tr.querySelector('.input-name');
            const selectedOption = this.options[this.selectedIndex];
            const name = selectedOption.text;

            nameInput.value = name;
            saveChange(id, 'user_id', userId);
            saveChange(id, 'name', name);
        });
    });

    // Add new row
    document.getElementById('add-rowtl').addEventListener('click', function () {
        const tableBody = document.querySelector('#teamlead-table tbody');
        const newRow = document.createElement('tr');

        const typeCheckboxHtml = `
            @foreach ($typeOptions as $key => $label)
                <input class="form-check-input type-checkbox" type="checkbox" value="{{ $key }}" id="new_type_{{ $key }}">
                <label class="form-check-label me-2" for="new_type_{{ $key }}">{{ $label }}</label>
            @endforeach
        `;

        const userOptionsHtml = `
            <option value="">-- Pilih User --</option>
            @foreach($allUsers as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        `;

        newRow.innerHTML = `
            <td></td>
            <td>
                <select class="form-select select-user-new">${userOptionsHtml}</select>
            </td>
            <td>
                <input type="text" class="form-control input-name-new" value="" readonly>
            </td>
            <td>
                <div class="form-check form-check-inline type-checkboxes">${typeCheckboxHtml}</div>
            </td>
            <td>
                <select class="form-select select-active-new">
                    <option value="1" selected>Active</option>
                    <option value="0">Nonactive</option>
                </select>
            </td>
            <td>
                <button class="btn btn-success btn-sm save-row">Simpan</button>
            </td>
        `;

        tableBody.appendChild(newRow);

        const userSelect = newRow.querySelector('.select-user-new');
        const nameInput = newRow.querySelector('.input-name-new');

        userSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            nameInput.value = selectedOption.text;
        });

        newRow.querySelector('.save-row').addEventListener('click', function () {
            const tr = this.closest('tr');
            const user_id = tr.querySelector('.select-user-new').value;
            const name = tr.querySelector('.input-name-new').value;
            const active = tr.querySelector('.select-active-new').value;
            const checkedTypes = Array.from(tr.querySelectorAll('.type-checkbox:checked')).map(c => c.value);

            fetch(`{{ route('superadmin.teamlead.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    user_id,
                    name,
                    type: JSON.stringify(checkedTypes),
                    active
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', 'Data berhasil ditambahkan.', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', 'Gagal tambah data.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
            });
        });
    });

    // Delete row
    document.querySelector('#teamlead-table').addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-row')) {
            const row = e.target.closest('tr');
            const id = row.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('superadmin.teamlead.destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Terhapus!', 'Data telah dihapus.', 'success');
                            row.remove();
                        } else {
                            Swal.fire('Gagal!', 'Gagal hapus data.', 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error!', 'Terjadi kesalahan.', 'error'));
                }
            });
        }
    });
});
</script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let counter = {{ count($data) + 1 }};

    // Tambah baris baru
    document.getElementById('add-row').addEventListener('click', function() {
        const table = document.querySelector('#shift-table tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${counter++}</td>
            <td contenteditable="true" class="new" data-field="shift"></td>
            <td contenteditable="true" class="new" data-field="description"></td>
            <td><button class="btn btn-success btn-sm save-row">Simpan</button></td>
        `;
        table.appendChild(row);
    });

    // Simpan data baru
    document.querySelector('#shift-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('save-row')) {
            const row = e.target.closest('tr');
            const shift = row.querySelector('[data-field="shift"]').innerText.trim();
            const description = row.querySelector('[data-field="description"]').innerText.trim();

            fetch(`{{ route("superadmin.shifts.store") }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ shift, description })
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
                    text: 'Gagal menyimpan data. Cek konsol untuk detail.'
                });
            });
        }
    });

    // Inline update saat blur
    document.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('blur', function() {
            const field = this.dataset.field;
            const value = this.innerText.trim();
            const id = this.closest('tr').dataset.id;

            fetch(`{{ route('superadmin.shifts.update', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
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
                    text: 'Data berhasil diupdate!'
                });
            })
            .catch(error => {
                console.error('Update error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengupdate data. Cek konsol untuk detail.'
                });
            });
        });
    });

    // Hapus data
    document.querySelector('#shift-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-row')) {
            const row = e.target.closest('tr');
            const id = row.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('superadmin.shifts.delete', ['id' => 'ID_PLACEHOLDER']) }}`.replace('ID_PLACEHOLDER', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal hapus');
                        row.remove();
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                    })
                    .catch(error => {
                        console.error('Hapus error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal menghapus data. Cek konsol untuk detail.'
                        });
                    });
                }
            });
        }
    });
});
</script>


@endsection
