<table class="table table-hover table-striped" id="tableData">
    <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Tempat/Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Asal Sekolah</th>
        <th>Status Penerimaan</th>
        <th>Divisi Penempatan</th>
        <th>Status Mahasiswa</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($mahasiswa as $mahasiswa)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$mahasiswa->nama}}</td>
            <td>{{$mahasiswa->tempat_lahir}}/{{date_format(date_create($mahasiswa->tanggal_lahir), 'd-m-Y')}}</td>
            <td>{{$mahasiswa->jenis_kelamin}}</td>
            <td>{{$mahasiswa->asal_sekolah}}</td>
            <td>{{$mahasiswa->pendaftaran->is_approved}}</td>
            <td>{{$mahasiswa->pendaftaran->is_approved == 'Disetujui' ? $mahasiswa->pendaftaran->divisi->nama_divisi : '-'}}</td>
            <td>{{$mahasiswa->is_active == true ? 'Aktif' : 'Tidak Aktif'}}</td>   
            <td>
                <button class="btn btn-validasi {{$mahasiswa->is_active == true ? 'btn-danger' : 'btn-info'}}" data-uuid="{{$mahasiswa->uuid}}">
                    <i class="fa {{$mahasiswa->is_active == true ? 'fa fa-ban' : 'fa-check-circle'}} text-success ml-2 pointer"></i> {{$mahasiswa->is_active == true ? 'Non-Aktifkan' : 'Aktifkan'}}
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    var table = $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            },
            info: "Showing _START_ to _END_ from _TOTAL_ data",
            infoEmpty: "Showing 0 to 0 from 0 data",
            lengthMenu: "Showing _MENU_ data",
            search: "Search:",
            emptyTable: "Data doesn't exists",
            zeroRecords: "Data doesn't match",
            loadingRecords: "Loading..",
            processing: "Processing...",
            infoFiltered: "(filtered from _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
        order: [[0, 'desc']],
        "rowCallback": function(row, data, index) {
            // Set the row number as the first cell in each row
            $('td:eq(0)', row).html(index + 1);
        }
    });

    // Update row numbers when the table is sorted
    table.on('order.dt search.dt', function() {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
</script>