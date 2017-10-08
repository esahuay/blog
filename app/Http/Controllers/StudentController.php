<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Laracasts\Flash\Flash;
use App\Student;
use App\User;
use App\Tag;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('id','ASC')->paginate(20);
        return view('student.users.index')->with('students',$students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        return view('student.users.create')
            ->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(StudentRequest $request)
    {
        //
        $Student = new Student($request->all());
        $Student->password = bcrypt($request->password);
        $Student->save();
        $idcol[0] = \Auth::user()->id;


        // actualizar la tabla muchos a muchos
        $Student->college()->sync($idcol);
        $Student->tags()->sync($request->tags_id);

        Flash::success("Se ha registrado " . $Student->name . " de forma exitosa"); //<!--  Enviar mensajes a otra pagina -->
        return redirect()->route('admin.students.index');
    }
 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        $Student = Student::find($id);
        $my_tags = $Student->tags->lists('id')->ToArray();

        return view('student.users.edit')
        ->with('Student',$Student)
        ->with('my_tags',$my_tags)
        ->with('tags',$tags);
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
        $Student = Student::find($id);
        $Student -> name = $request -> name;
        $Student -> email = $request->email;
        $Student->save();
        $Student->tags()->sync($request->my_tags);
        Flash::warning('El estudiante ' . $Student->name . ' a sido editado con exito!');
        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Student = Student::find($id);
        $id_el = $Student->id;
        $Student->delete();

        Flash::error('El estudiante: ' . $Student->name . ' a sido borrado de forma exitosa');
        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('student.users.view');
    }

    /**
    *
    */
    public function home()
    {
        $id = \Auth::user('student')->id;
        $Student = Student::find(1);
        $tags = $Student->tags();
        return view('student.users.view')
        ->with('tags',$tags);
    }
}
