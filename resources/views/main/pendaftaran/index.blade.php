@extends('templates.master')

@section('page-title', 'Pendaftaran')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/pendaftaran/main.js')}}"></script>
@endpush