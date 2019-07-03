<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = [
        //     'nama' => $request['nama'],
        //     'email' => $request['email'],
        // ];
        // Contact::create($data);
        $data = $request->all();
        $data['foto'] = null;

        if ($request->hasFile('foto')) {
            $data['foto'] = '/upload/foto/' . time() . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto/'), $data['foto']);
        }

        Contact::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Contact Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact=Contact::find($id);
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $contact = Contact::find($id);
        // $contact->nama = $request['nama'];
        // $contact->email = $request['email'];
        // $contact->update();
        // return $contact;

        $data = $request->all();
        $contact = Contact::findOrFail($id);

        $data['foto'] = $contact->foto;

        if ($request->hasFile('foto')) {
            if (!$contact->foto == NULL) {
                unlink(public_path($contact->foto));
            }
            $data['foto'] = '/upload/foto/' . time() . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto/'), $data['foto']);
        }

        $contact->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Contact Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        if (!$contact->foto == NULL) {
            unlink(public_path($contact->foto));
        }

        Contact::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Contact Deleted'
        ]);
    }
    public function apiContact(){
        $contact = Contact::all();

        return Datatables::of($contact)
            ->addColumn('show_photo', function ($contact) {
                if ($contact->foto == NULL) {
                    return '<img class="rounded-square" width="50" height="50" src="/upload/foto/profile_default.png"/>';
                }
                return '<img class="rounded-square" width="50" height="50" src="' . url($contact->foto) . '" alt=""/>';
            })
            ->addColumn('action', function ($contact) {
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm(' . $contact->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $contact->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['show_photo', 'action'])->make(true);
    }
}
