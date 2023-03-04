@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    @can('Admin')
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Grafik Mahasiswa Magang
                            </div>
                            <div class="col-6 col-6 d-flex align-items-center">
                                <div class="m-auto"></div>
                                <div class="form-group" style="margin-right: 2px">
                                    {{-- <label for="">Pilih bagian bidang</label> --}}
                                    <select name="kategori" id="kategori" class="form-control-lg" name="kategori">
                                        <option value="">Pilih kategori</option>
                                        <option value="divisi">Total per Divisi</option>
                                        <option value="sekolah">Total per Asal Sekolah</option>
                                    </select>

                                    <select name="jumlah" id="jumlah" class="form-control-lg jumlah">
                                        <option value="">Pilih jumlah</option>
                                        @for ($i = 5; $i <= 25; $i+=5)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                        <option value="semua">Semua</option>
                                    </select>

                                    <button type="button" class="btn btn-outline-primary btn-search mr-2 btn-lg mb-1">
                                        <i class="nav-icon i-File-Search font-weight-bold"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body chart-render">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- mahasiswa --}}
    @can('Mahasiswa')
        <div class="row">
            <div class="col-6 profil-group {{auth()->user()->mahasiswa->pendaftaran->is_approved != 'Disetujui' ? 'm-auto' : ''}}">
                <div class="card mb-4">
                    <div class="card-header">
                        Selamat datang, <strong><i>{{auth()->user()->mahasiswa->nama}}</i></strong>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{asset(auth()->user()->foto)}}" class="img-thumbnail">
                    </div>
                    <div class="card-footer">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{auth()->user()->mahasiswa->nama}}</td>
                                </tr>
                                <tr>
                                    <th>Tempat/Tanggal Lahir</th>
                                    <td>{{auth()->user()->mahasiswa->tempat_lahir}}/{{date_format(date_create(auth()->user()->mahasiswa->tanggal_lahir), 'd-m-Y')}}</td>
                                </tr>
                                <tr>
                                    <th>Asal Sekolah</th>
                                    <td>{{auth()->user()->mahasiswa->asal_sekolah}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><strong><i>{{auth()->user()->mahasiswa->pendaftaran->is_approved}}</i></strong></td>
                                </tr>
                                @if (auth()->user()->mahasiswa->pendaftaran->is_approved == 'Disetujui')
                                    <tr>
                                        <th>Masa Magang</th>
                                        <td>{{auth()->user()->mahasiswa->pendaftaran->masa_magang}} ({{diffDate(auth()->user()->mahasiswa->pendaftaran->masa_magang)}})</td>
                                    </tr>
                                    <tr>
                                        <th>Divisi</th>
                                        <td><strong><i>{{auth()->user()->mahasiswa->pendaftaran->divisi->nama_divisi}}</i></strong></td>
                                    </tr>
                                    <tr>
                                        <th>Surat Penerimaan</th>
                                        <td>
                                            <strong><i><a href="{{asset(auth()->user()->mahasiswa->pendaftaran->surat_penerimaan)}}" target="_blank">Unduh surat</a></i></strong>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (auth()->user()->mahasiswa->pendaftaran->is_approved == 'Disetujui')
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    Divisi Penempatan
                                </div>
                                <div class="col-6 col-6 d-flex align-items-center">
                                    <div class="m-auto"></div>
                                    <div class="form-group" style="margin-right: 2px">
                                        <select name="divisi" id="divisi" class="form-control-lg divisi" name="divisi">
                                            @foreach ($divisi as $key => $value)
                                            <option value="{{$key}}" {{auth()->user()->mahasiswa->pendaftaran->divisi->uuid == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-justify divisi-keterangan">{{auth()->user()->mahasiswa->pendaftaran->divisi->keterangan}}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endcan
@endsection
@can('Admin')
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function () {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = null;

                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }

                function renderChart(kategori, jumlah) {
                    fetch("/dashboard/chart/"+kategori+'/'+jumlah)
                        .then(response => response.json())
                        .then(data => {
                            // Extract labels and data from JSON response
                            var labels = [];
                            var values = [];
                            data.forEach(item => {
                                labels.push(item.label);
                                values.push(item.value);
                            });

                            if (myChart !== null) {
                                myChart.data.labels = labels;
                                myChart.data.datasets[0].data = values;
                                myChart.update();
                            } else {
                                // Otherwise, create the chart for the first time
                                myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Chart Data',
                                            data: values,
                                            backgroundColor: getRandomColor(),
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        maintainAspectRatio: false, // set to false to disable aspect ratio
                                        responsive: true, // set to true to enable resizing with the container
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            }
                        });
                }

                $('body').on('click', '.btn-search', function() {
                    var kategori = $('select[name=kategori] option').filter(':selected').val();
                    var jumlah = $('select[name=jumlah] option').filter(':selected').val();
                    if(kategori == '' || jumlah == '') {
                        Swal.fire(
                            'info',
                            'Mohon pilih kategori dan jumlah',
                            'info'
                        );
                    } else {
                        // $.get("/dashboard/chart/"+kategori+'/'+jumlah, function (data) {
                        //     var
                        // });

                        renderChart(kategori, jumlah);
                    }
                })
            });
        </script>
    @endpush
@endcan
@can('Mahasiswa')
    @push('script')
        <script>
            $(document).ready(function () {
                $('body').on('change', '.divisi', function() {
                    let uuid = $('select[name="divisi"] option').filter(':selected').val();

                    if(uuid != '') {
                        $.get("dashboard/divisi/"+uuid, function (data) {
                            let keterangan = data.keterangan;
                            $('.divisi-keterangan').text(keterangan);
                        });
                    } else {
                        $('.divisi-keterangan').html('<h3 class=text-center>Mohon pilih divisi yang lainnya untuk info lebih lengkap</h3>');
                    }
                })
            });
        </script>
    @endpush
@endcan