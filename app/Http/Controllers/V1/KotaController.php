<?php
namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class KotaController extends Controller
{
    public function listKota(){
        $message = '';
        $status = '';
        $req_status = Response::HTTP_OK;
        $data = [];
        try{
            $message = 'Berhasil menampilkan list kabupaten';
            $status = 'berhasil';

            $data = DB::table('kabupaten')->select('id', 'kabupaten')
                ->orderBy('id', 'asc')
                ->get();
        } catch(Exception $e){
            $message = $e->getMessage();
            $status = 'gagal';
            $req_status = Response::HTTP_BAD_REQUEST;
        } catch(QueryException $e){
            $message = $e->getMessage();
            $status = 'gagal';
            $req_status = Response::HTTP_BAD_REQUEST;
        } finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $req_status);
        }
    }
}
