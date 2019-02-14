<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class KelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request){
        $validation = Validator::make($request->all(), [
            'nama_kelas' => 'required|max:30',
            'jurusan'=>'required|string|max:30',
        ]);

        if($validation->fails()){
            $errors = $validation->errors();
            return[
                'status' => 'error',
                'message' => $errors,
                'result' =>null
            ];
        }

        $result = \App\Kelas::create($request->all());
        if($result){
            return[
                'status'=>'success',
                'message'=>'Data berhasil ditambahkan',
                'result'=>$result
            ];
        }else{
            return[
            'status'=>'error',
            'message'=>'Data gagal ditambahkan',
            'result'=>null
            ];
        }
    }

    public function read(Request $request){
        $result = \App\Kelas::all();
        return[
            'status'=>'success',
            'message'=>'',
            'result'=>$result
        ];
    }

    public function update(Request $request,$id){
            $validation = Validator::make($request->all() ,[
                'nama_kelas' => 'required|max:30',
                'jurusan'=>'required|string|max:30',

            ]);

            if($validation->fails()){
                $errors = $validation->errors();
                return[
                    'status' => 'error',
                    'message' => $errors,
                    'result' => null
                ];
            }

            $kelas= \App\Kelas::find($id);
            if(empty($kelas)){
                return[
                    'status' => 'error',
                    'message' => 'Data Tidak Ditemukan',
                    'result' => null
                ];
            }

            $result =  $kelas->update($request->all());
            if($result){
                return[
                    'status' => 'success',
                    'message' => 'Data Berhasil Diubah',
                    'result' => $result
                ];
            }else{
                return[
                    'status' => 'error',
                    'message' => 'Data gagal Diubah',
                    'result' => null
                ];
            }
    }

    public function delete(Request $request,$id){
        $kelas = \App\Kelas::find($id);
        if(empty($kelas)){
            return[
                'status'=>'error',
                'message'=>'Data Tidak Ditemukan',
                'result'=>null
            ];
        }

        $result = $kelas->delete($id);
        if($result){
            return[
                'status'=>'success',
                'message'=>'Data Berhasil Dihapus',
                'result'=>$result
            ];
        }else{
            return[
                'status'=>'error',
                'message'=>'Data gagal Dihapus',
                'result'=>null
            ];
        }
    }

}
