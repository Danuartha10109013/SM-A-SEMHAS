@extends('master-data.layout.main')

@section('title')
    Master Data SuperAdmin Division
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="h4 fw-semibold text-dark mb-3">Data Division</p>

                    <button class="btn btn-primary mb-3" id="add-division">+ Tambah Divisi</button>

                    {{-- Route references --}}
                    <a href="{{ route('superadmin.division.store') }}" id="route-store" class="d-none"></a>
                    <a href="" id="route-update" class="d-none" data-template="{{ route('superadmin.division.update', '__id__') }}"></a>
                    <a href="" id="route-delete" class="d-none" data-template="{{ route('superadmin.division.delete', '__id__') }}"></a>

                    @php
                        $typeOptions = [
                            "MP" => "Mapping",
                            "FC" => "Form Check",
                            "OP" => "Open Packing",
                            "PL" => "Packing List",
                            "SL" => "Scan Layout",
                            "CD" => "Coil Damage",
                            "L8" => "Packing L08",
                        ];
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-bordered" id="division-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Division</th>
                                    <th>Keterangan</th>
                                    {{-- <th>Type</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr data-id="{{ $d->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="editable" contenteditable="true" data-field="division">{{ $d->division }}</td>
                                        <td class="editable" contenteditable="true" data-field="keterangan">{{ $d->keterangan }}</td>
                                        {{-- <td>
                                            <div class="form-check form-check-inline type-checkboxes">
                                                @php $selectedTypes = json_decode($d->type, true) ?? []; @endphp
                                                @foreach ($typeOptions as $key => $label)
                                                    <input class="form-check-input type-checkbox me-2" type="checkbox" id="type_{{ $d->id }}_{{ $key }}" value="{{ $key }}"
                                                        {{ in_array($key, $selectedTypes) ? 'checked' : '' }}>
                                                    <label class="form-check-label me-2" for="type_{{ $d->id }}_{{ $key }}">{{ $label }}</label>
                                                @endforeach
                                            </div>
                                        </td> --}}
                                        <td>
                                            <button class="btn btn-success btn-save d-none">Simpan</button>
                                            <button class="btn btn-danger btn-delete" data-id="{{ $d->id }}">Hapus</button>
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

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const storeURL = document.getElementById("route-store").href;
    const updateURLTemplate = document.getElementById("route-update").dataset.template;
    const deleteURLTemplate = document.getElementById("route-delete").dataset.template;

    // Tambah baris baru
    document.getElementById("add-division").addEventListener("click", function () {
        const tableBody = document.querySelector("#division-table tbody");

        const newRow = `
            <tr data-id="new">
                <td>Baru</td>
                <td class="editable" contenteditable="true" data-field="division"></td>
                <td class="editable" contenteditable="true" data-field="keterangan"></td>
                <td>
                    <div class="form-check form-check-inline type-checkboxes">
                        @foreach ($typeOptions as $key => $label)
                            <input class="form-check-input type-checkbox me-2" type="checkbox" id="type_new_{{ $key }}" value="{{ $key }}">
                            <label class="form-check-label me-2" for="type_new_{{ $key }}">{{ $label }}</label>
                        @endforeach
                    </div>
                </td>
                <td>
                    <button class="btn btn-success btn-save">Simpan</button>
                    <button class="btn btn-danger btn-delete d-none">Hapus</button>
                </td>
            </tr>`;
        tableBody.insertAdjacentHTML("afterbegin", newRow);
    });

    // Simpan manual saat tombol simpan diklik
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-save")) {
            const row = e.target.closest("tr");
            row.querySelectorAll(".editable")[0].focus(); // Trigger focusout
        }
    });

    // Simpan otomatis saat blur dari kolom
    document.addEventListener("focusout", function (e) {
        const cell = e.target;
        if (cell.classList.contains("editable")) {
            const row = cell.closest("tr");
            simpanAtauUpdate(row);
        }
    });

    // Simpan otomatis saat checkbox type diubah
    document.querySelector("#division-table").addEventListener("change", function (e) {
        if (e.target.classList.contains("type-checkbox")) {
            const row = e.target.closest("tr");
            simpanAtauUpdate(row);
        }
    });

    // Fungsi simpan/update baris
    function simpanAtauUpdate(row) {
        const id = row.dataset.id;
        const division = row.querySelector('[data-field="division"]').innerText.trim();
        const keterangan = row.querySelector('[data-field="keterangan"]').innerText.trim();

        const checkboxes = row.querySelectorAll(".type-checkbox");
        const selectedTypes = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (!division) return;

        const url = id === "new"
            ? storeURL
            : updateURLTemplate.replace('__id__', id);
        const method = id === "new" ? "POST" : "PUT";

        fetch(url, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ division, keterangan, type: selectedTypes })
        }).then(res => res.json())
          .then(data => {
            if (data.success) {
                Swal.fire('Berhasil', data.message, 'success');
                if (id === "new") {
                    row.setAttribute("data-id", data.id);
                    row.children[0].innerText = "#";
                    row.querySelector(".btn-save").classList.add("d-none");
                    row.querySelector(".btn-delete").classList.remove("d-none");
                }
            } else {
                Swal.fire('Gagal', data.message, 'error');
            }
          }).catch(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan', 'error');
          });
    }

    // Hapus data
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-delete")) {
            const row = e.target.closest("tr");
            const id = row.dataset.id;

            if (id === "new") {
                row.remove();
                return;
            }

            const deleteURL = deleteURLTemplate.replace('__id__', id);

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteURL, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(res => res.json())
                      .then(data => {
                        if (data.success) {
                            Swal.fire('Terhapus!', data.message, 'success');
                            row.remove();
                        } else {
                            Swal.fire('Gagal', data.message, 'error');
                        }
                      });
                }
            });
        }
    });
});
</script>

@endsection
