@extends('master-data.layout.main')

@section('title')
    Master Data SuperAdmin Kondisi
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="h4 fw-semibold text-dark mb-3">Kondisi Data</p>

                    @php 
                        $kondisi = \App\Models\KondisiM::all(); 
                        $tipe = [
                            "PL" => "Packing List",
                            "SL" => "Scan Layout",
                            "L8" => "Packing L08",
                        ];
                    @endphp

                    <button class="btn btn-primary mb-3" id="add-rowkon">+ Tambah Kondisi</button>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="kondisi-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kondisi</th>
                                    <th>Type</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($kondisi as $d)
                            <tr data-id="{{ $d->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <input type="text" 
                                        name="kondisi[{{ $d->id }}]" 
                                        id="kondisi-{{ $d->id }}" 
                                        class="form-control editable" 
                                        value="{{ $d->kondisi }}">
                                </td>
                                <td>
                                    <div class="ml-3 form-check form-check-inline type-checkboxes">
                                        @php $selectedTypes = json_decode($d->type, true) ?? []; @endphp
                                        @foreach ($tipe as $key => $label)
                                            <input class="form-check-input type-checkbox me-2" 
                                                type="checkbox" 
                                                name="type[{{ $d->id }}][]" 
                                                id="type-{{ $d->id }}-{{ $key }}" 
                                                value="{{ $key }}"
                                                {{ in_array($key, $selectedTypes) ? 'checked' : '' }}>
                                            <label class="form-check-label me-2" for="type-{{ $d->id }}-{{ $key }}">{{ $label }}</label>
                                        @endforeach
                                    </div>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    // Setup global ajax CSRF token (Laravel requirement)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Add new row button click
    $('#add-rowkon').click(function() {
        // Create a new row with input fields and Save button instead of Delete
        let newRow = $(`
            <tr data-id="new">
                <td>New</td>
                <td><input type="text" name="kondisi_new" class="form-control new-kondisi" placeholder="Kondisi"></td>
                <td>
                    <div class="form-check form-check-inline type-checkboxes">
                        @foreach ($tipe as $key => $label)
                            <input class="form-check-input new-type" type="checkbox" name="type_new[]" id="new-type-{{ $key }}" value="{{ $key }}">
                            <label class="form-check-label me-2" for="new-type-{{ $key }}">{{ $label }}</label>
                        @endforeach
                    </div>
                </td>
                <td>
                    <button class="btn btn-success btn-sm save-new">Simpan</button>
                    <button class="btn btn-secondary btn-sm cancel-new">Batal</button>
                </td>
            </tr>
        `);
        $('#kondisi-table tbody').prepend(newRow);
        $('#add-rowkon').prop('disabled', true); // disable add button until done
    });

    // Cancel adding new row
    $('#kondisi-table').on('click', '.cancel-new', function() {
        $(this).closest('tr').remove();
        $('#add-rowkon').prop('disabled', false);
    });

    // Save new row
    $('#kondisi-table').on('click', '.save-new', function() {
        let row = $(this).closest('tr');
        let kondisi = row.find('.new-kondisi').val().trim();

        // Collect checked types
        let types = [];
        row.find('.new-type:checked').each(function() {
            types.push($(this).val());
        });

        if(!kondisi) {
            Swal.fire('Error', 'Kondisi harus diisi', 'error');
            return;
        }

        $.ajax({
            url: "{{ route('superadmin.kondisi.store') }}",
            method: "POST",
            data: {
                kondisi: kondisi,
                type: types,
            },
            success: function(res) {
                Swal.fire('Berhasil', 'Data berhasil ditambahkan', 'success');

                // Replace the new row with a proper one from backend data
                // We will build the row here dynamically
                let tipe = @json($tipe);

                let typeCheckboxes = '';
                $.each(tipe, function(key, label) {
                    let checked = types.includes(key) ? 'checked' : '';
                    typeCheckboxes += `
                        <input class="form-check-input type-checkbox me-2" type="checkbox" 
                               name="type[${res.id}][]" id="type-${res.id}-${key}" value="${key}" ${checked}>
                        <label class="form-check-label me-2" for="type-${res.id}-${key}">${label}</label>
                    `;
                });

                let newTableRow = `
                    <tr data-id="${res.id}">
                        <td>${res.id}</td>
                        <td><input type="text" name="kondisi[${res.id}]" id="kondisi-${res.id}" class="form-control editable" value="${kondisi}"></td>
                        <td><div class="form-check form-check-inline type-checkboxes">${typeCheckboxes}</div></td>
                        <td><button class="btn btn-danger btn-sm delete-row">Hapus</button></td>
                    </tr>
                `;

                row.replaceWith(newTableRow);
                $('#add-rowkon').prop('disabled', false);

                // Optionally, re-index your "No" column here if needed
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menambahkan data', 'error');
            }
        });
    });

    // Update kondisi on input change
    $('#kondisi-table').on('change', '.editable', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        let newValue = $(this).val();

        $.ajax({
            url: "{{ route('superadmin.kondisi.update', '') }}/" + id,
            method: "PATCH",
            data: {
                kondisi: newValue,
            },
            success: function(res) {
                Swal.fire('Berhasil', res.message, 'success');
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Update gagal', 'error');
            }
        });
    });

    // Update type on checkbox change
    $('#kondisi-table').on('change', '.type-checkbox', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');

        // Collect checked type values for this row
        let types = [];
        row.find('.type-checkbox:checked').each(function() {
            types.push($(this).val());
        });

        $.ajax({
            url: "{{ route('superadmin.kondisi.update', '') }}/" + id,
            method: "PATCH",
            data: {
                type: types,
            },
            success: function(res) {
                Swal.fire('Berhasil', res.message, 'success');
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Update gagal', 'error');
            }
        });
    });

    // Delete row with confirmation
    $('#kondisi-table').on('click', '.delete-row', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: "{{ route('superadmin.kondisi.delete', '') }}/" + id,
                    method: "DELETE",
                    success: function(res) {
                        Swal.fire('Terhapus!', res.message, 'success');
                        row.remove();
                        // Optionally, re-index your "No" column here
                    },
                    error: function(xhr) {
                        Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menghapus', 'error');
                    }
                });
            }
        });
    });

});
</script>

@endsection
