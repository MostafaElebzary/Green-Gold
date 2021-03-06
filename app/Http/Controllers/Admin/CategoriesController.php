<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{

    public $objectName;
    public $folderView;
    public $flash;


    public function __construct(Category $model)
    {
        $this->middleware('auth');
        $this->objectName = $model;
        $this->folderView = 'admin.category.';
        $this->flash = 'Category Data Has Been ';

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->objectName::all();

        return view($this->folderView.'index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->folderView.'create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $input = $request->all();

        $this->objectName::create($input);

        return redirect()->route('categories.index')->with('success',$this->flash.' Created');
        

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
        $data = $this->objectName::find($id);
        
        return view($this->folderView.'edit', compact('data'));
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
        $request->validate([
            'name' => 'required|string',
        ]);

        $input = $request->all();
 
        $this->objectName::find($id)->update($input);

        return redirect()->route('categories.index')->with('success',$this->flash.' Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	try {
	        $chcek = $this->objectName::findOrFail($id);
	        if ($chcek)
	        {
	            $this->objectName::find($id)->delete();

	            return redirect()->route('categories.index')->with('success', $this->flash.' Deleted');
	        }
	        else
	        {
	            return redirect()->route('categories.index')->with('danger', 'Not Found ID !!');
	        }
    	} catch (Exception $e) {
    		return redirect()->route('categories.index')->with('danger', 'Error '.$e);
    	}
    }
}

