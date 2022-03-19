@extends('inventory')
@section('title')
    <title>History Transaksi</title>
@endsection
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center mt-3">
                <div class="col-lg-8">
                    <div class="row">
                        {{-- @foreach ($items as $row) --}}
                            <div class="col-lg-3">
                                <div class="border p-3 text-center">
                                    <h4 class="mb-1">Kode Barang</h4>
                                    <h4 class="mb-3" style="text-transform: uppercase;"><strong>{{ $items->code }}</strong></h4>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border p-3 text-center">
                                    <h4 class="mb-1">Nama Barang</h4>
                                    <h4 class="mb-3" style="text-transform: uppercase;"><strong>{{ $items->name }}</strong></h4>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border p-3 text-center">
                                    <h4 class="mb-1">Total Stock</h4>
                                    <h4 class="mb-2"><strong>{{ $items->stock }}</strong></h4>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border p-3 text-center">
                                    <h4 class="mb-1">Stock Minimal</h4>
                                    <h4 class="mb-3"><strong>{{ $items->stock_min }}</strong></h4>
                                </div>
                            </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3 class="mb-sm-0">History Transaksi &nbsp;
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Data
                            </button>
                        </h3>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item h4"><a href="{{ route('items.index') }}">Inventory</a></li>
                                <li class="breadcrumb-item h4 active" aria-current="page">History</li>
                            </ol>
                        </nav>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="custom-validation" action="{{ route('history.update', $items->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3 mt-lg-0">
                                                <h5 class="font-size-14 mb-3">Jenis Transaksi</h5>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type" id="inlineRadios1" value="1" checked>
                                                    <label class="form-check-label" for="inlineRadios1">
                                                        Menambah
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type" id="inlineRadios2" value="0">
                                                    <label class="form-check-label" for="inlineRadios2">
                                                        Mengurangi
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Jumlah</label>
                                                <div>
                                                    <input data-parsley-type="number" type="text"
                                                            name="amount"
                                                            class="form-control" required
                                                            placeholder="Hanya Masukkan Angka"/>
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
                                    <th>Tanggal Transaksi</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Jumlah</th>
                                    {{-- <th>Stock</th>
                                    <th>Status Stock</th>
                                    <th>Aksi</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($history as $row)
                                    <tr>
                                        <td>{{$no++;}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>
                                            @if ($row->type === 0)
                                                <h4 class="ml-3 mr-3"><span class="badge bg-warning d-flex justify-content-center">Mengurangi</span></h4>
                                            @elseif($row->type != 0)
                                                <h4 class="ml-3 mr-3"><span class="badge bg-success d-flex justify-content-center">Menambah</span></h4>
                                            @endif
                                        </td>
                                        <td class="text-center">{{$row->amount}}</td>
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
            </div> <!-- end row -->}

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @endsection
