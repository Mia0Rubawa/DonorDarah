<?php

namespace App\Http\Controllers\Super\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as AnotherRequest;
use Illuminate\Support\Facades\Request;
use App\Helpers\GetAttributeColumnOfEloquentModel;
use App\Helpers\SetRules;
use App\Models\MasterData\JenisKelamin;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Html\Facades\Html;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class MJenisKelaminController extends Controller
{
    //
    protected $json, $attr, $model, $title;
    public function __construct()
    {
        $this->json =  ['status' => false, 'pesan' => 'Terdapat Kesalahan Sistem Dengan Kode : 500 '];
        $this->attr = GetAttributeColumnOfEloquentModel::getAttributeColumnOfEloquentModel(new JenisKelamin, false);
        $this->model = new JenisKelamin();
        $this->title = 'Jenis Kelamin';
    }
    public function index(Request $request)
    {
        $data['set_attributes'] = $this->attr;
        $data['title'] = $this->title;
        $data['route_data'] = route('super.master_data.jenis_kelamin.data');
        $data['route_createOrUpdate'] = route('super.master_data.jenis_kelamin.createOrUpdate');
        return view('akun.super.master_data.jenis_kelamin', $data);
    }
    public function data(Request $request)
    {
        return DataTables::of($this->model->orderBy('id', 'DESC')->select('*'))
            ->addIndexColumn()
            ->addColumn('action', function ($column) {
                $edit_button = Html::button('Edit')
                    ->attributes(['class' => 'btn btn-warning text-white fw-bolder', 'id' => 'btn_edit', 'data-href' => route('super.master_data.jenis_kelamin.show', ['id' => $column->id])]);
                $delete_button = Html::button('Hapus')
                    ->attributes(['class' => 'btn btn-danger text-white fw-bolder ml-3', 'id' => 'btn_delete', 'data-href' => route('super.master_data.jenis_kelamin.delete', ['id' => $column->id])]);
                return Html::div(
                    $edit_button . $delete_button
                )->attributes(['class' => 'd-flex justify-content-start']);
            })
            ->make(true);
    }
    public function validator(array $data)
    {
        $set_rules = SetRules::setRules($data);
        return Validator::make($data, $set_rules['rules'], $set_rules['messages']);
    }
    public function createOrUpdate(Request $request, $id = null)
    {
        $json = $this->json;
        DB::beginTransaction();
        try {
            $validator = $this->validator($request::except('_token'));
            if ($validator->fails()) {

                $j = 0;
                $pesan = '';
                foreach ($validator->getMessageBag()->toArray() as $key => $error) {

                    foreach ($error as $key => $pesan_error) {
                        $pesan .=  ($j + 1) . '.' . $pesan_error . '</br>';
                    }
                    $j++;
                }
                $json['pesan'] = $pesan;
            } else {
                $data = $this->model->firstOrNew(['id' => $id]);
                $data->text = $request::input('text');
                $data->save();
                DB::commit();
                $json['status'] = true;
                $json['pesan'] = 'Berhasil, Master ' . $this->title . ' Telah ' . ($id ? 'Berubah' : 'Ditambah');
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return Response::json($json);
    }
    public function show($id)
    {
        $json = $this->json;
        try {
            $find = $this->model->find($id);
            if ($find) {
                $find->createOrUpdate = route('super.master_data.jenis_kelamin.createOrUpdate', ['id' => $find->id]);
                DB::commit();
                $json['status'] = true;
                $json['data'] = $find;
            } else {
                $json['pesan'] = 'Master ' . $this->title . ' Tidak Ada';
            }
        } catch (\Exception $e) {
        }
        return Response::json($json);
    }
    public function delete(Request $request, $id)
    {
        $json = $this->json;
        DB::beginTransaction();
        try {
            $find = $this->model->find($id);
            if ($find) {
                $find->delete();
                DB::commit();
                $json['status'] = true;
                $json['pesan'] = 'Berhasil,' . $this->title . ' Telah Terhapus';
            } else {
                $json['pesan'] = 'Master ' . $this->title . ' Tidak Ada';
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return Response::json($json);
    }
}
