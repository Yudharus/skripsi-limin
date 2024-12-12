@extends('home')
<script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<h2 class="text-2xl font-bold mb-4">Data Petugas</h2>
<form method="GET" action="{{ route('data.petugas') }}">
    <label for="default-search" class="mb-2 text-sm font-medium sr-only text-white">Search</label>
    <div class="relative mb-8">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input name="search" id="default-search" value="{{ request('search') }}" 
        class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" 
               placeholder="Nama Petugas" required />
        <button type="submit" 
        class="text-white absolute end-2.5 bottom-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Search</button>
                @if(request('search'))
            <a href="{{ route('data.petugas') }}" 
            class="absolute end-24 bottom-2.5 bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 hover:bg-gray-600 focus:ring-gray-700">
                Reset
            </a>
            @endif
    </div>
</form>

<!-- Modal toggle -->
<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block mb-5 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button">
  Tambah
</button>

<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-black">
                    Tambah Data Petugas
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
            <form id="petugasForm" method="POST" action="{{ route('data-petugas.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_admin">Nama Petugas</label>
                        <input type="text" name="nama_admin" id="nama_admin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                        <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input type="text" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                <div class='flex flex-row'>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Simpan</button>
                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 focus:ring-gray-700 bg-gray-800 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editPetugasModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-black">
                    Edit Data Petugas
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="editPetugasModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
            <form id="petugasForm" method="POST" action="{{ url('/data-petugas/update') }}">
                    @csrf
                    @method('POST')
                    <input type='hidden' id='editIdAdmin' name='id_admin' value="{{ $admin->id_admin }}"/>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_admin">Nama Petugas</label>
                        <input type="text" name="nama_admin" id="nama_admin_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                        <input type="text" name="username" id="username_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input type="text" name="password" id="password_edit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                <div class='flex flex-row'>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Simpan</button>
                    <button data-modal-hide="editPetugasModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 focus:ring-gray-700 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border">Nama Petugas</th>
            <th class="py-2 px-4 border">Username</th>
            <th class="py-2 px-4 border">Password</th>
            <th class="py-2 px-4 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            <td class="py-2 px-4 border">{{ $data->nama_admin }}</td>
            <td class="py-2 px-4 border">{{ $data->username }}</td>
            <td class="py-2 px-4 border">{{ $data->password }}</td>
            <td class="py-2 px-4 border flex flex-row">
            
                <button data-modal-target="editPetugasModal" data-modal-toggle="editPetugasModal" class='btn-edit w-full bg-yellow-500 hover:bg-yellow-500 rounded-md p-2 text-white'
                data-id="{{ $data->id_admin }}"
                onclick="adam({{$data->id_admin}})"
                >Edit</button>
                <button class="btn-delete w-full bg-red-500 hover:bg-red-600 rounded-md p-2 text-white ml-2"
                onclick="confirmDelete({{$data->id_admin}})"
                >Hapus</button>
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
                url: "/data-petugas/"+id,
                success:function(data){
                    $('#editIdAdmin').val(data.id_admin)

                    $('#nama_admin_edit').val(data.nama_admin)
                    $('#username_edit').val(data.username)
                    $('#password_edit').val(data.password)
                }
            })
    }

    const confirmDelete = (id) => {
    Swal.fire({
        title: "Apakah anda yakin akan menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, call delete function
            deletePetugas(id);
        }
    });
};

// Function to delete petugas via AJAX
const deletePetugas = (id) => {
    console.log(id)
    $.ajax({
        method: 'DELETE',
        url: "/data-petugas/" + id,
        data: {
            _token: "{{ csrf_token() }}" // Include CSRF token for security
        },
        success: function(response) {
            // Handle success, you may show a success message or remove the row from the table
            Swal.fire("Deleted!", "The petugas has been deleted.", "success");
            // Optionally, you can remove the row from the table or refresh the page
            // $("#row-" + id).remove();
            location.reload(); // Refresh page to update the data
        },
        error: function(xhr, status, error) {
            Swal.fire("Sukses menghapus data!");
            location.reload(); // Refresh page to update the data
        }
    });
};

@if (session('successStorePetugas'))
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('successStorePetugas') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

@if (session('successUpdatePetugas'))
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session('successUpdatePetugas') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection
