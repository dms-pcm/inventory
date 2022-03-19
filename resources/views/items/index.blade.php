@extends('inventory')
@section('title')
    <title>Dashboard Inventory</title>
@endsection
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3 class="mb-sm-0">Inventory &nbsp;
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Data
                            </button>
                        </h3>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="custom-validation" action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Kode Barang</label>
                                                <input type="text" name="code" class="form-control" required placeholder="Masukan Kode Barang"/>
                                                @error('code')
                                                <p>{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Nama Barang</label>
                                                <input type="text" name="name" class="form-control" required placeholder="Masukan Nama Barang
                                                @error('name')
                                                <p>{{$message}}</p>
                                                @enderror"/>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Stock Minimal</label>
                                                <div>
                                                    <input data-parsley-type="number" type="text"
                                                            name="stock_min"
                                                            class="form-control" required
                                                            placeholder="Hanya Masukkan Angka"/>
                                                    @error('stock_min')
                                                    <p>{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Stock Awal</label>
                                                <div>
                                                    <input data-parsley-type="number" type="text"
                                                            name="stock"
                                                            class="form-control" required
                                                            placeholder="Hanya Masukkan Angka"/>
                                                    @error('stock')
                                                    <p>{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Minimal Stock</th>
                                    <th>Stock</th>
                                    <th>Status Stock</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($items as $row)
                                    <tr>
                                        <td>{{$no++;}}</td>
                                        <td style="text-transform: uppercase;">{{$row->code}}</td>
                                        <td style="text-transform: capitalize;">{{$row->name}}</td>
                                        <td class="text-center">{{$row->stock_min}}</td>
                                        <td class="text-center">{{$row->stock}}</td>
                                        <td>
                                            @if ($row->stock >= $row->stock_min)
                                                <h4 class="ml-3 mr-3"><span class="badge bg-success d-flex justify-content-center">Aman</span></h4>
                                            @else
                                                <h4 class="ml-3 mr-3"><span class="badge bg-warning d-flex justify-content-center">Dibawah Minimal</span></h4>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('items.destroy', $row->id) }}" method="post" class="col">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('items.edit', $row->id) }}" style="color: rgb(175, 173, 173);" class="h4 mr-3"><i class="fas fa-pen"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="{{ route('history.edit', $row->id) }}" style="color: rgb(175, 173, 173);" class="h4 mr-3"><i class="fas fa-history"></i></a>&nbsp;&nbsp;&nbsp;
                                                <button style="color: rgb(175, 173, 173); background-color: transparent; border-color: transparent;" class="h4 mr-3"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center"><h5>Tidak ada data</h5></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @endsection
