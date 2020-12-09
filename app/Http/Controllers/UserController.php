<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::users()->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::where('id', '>', 1)->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'rut' => 'required|cl_rut',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'role_id' => 'required'
        ];
        $messages = [
            'rut.required' => 'Debe ingresar un RUT',
            'rut.cl_rut' => 'Debe ingresar un RUT válido',
            'name.required' => 'Es necesario ingresar un nombre',
            'role_id.required' => 'Debe escoger un rol',
            'name.min' => 'El nombre debe tener como minimo 3 caracteres'
        ];
        $this->validate($request, $rules);

        //Inserción
        User::create(
            $request->only('rut', 'name', 'middlename', 'lastname', 'mothername', 'email', 'role_id')
            + [
                'password' => bcrypt($request-> input('password'))
            ]
        );

        $notification = 'El usuario se registró correctamente';
        return redirect('/users')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::users()->findOrFail($id);
        $roles = Role::where('id', '>', 1)->get();
        $role_ids = User::find($user->id)->role_id;

        return view('users.edit', compact('user', 'roles', 'role_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'rut' => 'required|cl_rut',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'role_id' => 'required'
        ];
        $messages = [
            'rut.required' => 'Debe ingresar un RUT',
            'rut.cl_rut' => 'Debe ingresar un RUT válido',
            'name.required' => 'Es necesario ingresar un nombre',
            'role_id.required' => 'Debe escoger un rol',
            'name.min' => 'El nombre debe tener como minimo 3 caracteres'
        ];
        $this->validate($request, $rules);

        //Inserción
        $user = User::users()->findOrFail($id);

        $data = $request->only('rut', 'name', 'middlename', 'lastname', 'mothername', 'email', 'role_id');
        $password = $request-> input('password');

        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notification = 'El usuario se actualizó correctamente';
        return redirect('/users')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $notification = 'El usuario se eliminó correctamente';
        return redirect('/users')->with(compact('notification'));

    }
}
