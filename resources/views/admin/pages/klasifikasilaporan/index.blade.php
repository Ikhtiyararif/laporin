@extends('admin.layouts.default')
@section('page-title', 'Klasifikasi Laporan')

@section('content')
    <div class="p-2">
        <div class="card shadow-lg p-3 bg-body-tertiary p-4">
            @if (Session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session()->has('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('update') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

                <div class="mb-3">
                    <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createKlasifikasiLap"><i class="fa-solid fa-plus"></i> Klasifikasi Laporan</a>
                </div>

                <form id="search" action="{{ route('admin.klasifikasilaporan') }}" method="GET" class="input-group input-group-sm mb-3 w-25">
                    <input id="keyword" name="keyword" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Search Klasifikasi Laporan">
                    <button class="input-group-text" id="inputGroup-sizing-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>


            <!-- Modal -->
            <div class="modal fade" id="createKlasifikasiLap" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="createKlasifikasiLapLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route('pages.add.klasifikasilaporan') }}">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createKlasifikasiLapLabel">Create Klasifikasi Laporan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped text-center table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($klasifikasilaporan as $klasifikasilaporans)
                            <tr>
                                <th class="p-2" scope="row">{{ $loop->iteration }}</th>
                                <td class="p-2">{{ $klasifikasilaporans->title }}</td>
                                <td class="p-2">
                                    <a href="" class="btn bg-warning btn-sm text-white mr-2" data-bs-toggle="modal"
                                        data-bs-target="{{ '#updateKlasifikasiLap' . $klasifikasilaporans->id }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>

                                    <a href="" class="btn bg-danger btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="{{ '#deleteKlasifikasiLap' . $klasifikasilaporans->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="{{ 'updateKlasifikasiLap' . $klasifikasilaporans->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="updateKlasifikasiLapLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form class="modal-content" method="POST"
                                                action="{{ route('pages.update.klasifikasilaporan', ['id' => $klasifikasilaporans->id]) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="updateKlasifikasiLapLabel">Edit Klasifikasi Laporan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-start">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control"
                                                            id="title"
                                                            value="{{ old('title', $klasifikasilaporans->title) }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="{{ 'deleteKlasifikasiLap' . $klasifikasilaporans->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="deleteKlasifikasiLapLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form class="modal-content" method="POST"
                                                action="{{ route('pages.delete.klasifikasilaporan', ['id' => $klasifikasilaporans->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="">
                                                        <div class="text-black mb-2">Are you sure want to delete this item?
                                                        </div>
                                                        <strong>{{ $klasifikasilaporans->title }}</strong>
                                                    </div>
                                                    <hr>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="" id="pagination">{{ $klasifikasilaporan->onEachSide(3)->links() }}</div>
            </div>
        </div>
    </div>

@endsection