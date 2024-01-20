<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class PengajuanModel extends Model
{
    protected $table = "pengajuan";
    protected $dates = ['deleted_at'];
    protected $fillable = [];
}
