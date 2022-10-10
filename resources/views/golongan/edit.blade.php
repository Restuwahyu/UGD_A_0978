@extends('dashboard')
@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Golongan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Golongan</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('golongan.update', $golongan->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Pegawai</label>
                                    <select class="form-control @error('pegawai_id') is-invalid @enderror"
                                        name="pegawai_id">
                                        @foreach ($pegawai as $p)
                                        @if($golongan->pegawai_id==$p->id)
                                        <option selected value="{{$p->id}}">{{$p->nama_pegawai}}</option>
                                        @else
                                        <option value="{{$p->id}}">{{$p->nama_pegawai}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('pegawai_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Nama Golongan</label>
                                    <input type="text" class="form-control @error('nama_golongan') is-invalid @enderror"
                                        name="nama_golongan"
                                        value="{{ old('nama_golongan', $golongan->nama_golongan) }}"
                                        placeholder="Masukkan Nama Golongan">
                                    @error('nama_golongan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Gaji Pokok</label>
                                    <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror"
                                        name="gaji_pokok" value="{{ old('gaji_pokok', $golongan->gaji_pokok) }}"
                                        placeholder="Masukkan Gaji Pokok">
                                    @error('gaji_pokok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Tunjangan Keluarga</label>
                                    <input type="number"
                                        class="form-control @error('tunjangan_keluarga') is-invalid @enderror"
                                        name="tunjangan_keluarga"
                                        value="{{ old('tunjangan_keluarga', $golongan->tunjangan_keluarga) }}"
                                        placeholder="Masukkan Tunjangan Keluarga">
                                    @error('tunjangan_keluarga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Tunjangan Transport</label>
                                    <input type="number"
                                        class="form-control @error('tunjangan_transport') is-invalid @enderror"
                                        name="tunjangan_transport"
                                        value="{{ old('tunjangan_transport', $golongan->tunjangan_transport) }}"
                                        placeholder="Masukkan Tunjangan Transport">
                                    @error('tunjangan_transport')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Tunjangan Makan</label>
                                    <input type="number"
                                        class="form-control @error('tunjangan_makan') is-invalid @enderror"
                                        name="tunjangan_makan"
                                        value="{{ old('tunjangan_makan', $golongan->tunjangan_makan) }}"
                                        placeholder="Masukkan Tunjangan Makan">
                                    @error('tunjangan_makan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>



                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection