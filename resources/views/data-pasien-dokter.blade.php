@extends('home')
<script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>

@section('content')
<h2 class="text-2xl font-bold mb-4">Data Pasien</h2>
<form method="GET" action="{{ route('data.pasien.dokter') }}">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only text-white">Search</label>
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
            <a href="{{ route('data.pasien.dokter') }}" 
            class="absolute end-24 bottom-2.5 bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 hover:bg-gray-600 focus:ring-gray-700">
                Reset
            </a>
            @endif
    </div>
</form>

<div id="editPasienModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-black">
                    Detail Data Pasien
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="editPasienModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
            <form id="pasienForm" method="POST" action="{{ url('/data-pasien/update') }}">
                    @csrf
                    @method('POST')
                    <input type='hidden' id='editIdPasien' name='id_pasien'/>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_dokter">Dokter</label>
                        <select name="nama_dokter" id="nama_dokter_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Pilih Dokter</option>
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->nama_dokter }}">{{ $dokter->nama_dokter }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_kunjungan">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="keluhan">Keluhan</label>
                        <input type="text" name="keluhan" id="keluhan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_kunjungan">Jenis Kunjungan</label>
                        <input type="text" name="jenis_kunjungan" id="jenis_kunjungan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="no_ktp">No. KTP</label>
                        <input type="text" name="no_ktp" id="no_ktp_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nik">NIK</label>
                        <input type="text" name="nik" id="nik_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="no_telepon">Nomor Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tempat_lahir">TTL</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="agama">Agama</label>
                        <input type="text" name="agama" id="agama_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="pendidikan">Pendidikan</label>
                        <input type="text" name="pendidikan" id="pendidikan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kota">Kota</label>
                        <input type="text" name="kota" id="kota_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kode_pos">Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="desa_kelurahan">Desa / Kelurahan</label>
                        <input type="text" name="desa_kelurahan" id="desa_kelurahan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kecamatan">Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kabupaten">Kabupaten</label>
                        <input type="text" name="kabupaten" id="kabupaten_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="provinsi">Provinsi</label>
                        <input type="text" name="provinsi" id="provinsi_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="rt_rw">RT / RW</label>
                        <input type="text" name="rt_rw" id="rt_rw_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="pekerjaan">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kewarganegaraan">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" id="kewarganegaraan_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <!-- <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status_pendaftaran">Status Pendaftaran</label>
                        <input type="text" name="status_pendaftaran" id="status_pendaftaran" value="Diterima" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div> -->
                <div class='flex flex-row'>
                    <button data-modal-hide="editPasienModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 focus:ring-gray-700 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">Tutup</button>
                </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b border-gray-600">
                <!-- <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Simpan</button> -->
            </div>
        </div>
    </div>
</div>

<table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border">Nama</th>
            <th class="py-2 px-4 border">NIK</th>
            <th class="py-2 px-4 border">No.KTP</th>
            <th class="py-2 px-4 border">Nomor HP</th>
            <th class="py-2 px-4 border">Alamat</th>
            <th class="py-2 px-4 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            <td class="py-2 px-4 border">{{ $data->nama_lengkap }}</td>
            <td class="py-2 px-4 border">{{ $data->nik }}</td>
            <td class="py-2 px-4 border">{{ $data->no_ktp }}</td>
            <td class="py-2 px-4 border">{{ $data->no_telepon }}</td>
            <td class="py-2 px-4 border">{{ $data->alamat }}</td>
            <td class="py-2 px-4 border flex flex-row">
            
                <button data-modal-target="editPasienModal" onclick="adam({{$data->id_pasien}})" data-modal-toggle="editPasienModal" class='btn-edit w-full bg-yellow-500 hover:bg-yellow-500 rounded-md p-2 text-white'
                data-id="{{ $data->id_pasien }}">Detail</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('script')

<script>
    const adam = async (id) => {
        $.ajax({
                method: 'GET',
                url: "/data-pasien/"+id,
                success:function(data){
                    $('#editIdPasien').val(data.id_pasien)

                    $('#nama_dokter_edit').val(data.nama_dokter)
                    $('#keluhan_edit').val(data.keluhan)
                    $('#tanggal_kunjungan_edit').val(data.tanggal_kunjungan)
                    $('#jenis_kunjungan_edit').val(data.jenis_kunjungan)
                    $('#no_ktp_edit').val(data.no_ktp)
                    $('#nik_edit').val(data.nik)
                    $('#nama_lengkap_edit').val(data.nama_lengkap)
                    $('#tempat_lahir_edit').val(data.tempat_lahir)
                    $('#tanggal_lahir_edit').val(data.tanggal_lahir)
                    $('#jenis_kelamin_edit').val(data.jenis_kelamin).change();
                    $('#no_telepon_edit').val(data.no_telepon)
                    $('#agama_edit').val(data.agama)
                    $('#pendidikan_edit').val(data.pendidikan)
                    $('#kota_edit').val(data.kota)
                    $('#kode_pos_edit').val(data.kode_pos)
                    $('#desa_kelurahan_edit').val(data.desa_kelurahan)
                    $('#kecamatan_edit').val(data.kecamatan)
                    $('#kabupaten_edit').val(data.kabupaten)
                    $('#provinsi_edit').val(data.provinsi)
                    $('#rt_rw_edit').val(data.rt_rw)
                    $('#pekerjaan_edit').val(data.pekerjaan)
                    $('#kewarganegaraan_edit').val(data.kewarganegaraan)
                    $('#alamat_edit').val(data.alamat)
                }
            })
    }
  document.addEventListener('DOMContentLoaded', function () {
        // Ketika tombol Edit diklik

    });
</script>

@endsection
