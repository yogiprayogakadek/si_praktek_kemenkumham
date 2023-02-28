@extends('templates.master')

@section('page-title', 'Divisi')
@section('page-sub-title', 'Data')

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/function/divisi/main.js')}}"></script>
@endpush