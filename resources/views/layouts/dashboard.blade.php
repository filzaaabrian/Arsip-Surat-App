@extends('layouts._main.main')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                            <div class="card-body" >
                            <h5 class="card-title text-primary">SELAMAT DATANG DI APLIKASI ARSIP SURAT</h5>
                            <p class="mb-4">
                                Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</br>
                                klik <span class="fw-bold">"Upload Surat"</span> untuk mengarsipkan surat.
                            </p>
                            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <!-- Search -->
                            <div class="navbar-nav  col-lg-10">
                                <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0" ></i>
                                <form action="/dashboard" method="GET">
                                {{-- @csrf --}}
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-0  "
                                    placeholder="Cari Surat Disini..."
                                    aria-label="Search..."
                                />
                                </form>
                                </div>
                            </div>
                            <div class="navbar-nav  col-lg-2">
                            <a
                                href=""
                                type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCenter"
                                >Upload Surat</a
                            >
                            </div>
                            <!-- /Search -->
                            </div>
                            </div>
                    </div>
                    </div>
                </div>
                    
                <!-- Hoverable Table rows -->
                <div class="card">
                    <h5 class="card-header">Data Arsip Surat</h5>
                    <div class="table-responsive text-nowrap mb-4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($surats as $surat)
                            <tr>
                                <td>1</td>
                                <td><strong>{{$surat->nomor_surat}}</strong></td>
                                <td>{{$surat->kategori_surat}}</td>
                                <td>{{$surat->judul_surat}}</td>
                                <td>{{$surat->waktu_pengarsipan}}</td>
                                <td>
                                <div class="dropdown">
                                <a href="{{route('dashboard.show',['dashboard'=>$surat])}}"
                                class="btn btn-sm btn-outline-primary" type="button">Lihat</a>
                                
                                <a href="{{Route('download', ['filename' => $surat->file_surat]) }}" type="button"
                                class="btn btn-sm btn-outline-success"
                                >Download</a>

                                <form class="d-inline"
                                                action="{{route('dashboard.destroy',['dashboard'=>$surat])}}"
                                                role="alert" method="POST" alert-title="Hapus Arsip"
                                                alert-text="Apakah anda yakin ingin menghapus arsip surat ini?"
                                                alert-btn-cancel="Batal" alert-btn-yes="Iya">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    
                </div>
                <!--/ Hoverable Table rows -->

                </div>
            </div>
            <!-- / Content -->
    
                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-primary" id="modalCenterTitle">FORM UPLOAD SURAT</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <form action="{{url('/upload/proses')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">Nomor Surat</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="nomorsurat"
                                      placeholder="Masukkan Nomor Surat Disini"
                                    />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">Judul Surat</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="judulsurat"
                                      placeholder="Masukkan Judul Surat Disini"
                                    />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">Kategori Surat</label>
                                    <select
                                    class="form-select"
                                    id="inputGroupSelect04"
                                    name="kategorisurat"
                                    aria-label="Example select with button addon"
                                    values="Pilih Kategori"
                                    >
                                    @foreach($kategories as $kategori)
                                      <option>{{$kategori->nama_kategori}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">File Surat (PDF)</label>
                                    <input
                                      type="File"
                                      class="form-control"
                                      name="filesurat"
                                      placeholder="Enter Name"
                                      accept="application/pdf"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">Upload</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--End Modal-->

                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetailPDF" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-primary" id="modalCenterTitle">Detail Surat</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                    <div class="row">
                                      <div class="col mb-3">
                                        <label class="form-label">File Surat (PDF)</label>
                                        <iframe src="" width="500" height="400"></iframe>
                                      </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success">Download</button>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <!--End Modal Detail-->

                    <!-- Modal -->
                    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-primary" id="modalCenterTitle">FORM EDIT SURAT</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <form action="{{url('/upload/proses')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">Nomor Surat</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="nomorsurat"
                                      placeholder="Masukkan Nomor Surat Disini"
                                    />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">Judul Surat</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="judulsurat"
                                      placeholder="Masukkan Judul Surat Disini"
                                    />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">Kategori Surat</label>
                                    <select
                                    class="form-select"
                                    id="inputGroupSelect04"
                                    name="kategorisurat"
                                    aria-label="Example select with button addon"
                                    >
                                      <option selected disabled>Pilih Kategori...</option>
                                    @foreach($kategories as $kategori)
                                      <option>{{$kategori->nama_kategori}}</option>
                                    @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label class="form-label">File Surat (PDF)</label>
                                    <input
                                      type="File"
                                      class="form-control"
                                      name="filesurat"
                                      placeholder="Enter Name"
                                      accept="application/pdf"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">Upload</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--End Modal-->
@endsection