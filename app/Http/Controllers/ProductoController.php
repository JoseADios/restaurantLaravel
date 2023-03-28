<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Producto;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    
    public function callbackFacebook(){
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $findUser = User::where('fb_id', $facebookUser->id)->first();

            if ($findUser) {
                Auth::login(($findUser));
                return redirect()->intended('productos');
            }else{
                $newUser = User::create([
                    'name'=> $facebookUser->name,
                    'email'=> $facebookUser->email,
                    'fb_id'=> $facebookUser->id,
                ]);
                Auth::login(($newUser));
                return redirect()->intended('productos');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index')->with('productos', $productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto();

        $producto->codigo = $request->get('codigo');
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        
        $request->validate(['imagen' => 'required|image|mimes:jpeg,png,svg|max:1024']);

        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto['imagen'] = "$imagenProducto";
        }

        try {
            $producto->save();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error']);
        }

        return redirect('/productos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return view('producto.edit')->with('producto', $producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);

        $producto->codigo = $request->get('codigo');
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');

        $request->validate(['imagen' => 'image|mimes:jpeg,png,svg|max:1024']);
        
        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto['imagen'] = "$imagenProducto";
        }else{
            unset($producto['imagen']);
        }

        try {
            $producto->save();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error'.$e->getMessage()]);
        }

        return redirect('/productos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect('/productos');
    }
}