<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    Data Pendaftaran
                </div>
                {{-- @can('Admin')   --}}
                {{-- <div class="col-6 d-flex align-items-center">
                    <div class="m-auto"></div>
                    <button type="button" class="btn btn-outline-primary btn-refresh">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i> Refresh
                    </button>
                </div> --}}
                {{-- @endcan --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama Pendaftar</th>
                    <th>Tanggal Pendaftar</th>
                    <th>Asal Sekolah</th>
                    <th>Lama Magang</th>
                    <th>Status</th>
                    @can('Admin')  
                    <th>Aksi</th>
                    @endcan
                </thead>
                <tbody>
                    @foreach ($pendaftaran as $pendaftaran)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pendaftaran->mahasiswa->nama}}</td>
                        <td>{{date_format(date_create($pendaftaran->tanggal_pendaftaran), 'd-m-Y')}}</td>
                        <td>{{$pendaftaran->mahasiswa->asal_sekolah}}</td>
                        <td>{{$pendaftaran->masa_magang}} ({{diffDate($pendaftaran->masa_magang)}})</td>
                        <td>{{$pendaftaran->is_approved}}</td>
                        {{-- <td>{{$pendaftaran->kategori}}</td> --}}
                        @can('Admin')
                        <td>
                            <button class="btn btn-edit btn-primary" data-uuid="{{$pendaftaran->uuid}}">
                                <i class="fa fa-eye text-success mr-2 pointer" ></i> Lihat
                            </button>
                            {{-- @cannot('Lainnya') --}}
                            {{-- <button class="btn btn-validasi {{$pendaftaran->status == true ? 'btn-danger' : 'btn-info'}}" data-id="{{$pendaftaran->id}}">
                                <i class="fa {{$pendaftaran->status == true ? 'fa fa-ban' : 'fa-check-circle'}} text-success ml-2 pointer"></i> {{$pendaftaran->status == true ? 'Non-Aktifkan' : 'Aktifkan'}}
                            </button> --}}
                            {{-- @endcannot --}}
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Data</h5>
                <button class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}

            </div>
            <div class="modal-body ml-2 mr-2">
                <form id="form">
                    <div class="form-group row">
                        <label for="nama" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Nama Pendaftar
                        </label>
                        <div class="col-lg-11 mt-2">
                            <input type="text" class="form-control nama" name="nama" id="nama">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="tanggal_pendaftaran" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Tanggal Pendaftar
                        </label>
                        <div class="col-lg-11 mt-2">
                            <input type="text" class="form-control" id="tanggal_pendaftaran">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="asal_sekolah" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Asal Sekolah
                        </label>
                        <div class="col-lg-11 mt-2">
                            <input type="text" class="form-control" id="asal_sekolah">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="lama_magang" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Lama Magang
                        </label>
                        <div class="col-lg-11 mt-2">
                            <input type="text" class="form-control" id="lama_magang">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dokumen" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Dokumen Pendaftar
                        </label>
                        <div class="col-lg-9 mt-2">
                            <input type="text" class="form-control" id="dokumen">
                        </div>
                        <div class="col-lg-2 mt-2 text-right">
                            <button type="button" class="btn btn-primary btn-dokumen col-12">Lihat</button>
                        </div>
                    </div>

                    <div class="form-group row status-group">
                        <label for="dokumen" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Status
                        </label>
                        <div class="col-lg-9 mt-2 status-dropdown">
                            <select name="status" id="status" class="form-control">
                                <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mt-2 text-right">
                            <button type="button" class="btn btn-primary btn-status col-12">Ubah</button>
                        </div>
                    </div>

                    <div class="form-group keterangan-group row">
                        <label for="keterangan" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Keterangan
                        </label>
                        <div class="col-lg-11 mt-2">
                            <textarea name="keterangan" id="keterangan" class="form-control keterangan" rows="5"></textarea>
                            <div class="invalid-feedback error-keterangan"></div>
                        </div>
                    </div>

                    <div class="form-group surat-group row">
                        <label class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Surat
                            <br> <span class="label-needed pointer"></span>
                        </label>
                        <div class="col-lg-11 mt-2">
                            <input type="file" class="form-control surat" id="surat" name="surat">
                            <span class="note-surat text-muted text-small"></span>
                            <div class="invalid-feedback error-surat"></div>
                        </div>
                    </div>

                    <div class="form-group divisi-group row">
                        <label class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Divisi
                        </label>
                        <div class="col-lg-11 mt-2">
                            <select name="divisi" id="divisi" class="form-control divisi"></select>
                            <div class="invalid-feedback error-divisi"></div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Simpan</button>
            </div> --}}
        </div>
    </div>
</div>


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

    function updateData(data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/pendaftaran/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                if(response.status != 'info') {
                    $('#modalDetail').modal('hide')
                    getData();
                }
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            }
        });
    }


    $('body').on('click', '.btn-edit', function() {
        var uuid = $(this).data('uuid');

        $('#modalDetail').modal('show')
        $('.label-needed').empty();
        $.get("/pendaftaran/edit/"+uuid, function (data) {
            // console.log(JSON.parse(data.divisi))

            $('#modalDetail .modal-title').text('Data - ' + data.pendaftaran.mahasiswa.nama)
            $('#nama').val(data.pendaftaran.mahasiswa.nama).prop('disabled', true)
            $('#tanggal_pendaftaran').val(data.pendaftaran.tanggal_pendaftaran).prop('disabled', true)
            $('#asal_sekolah').val(data.pendaftaran.mahasiswa.asal_sekolah).prop('disabled', true)
            $('#lama_magang').val(data.pendaftaran.masa_magang).prop('disabled', true)
            $('#dokumen').val(data.pendaftaran.dokumen.split('/')[3]).prop('disabled', true)
            $('.btn-dokumen').attr('data-file', data.pendaftaran.dokumen)
            
            $('#status').val(data.pendaftaran.is_approved).prop('disabled', true)
            $('#status').attr('data-status', data.pendaftaran.is_approved);
            $('.btn-status').attr('data-status', data.pendaftaran.is_approved);
            $('.btn-status').attr('data-uuid', data.pendaftaran.uuid);


            // append divisi
            $('#divisi').empty();
            $.each(data.divisi, function (index, value) { 
                let divisi_option = '<option value='+value.id+'>'+value.nama_divisi+'</option>';
                $('#divisi').append(divisi_option);
            });

            if(data.pendaftaran.is_approved == 'Ditolak') {
                $('.keterangan-group').prop('hidden', false);
                $('#keterangan').val(data.pendaftaran.keterangan).prop('disabled', true)
                $('.surat-group').prop('hidden', true);
                $('.note-surat').empty()
                $('.divisi-group').prop('hidden', true);
            } else if(data.pendaftaran.is_approved == 'Menunggu Konfirmasi') {
                $('.keterangan-group').prop('hidden', true);
                $('.surat-group').prop('hidden', true);
                $('.note-surat').empty()
                $('.divisi-group').prop('hidden', true);
            } else {
                $('.surat').prop('disabled', true);
                $('.keterangan-group').prop('hidden', true);
                $('.surat-group').prop('hidden', false);
                $('.divisi-group').prop('hidden', false);
                $('#divisi').prop('disabled', true)
                $('#divisi').val(data.pendaftaran.divisi_id)

                $('.btn-status').attr('data-divisi', data.pendaftaran.divisi_id);

                let link = '<a href="'+assets(data.pendaftaran.surat_penerimaan)+'" target=_blank>lihat</a>';
                $('.label-needed').empty().append(link)

                $('.note-surat').text('*kosongkan bila tidak ingin mengganti surat')
            }
        });
    });

    $('body').on('click', '.btn-dokumen', function() {
        var file = $(this).data('file');
        window.open(assets(file), '_blank')
    });

    $('body').on('click', '.btn-status', function() {
        $('.status-save').remove();
        
        var status = $(this).data('status');
        var uuid = $(this).data('uuid');
        
        $(this).text('Batal').removeClass(['btn-primary', 'btn-status']).addClass(['btn-danger', 'btn-status-cancle']);
        $('#status').prop('disabled', false)

        // resize status-dropdown
        $('.status-dropdown').removeClass('col-lg-9').addClass('col-lg-7')
        // add button save to status group row
        let btn_save = '<div class="col-lg-2 mt-2 text-right status-save">' + 
                            '<button type="button" class="btn btn-primary btn-status-save col-12" data-uuid="'+uuid+'">Simpan</button>' +
                        '</div>';
        $('.status-group').append(btn_save);

        $('#keterangan').prop('disabled', false)

        $('.surat').prop('disabled', false);
        $('#divisi').prop('disabled', false)
    });

    $('body').on('click', '.btn-status-cancle', function() {
        var status = $(this).data('status');

        $(this).text('Ubah').removeClass(['btn-danger', 'btn-status-cancle']).addClass(['btn-primary', 'btn-status']);
        $('#status').prop('disabled', true)

        $('#status').val(status)
        
        // resize status-dropdown
        if(status == 'Ditolak') {
            $('.keterangan-group').prop('hidden', false);
            $('.surat-group').prop('hidden', true);
            $('.divisi-group').prop('hidden', true);
        } else if(status == 'Menunggu Konfirmasi') {
            $('.surat-group').prop('hidden', true);
            $('.keterangan-group').prop('hidden', true);
            $('.divisi-group').prop('hidden', true);
        } else {
            $('.keterangan-group').prop('hidden', true);
            $('.surat-group').prop('hidden', false);
            $('.surat').prop('disabled', true);
            $('.divisi-group').prop('hidden', false);
            $('#divisi').prop('disabled', true)

            $('#divisi').val($(this).data('divisi'))
        }

        $('.status-dropdown').removeClass('col-lg-7').addClass('col-lg-9')
        $('.status-save').remove();

        // remove error
        $('.keterangan').removeClass('is-invalid');
        $('.error-keterangan').text('')
    });

    $('body').on('change', '#status', function () {
        let status = $('select[name=status] option').filter(':selected').val()

        if(status == 'Ditolak') {
            $('.keterangan-group').prop('hidden', false);
            $('.keterangan').removeClass('is-invalid');
            $('.surat-group').prop('hidden', true);
            $('.error-keterangan').text('')
            $('.divisi-group').prop('hidden', true);
        } else if(status == 'Menunggu Konfirmasi') {
            $('.keterangan-group').prop('hidden', true);
            $('.surat-group').prop('hidden', true);
            $('.divisi-group').prop('hidden', true);
        } else {
            $('.keterangan-group').prop('hidden', true);
            $('.surat-group').prop('hidden', false);
            $('.surat').prop('disabled', false);
            $('.divisi-group').prop('hidden', false);
        }
    })

    // save update
    $('body').on('click', '.btn-status-save', function() {
        let uuid = $(this).data('uuid');
        
        let status = $('select[name=status] option').filter(':selected').val()
        let keterangan = $('.keterangan').val();
        let surat = $('.surat').val();

        let form = $('#form')[0]
        let data = new FormData(form)

        if(status == 'Ditolak') {
            if(keterangan == '') {
                $('.keterangan').addClass('is-invalid');
                $('.error-keterangan').text('Keterangan harus diisi')
            } else {
                $('.keterangan').removeClass('is-invalid');
                $('.error-keterangan').text('')
                updateData(data)
            }
        } else if(status == 'Menunggu Konfirmasi') {
            // $('.status-save').remove();
            updateData(data)
        } else {
            if($('body').find('.label-needed').length == 0) {
                if(surat == '') {
                    $('.surat').addClass('is-invalid');
                    $('.error-surat').text('File surat harus diisi')
                } else {
                    $('.surat').removeClass('is-invalid');
                    $('.error-surat').text('')
                    updateData(data)
                }
            } else {
                $('.surat').removeClass('is-invalid');
                $('.error-surat').text('')
                updateData(data)
            }
        }

    });
</script>