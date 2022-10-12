@extends('layouts._main.main')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <form action="{{route('dashboard.update',['dashboard'=>$dashboard])}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between col-12">
                      <div>
                        <h5 class="mb-0 text-primary">FORM DETAIL SURAT</h5>
                      </div>
                      <div>
                        <a href="{{route('dashboard.index')}}"  class="btn btn-sm btn-outline-success">Kembali</a>
                        <!-- <button type="submit" class="btn btn-sm btn-outline-primary">Update</button> -->
                      </div>
                    </div>
                    <div>
                      
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nomor Surat</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="nomorsurat" value="{{$dashboard->nomor_surat}}">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Surat</label>
                          <div class="col-sm-10">
                          <select
                                    class="form-select"
                                    id="inputGroupSelect04"
                                    name="kategorisurat"
                                    aria-label="Example select with button addon" values="{{$dashboard->nomor_surat}}"
                                    >
                                    @foreach($kategories as $kategori)
                                      <option>{{$kategori->nama_kategori}}</option>
                                    @endforeach
                                    </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Judul Surat</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$dashboard->judul_surat}}" name="judulsurat">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">File Surat</label>
                          <div class="col-sm-10">
                                    <input
                                      type="File"
                                      class="form-control"
                                      name="filesurat"
                                      placeholder="Enter Name"
                                      accept="application/pdf"
                                      value="{{$dashboard->file_surat}}"
                                    />
                                </div>
                        </div>
                        <div class="row mb-3">
                          <iframe src="{{asset('/storage/'.$dashboard->file_surat)}}"height="1000"></iframe>
                        </div>
                        <div class="row justify-content-end">
                          <!-- <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div> -->
                        </div>
                    </div>
                  </div>
                </div>
                <form>
              </div>
            </div>
            <!-- / Content -->
@endsection