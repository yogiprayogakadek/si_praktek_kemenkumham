<div class="col-12">
    <form id="formEdit">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Ubah Dinas
                    </div>
                    <div class="col-6 d-flex align-items-center">
                        <div class="m-auto"></div>
                        <button type="button" class="btn btn-outline-primary btn-data">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i> Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" id="id" value="{{$dinas->id}}">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">
                            Nama Dinas
                        </label>
                        <div class="col-lg-11 mt-2">
                            <input type="text" class="form-control nama" name="nama" id="nama" value="{{$dinas->nama}}" placeholder="masukkan nama dinas">
                            <div class="invalid-feedback error-nama"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn  btn-primary m-1 btn-update">Simpan</button>
                            <button type="button" class="btn btn-outline-secondary m-1 btn-data">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>