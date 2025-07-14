<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4">
                                <h3 class="card-title">Daftar Tamu</h3>
                            </div>
                            <div class="col-lg-8">
                                <button class="btn btn-success float-right">Tambah</button>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->


                    <div class="card-body">
                        <form action="{{ route('tamu.update', $tamu->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama">Masukan Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{$tamu->nama}}">
                                    @error('nama')
                                    <p class="text-sm text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                
                                <div class="form-group col-6">
                                    <label for="nama">Masukan NO-KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" value="{{$tamu->no_ktp}}">
                                     @error('no_ktp')
                                    <p class="text-sm text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="nama">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="{{$tamu->alamat}}">
                                                                        @error('alamat')
                                    <p class="text-sm text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="nama">Masukan NO-WhatsApp</label>
                                    <input type="text" name="no_wa" class="form-control" value="{{$tamu->no_wa}}">
                                                                        @error('no_wa')
                                    <p class="text-sm text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="nama">Keperluan</label> <br>
                                    <input type="radio" name="keperluan" value="Mengirim Surat" {{$tamu->keperluan== "Mengirim Surat"? 'checked':FALSE}} > Mengirim Surat
					                <input type="radio" name="keperluan" value="Kunjungan" {{$tamu->keperluan== "Kunjungan"? 'checked':FALSE}}> Kunjungan<br>
                                      @error('keperluan')
                                    <p class="text-sm text-danger ">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>


                                <div class="form-group col-6">
                                    <label for="nama">Bidang</label>
                                    <select name="bidang_id" class="form-control" >
                                        @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id}}" {{$tamu->bidang_id == $bidang->id ? 'selected' : FALSE}}>{{ $bidang->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('bidang_id')
                                    <p class="text-sm text-danger ">
                                        {{ $message }}
                                    </p>
                                    @enderror



                                    

                                </div>
                                <div class="form-group mx-auto">
                                    <button name="submit" value="submit" type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Simpan</button>
                                    <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
                                </div>
                                    
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</x-app-layout>
