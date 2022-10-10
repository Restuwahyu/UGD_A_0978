@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Golongan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('golongan')}}">Golongan</a>
                    </li>
                    <li class="breadcrumb-item active">Index</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('golongan.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                            GOLONGAN</a>
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">NIP Pegawai</th>
                                        <th class="text-center">Golongan</th>
                                        <th class="text-center">Gaji Pokok</th>
                                        <th class="text-center">Tunjangan Keluarga</th>
                                        <th class="text-center">Tunjangan Transport</th>
                                        <th class="text-center">Tunjangan Makan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody> @forelse ($golongan as $item)
                                    <tr>
                                        <td class="text-center">{{$item->pegawai->nomor_induk_pegawai }}</td>
                                        <td class="text-center">{{$item->nama_golongan }}</td>
                                        <td class="text-center">@currency($item->gaji_pokok)</td>
                                        <td class="text-center">@currency($item->tunjangan_keluarga)</td>
                                        <td class="text-center">@currency($item->tunjangan_transport)</td>
                                        <td class="text-center">@currency($item->tunjangan_makan)</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('golongan.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('golongan.edit', $item->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger"> Data Golongan belum tersedia </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">{{$golongan->links()}}</div>
                        </div>
                    </div><!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div>
<script>
@if(Session::has('success'))
toastr.success("{{ Session::get('success')}}")
@endif
</script>
@endsection