<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    /**
     * fillable
     * 
     *  @var array 
     */

    public function pegawai()
    { 
        return $this->hasOne(Pegawai::class, "id", "pegawai_id"); 
    }
    
    protected $fillable = [
        'nama_golongan',
        'pegawai_id',
        'gaji_pokok',
        'tunjangan_keluarga',
        'tunjangan_transport',
        'tunjangan_makan',
    ];
}