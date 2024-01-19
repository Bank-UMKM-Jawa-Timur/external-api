<?php
namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    public function listCabang(){
        $data = [];
        $message = '';
        $status = '';
        $req_status = Response::HTTP_OK;

        try{
            $data = DB::table('cabang')->select('id', 'cabang')
                ->orderBy('id', 'asc')
                ->get();
            $status = 'berhasil';
            $message = 'Berhasil menampilkan list cabang';
        } catch(Exception $e){
            $status = 'gagal';
            $message = $e->getMessage();
            $req_status = Response::HTTP_BAD_REQUEST;
        } catch(QueryException $e){
            $status = 'gagal';
            $message = $e->getMessage();
            $req_status = Response::HTTP_BAD_REQUEST;
        } finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $req_status);
        }
    }

    public function getCabangById(Request $request){
        try{
            $id = $request->get('id');
            $data = DB::table('cabang')->select('id', 'cabang')
                ->where('id', $id)
                ->orderBy('id', 'asc')
                ->get();

            return response()->json([
                'data' => $data
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        } catch(QueryException $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
