<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    public function create(Request $request){
        $validation = Validator::make($request->all(), [
            'nis' => 'required|max:10',
            'nama_lengkap'=>'required|string',
            'jk'=>'required|max:1',
            'alamat'=>'required|string',
        ]);

        if($validation->fails()){
            $errors = $validation->errors();
            return[
                'status' => 'error',
                'message' => $errors,
                'result' =>null
            ];
        }

        $result = \App\Siswa::create($request->all());
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
        $result = \App\Siswa::all();
        return[
            'status'=>'success',
            'message'=>'',
            'result'=>$result
        ];
    }

    public function update(Request $request,$id){
            $validation = Validator::make($request->all() ,[
                'nis'=>'required|max:10',
                'nama_lengkap'=>'required|string',
                'jk'=>'required|max:1',
                'alamat'=>'required|string',

            ]);

            if($validation->fails()){
                $errors = $validation->errors();
                return[
                    'status' => 'error',
                    'message' => $errors,
                    'result' => null
                ];
            }

            $siswa= \App\Siswa::find($id);
            if(empty($siswa)){
                return[
                    'status' => 'error',
                    'message' => 'Data Tidak Ditemukan',
                    'result' => null
                ];
            }

            $result =  $siswa->update($request->all());
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
        $siswa = \App\Siswa::find($id);
        if(empty($siswa)){
            return[
                'status'=>'error',
                'message'=>'Data Tidak Ditemukan',
                'result'=>null
            ];
        }

        $result = $siswa->delete($id);
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

    public function detail($id){
        $siswa = Siswa::find($id);
        if(empty($siswa)){
            return[
                'status'=>'error',
                'message'=>'Data Tidak Ditemukan',
                'result'=>null
            ];
        }
        return[
                'status'=>'success',
                'result'=>$siswa
        ];
    }

}
