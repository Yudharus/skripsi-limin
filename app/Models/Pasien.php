<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nik', 'no_ktp', 'nama_lengkap', 'jenis_kelamin',
        'tanggal_lahir', 'alamat', 'no_telepon', 'tempat_lahir',
        'agama', 'pendidikan', 'kota', 'kode_pos',
        'desa_kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
        'rt_rw', 'pekerjaan', 'kewarganegaraan'
    ];
}
