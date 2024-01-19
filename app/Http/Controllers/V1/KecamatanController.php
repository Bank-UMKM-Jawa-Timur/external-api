<?php
namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    public function listKecamatan(Request $request){
        $status = '';
        $req_status = Response::HTTP_OK;
        $message = '';
        $data = null;
        $req = $request->all();

        try{
            $validator = Validator::make($req, [
                'id_kabupaten' => 'required'
            ], [
                'id_kabupaten.required' => 'ID kabupaten harus diisi.'
            ]);

            if($validator->fails()){
                $req_status = Response::HTTP_UNPROCESSABLE_ENTITY;
                $status = 'gagal';
                $message = $validator->errors()->all();
            } else{
                $data = DB::table('kecamatan')->select('id', 'id_kabupaten', 'kecamatan')
                    ->where('id_kabupaten', $request->get('id_kabupaten'))
                    ->orderBy('id', 'asc')
                    ->get();
                $status = 'berhasil';
                $message = 'Berhasil menampilkan data kecamatan.';
            }
        } catch(Exception $e){
            $req_status = Response::HTTP_BAD_REQUEST;
            $status = 'gagal';
            $message = $e->getMessage();
        } catch(QueryException $e){
            $req_status = Response::HTTP_BAD_REQUEST;
            $status = 'gagal';
            $message = $e->getMessage();
        } finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $req_status);
        }
    }
}
