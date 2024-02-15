@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Jadwal Pelajaran - Rio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Menambahkan CSS untuk Mode Gelap -->
        <style>
            body {
                background: #121212; /* Warna latar belakang */
                color: #fff; /* Warna teks */
            }

            .navbar {
                background: #343a40 !important; /* Warna latar belakang navbar */
            }

            .card {
                background: #1e1e1e; /* Warna latar belakang card */
                color: #fff; /* Warna teks card */
            }

            /* Penyesuaian warna teks untuk link */
            a {
                color: #17a2b8;
            }

            /* Menyesuaikan warna tombol */
            .btn {
                background-color: #17a2b8;
                color: #fff;
            }

            /* Menyesuaikan warna tombol pada hover */
            .btn:hover {
                background-color: #138496;
            }

            /* Menyesuaikan warna tabel */
            table {
                color: #fff;
            }

            /* Menyesuaikan warna latar belakang tbody pada tabel */
            tbody {
                background: #1e1e1e;
            }

            /* Menyesuaikan warna tombol pada formulir pencarian */
            .form-inline button {
                background-color: #17a2b8;
                color: #fff;
            }

            /* Menyesuaikan warna tombol pada hover pada formulir pencarian */
            .form-inline button:hover {
                background-color: #138496;
            }

            /* Menyesuaikan warna teks pada kolom "GAMBAR," "JUDUL," "CONTENT," dan "AKSI" */
            th, td {
                color: #fff;
            }
        </style>
    </head>
<body>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pengajar.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="id_guru">Nama Guru</label>
                                <select name="id_guru" id="id_guru" class="form-control">
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_mapel">Nama Mapel</label>
                                <select name="id_mapel" id="id_mapel" class="form-control">
                                    @foreach ($mapels as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kelas</label>
                                <select class="form-control @error('kelas') is-invalid @enderror" name="kelas">
                                    <option value="XII RPL" {{ old('kelas') == 'XII RPL' ? 'selected' : '' }}>XII RPL</option>
                                    <option value="XII DKV" {{ old('kelas') == 'XII DKV' ? 'selected' : '' }}>XII DKV</option>
                                    <option value="XII TKJ" {{ old('kelas') == 'XII TKJ' ? 'selected' : '' }}>XII TKJ</option>
                                    <option value="XII BP" {{ old('kelas') == 'XII BP' ? 'selected' : '' }}>XII BP</option>
                                    <option value="XII LISTRIK" {{ old('kelas') == 'XII LISTRIK' ? 'selected' : '' }}>XII LISTRIK</option>
                                    <option value="XII ELEKTRO" {{ old('kelas') == 'XII ELEKTRO' ? 'selected' : '' }}>XII ELEKTRO</option>
                                </select>

                                <!-- error message untuk kelas -->
                                @error('kelas')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Jam Pelajaran</label>
                                    <select class="form-control @error('jam_pelajaran') is-invalid @enderror" name="jam_pelajaran">
                                        <option value="1" {{ old('jam_pelajaran') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('jam_pelajaran') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('jam_pelajaran') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('jam_pelajaran') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('jam_pelajaran') == '5' ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ old('jam_pelajaran') == '6' ? 'selected' : '' }}>6</option>
                                        <option value="7" {{ old('jam_pelajaran') == '7' ? 'selected' : '' }}>7</option>
                                        <option value="8" {{ old('jam_pelajaran') == '8' ? 'selected' : '' }}>8</option>
                                        <option value="9" {{ old('jam_pelajaran') == '9' ? 'selected' : '' }}>9</option>
                                        <option value="10" {{ old('jam_pelajaran') == '10' ? 'selected' : '' }}>10</option>
                                    </select>

                                    <!-- error message untuk jam_pelajaran -->
                                    @error('jam_pelajaran')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>


@endsection

