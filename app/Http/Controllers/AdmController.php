<?php

namespace App\Http\Controllers;

use App\Models\Adm;
use Illuminate\Http\Request;

class AdmController extends Controller
{
    public function index()
    {
        $adm = Adm::latest()->get();
        return view('index', compact('adm'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:50',
            'password' => 'required'
        ]);

        $post = Adm::create([
            'nama' => $request->nama,
            'password' => $request->password
        ]);

        if ($post) {
            return redirect()
                ->route('adm.index')
                ->with([
                    'success' => 'New Adm has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function edit($id)
    {
        $adm = Adm::findOrFail($id);
        return view('edit', compact('adm'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:50',
            'password' => 'required'
        ]);

        $post = Adm::findOrFail($id);

        $post->update([
            'nama' => $request->nama,
            'password' => $request->password
        ]);

        if ($post) {
            return redirect()
                ->route('adm.index')
                ->with([
                    'success' => 'Admin has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    public function destroy($id)
    {
        $post = Adm::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('adm.index')
                ->with([
                    'success' => 'Admin has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('adm.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
