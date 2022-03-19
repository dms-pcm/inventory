@extends('inventory')
@section('title')
    <title>Edit Inventory</title>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Inventory</h4>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Inventory</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Inventory</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- @if (is_object($item)) --}}
                            {{-- @foreach($item as $i) --}}
                            <form class="custom-validation" action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Kode Barang</label>
                                    <input type="text" value="{{ $item->code }}" name="code" class="form-control @error('code') is-invalid @enderror" required placeholder="Masukan Kode Barang"/>
                                    @error('code')
                                    <p>{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Barang</label>
                                    <input type="text" name="name" value="{{ $item->name }}" class="form-control @error('name') is-invalid @enderror" required placeholder="Masukan Nama Barang"/>
                                    @error('name')
                                    <p>{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Stock Minimal</label>
                                    <div>
                                        <input data-parsley-type="number" type="text"
                                                name="stock_min"
                                                value="{{ $item->stock_min }}"
                                                class="form-control @error('stock_min') is-invalid @enderror" required
                                                placeholder="Hanya Masukkan Angka"/>
                                        @error('stock_min')
                                        <p>{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">Stock Awal</label>
                                    <div>
                                        <input data-parsley-type="number" type="text"
                                                name="stock"
                                                class="form-control" required
                                                placeholder="Hanya Masukkan Angka"/>
                                    </div>
                                </div> --}}
                                <div class="modal-footer">
                                    <a href="{{ route('items.index') }}" class="btn btn-secondary waves-effect">
                                            Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                            {{-- @endforeach --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @endsection
