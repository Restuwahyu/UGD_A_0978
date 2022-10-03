<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
   /**
     * fillable
     * 
     * @var array
     */
    public function departemen()
        {
            return $this->hasOne(Departemen::class,"id","id_departemen");
        }

    protected $fillable = [
        'nomor_induk_pegawai',
        'nama_pegawai',
        'id_departemen',
        'email',
        'telepon',
        'gender',
        'tanggal_bergabung',
        'status',
     ];
}