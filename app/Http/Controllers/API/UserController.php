<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function getAll()
    {
        $users = User::all();

        return $this->sendResponse($users, 'Usuarios cargados exitosamente!');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'identification' => 'required|string|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {;
            $keys = '';
            foreach ($validator->errors()->keys() as $valor){
                $keys = $keys . ' ' . $valor;
            }
            return $this->sendError('Los siguientes campos presentan problemas:' . $keys, $validator->errors()->keys());
        }

        $user = new User($request->all());
        $user->password = Hash::make(($request->password == null ? 'root1234' : $request->password));
        $user->save();
        return $this->sendResponse($user, 'Usuario creado exitosamente');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {;
            $keys = '';
            foreach ($validator->errors()->keys() as $valor){
                $keys = $keys . ' ' . $valor;
            }
            return $this->sendError('Los siguientes campos presentan problemas:' . $keys, $validator->errors()->keys());
        }

        $user = User::find($request->id);
        if($user == null) {
            return $this->sendError('El usuario que quiere modificar no existe');
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        if($request->password !== null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $this->sendResponse($user, 'Usuario modificado exitosamente');
    }
}
