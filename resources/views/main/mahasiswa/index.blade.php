@extends('templates.master')

@section('page-title', 'Mahasiswa')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Data Mahasiswa Maganga
                        </div>  
                        <div class="col-6 col-6 d-flex align-items-center">
                            <div class="m-auto"></div>
                            <div class="form-group" style="margin-right: 2px">
                                <select name="divisi" id="divisi" class="form-control-lg divisi" name="divisi">
                                    @foreach ($divisi as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body render">
                    {{-- data rendered --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/mahasiswa/main.js')}}"></script>
@endpush