<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DepartmentModel as Department;
use App\Model\DoctorModel as Doctor;
use App\Model\PatientModel as Patient;
use Validator;
use Storage;
use File;
use Image;

class DepartmentController extends Controller
{
    public $page_title;
    public function __construct()
    {
        $this->page_title = "Deparment";
        $this->middleware('auth:admin');
    }
    
    public function getDepartmentRelatedDoctors($id){
        $department = Department::find($id);
        if(empty($department)){
            abort(404);
        }
        $check = "Department Doctors";
        $page_title = $department->title." - Department Doctors";
        $department_doctor = Doctor::whereRaw('FIND_IN_SET("'.$id.'", specialization_id)')->get();
        return view('admin.doctor.doctor-list', compact('department_doctor', 'page_title', 'check'));
    }
    public function getDepartmentRelatedPatients($id){
        $department = Department::find($id);
        if(empty($department)){
            abort(404);
        }
        $check = "Department Patients";
        $page_title = $department->title." - Department Patients";
        $department_patient = Patient::whereRaw('FIND_IN_SET("'.$id.'", depart_id)')->get();
        // dd($department_patient);
        return view('admin.patient.patient-list', compact('department_patient', 'page_title', 'check'));
    }
    public function index()
    {
        $page_title = $this->page_title;
        $department = Department::all();
        return view('admin.department.list', compact('department', 'page_title'));

 
    }

    public function create()
    {
        // $brandForSelect2 = Department::where('parent_id', null)->orderBy('title')->get();
        $page_title = $this->page_title;
        return view('admin.department.create', compact('page_title'));

    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'       => 'required|unique:specilizations',
            // 'slug'       => 'required|unique:department'
        ]);
		
        if($validator->fails()) {
           return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $department = new Department();
        $department->title = $request->title;
        // $department->slug = $request->slug;
        $department->status = $request->status;
        if (!is_null($request->description) && $request->has('description')) {
            $department->description = $this->SummernoteImageFilter($request->description);
        }
		$department->save();
        $request->session()->flash('status', 'Department has been Added successfully');
        return redirect('/admin/department');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page_title = $this->page_title;
        $department = Department::find($id);

        return view('admin.department.edit', compact('department', 'page_title'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'title'       => 'required|unique:specilizations,title,'.$id.',id',
            // 'slug'       => 'required|unique:specilizations,slug,'.$id.',id',
			]);
		
        if($validator->fails()) {
           return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
		$department = Department::findOrFail($id);
        $department->title = $request->title;
        $department->status = $request->status;
        if (!is_null($request->description) && $request->has('description')) {
            $department->description = $this->SummernoteImageFilter($request->description);
        }

        $department->save();
        $request->session()->flash('status', 'Department has been Updated successfully');
        return redirect('/admin/department');
    }

    public function destroy($id)
    {
        if(Department::destroy($id)){
			echo 1;
		}else{
			echo 0;
		}
       exit;
    }

    public function setPosition(Request $request){
        // echo 234;
        foreach($request->position as $key => $value){
            $department = Department::findOrFail($key);
            $department->position = $value;
            $department->save();
        }
        $request->session()->flash('status', 'Department position has been Updated successfully');
        return redirect('/admin/department');
    }
    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $department = Department::find($request->id);
        $department->status = $request->status;
        $department->updated_at = date('Y-m-d H:i:s');
        if($department->save()){
            echo 1;
        }else{
            echo 2;
        }
        exit;
    }
    public function deleteImage($id) {
        $department = Department::findOrFail($id);
        $image = explode('/images/department/feature/',$department->image);
        // dd($image);
		if(isset($image[1])){
			Storage::disk('Backend')->delete('/department/feature/'.$image[1]);
			$department->image = '';
			if($department->save()){
				echo 1;
			}else{ 
				echo 2;
			}
		}else{
			echo 1;
		}
        exit;
    }


    
    public function SummernoteImageFilter($description){
        
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
        foreach($images as $img){
            $src = $img->getAttribute('src');
            
            if(preg_match('/data:image/', $src)){                
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];                
                $filename = uniqid();
                $filepath = "/images/admin/department/$filename.$mimetype";    
                $image = Image::make($src)
                  // resize if required
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)
                  ->save(public_path($filepath));                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        return $dom->saveHTML(); 
    }

}
