@extends('home')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@section('content')
<h2 class="text-2xl font-bold mb-4">Data Pendaftaran</h2>
<form method="GET" action="{{ route('verifikasi.pendaftaran') }}">
    <label for="default-search" class="mb-2 text-sm font-medium sr-only text-white">Search</label>
    <div class="relative mb-8">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input name="search" id="default-search" value="{{ request('search') }}" 
               class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" 
               placeholder="Nama / NIK" required />
        <button type="submit" 
                class="text-white absolute end-2.5 bottom-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Search</button>
                @if(request('search'))
            <a href="{{ route('verifikasi.pendaftaran') }}" 
            class="absolute end-24 bottom-2.5 bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 hover:bg-gray-600 focus:ring-gray-700">
                Reset
            </a>
            @endif
    </div>
</form>
<table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border">Nama</th>
            <th class="py-2 px-4 border">NIK</th>
            <!-- <th class="py-2 px-4 border">No.KTP</th> -->
            <th class="py-2 px-4 border">Nama Dokter</th>
            <th class="py-2 px-4 border">Spesialis</th>
            <th class="py-2 px-4 border">Keluhan</th>
            <th class="py-2 px-4 border">Tanggal Pendaftaran</th>
            <!-- <th class="py-2 px-4 border">Verifikasi</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            <td class="py-2 px-4 border">{{ $data->nama_lengkap }}</td>
            <td class="py-2 px-4 border">{{ $data->nik }}</td>
            <!-- <td class="py-2 px-4 border">{{ $data->no_ktp }}</td> -->
            <td class="py-2 px-4 border">{{ $data->nama_dokter }}</td>
            <td class="py-2 px-4 border">{{ $data->spesialis }}</td>
            <td class="py-2 px-4 border">{{ $data->keluhan }}</td>
            <td class="py-2 px-4 border">{{ $data->created_at }}</td>
            <!-- <td class="py-2 px-4 border">
                <form action="{{ route('verifikasi.updateStatus', $data->id_pasien) }}" method="POST" id="form-verifikasi-{{ $data->id_pasien }}">
                    @csrf
                    @method('PUT')
                    <select name="status_pendaftaran" onchange="document.getElementById('form-verifikasi-{{ $data->id_pasien }}').submit()" class="border rounded p-1">
                        <option value="Diterima" {{ $data->status_pendaftaran == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ $data->status_pendaftaran == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </form>
            </td> -->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('script')

<script>
    @if (session('successUpdateStatus'))
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('successUpdateStatus') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection

