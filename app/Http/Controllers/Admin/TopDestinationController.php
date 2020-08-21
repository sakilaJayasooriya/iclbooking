<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TopDestinationDataTable;
use App\Models\TopDestination;
use Validator;
use App\Http\Helpers\Common;


class TopDestinationController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(TopDestinationDataTable $dataTable)
    {
        return $dataTable->render('admin.topDestinations.view');
    }
    public function add(Request $request)
    {
        if (! $_POST) {
             return view('admin.topDestinations.add');
        } elseif ($_POST) {
            $rules = array(
                    'title'    => 'required|max:100',
                    'image'   => 'required',
                    'status'  =>'required'
                    );

            $fieldNames = array(
                        'title'    => 'Top Destination Name',
                        'image'   => 'Image',
                        'status'  =>'Status'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);


            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $image     =   $request->file('image');
                $extension =   $image->getClientOriginalExtension();
                $filename  =   'starting_city_'.time() . '.' . $extension;

                $success = $image->move('public/front/images/top_destinations', $filename);
        
                if (! $success) {
                    return back()->withError('Could not upload Image');
                }

                $newTd = new TopDestination;

                $newTd->title  = $request->title;
                $newTd->image = $filename;
                $newTd->status=$request->status;
                $newTd->descripion=$request->description;

               

                $newTd->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/top-destinations');
            }
        } else {
            return redirect('admin/settings/top-destinations');
        }
    }
    public function update(Request $request)
    {
        if (! $_POST) {
             $data['result'] = TopDestination::find($request->id);

             return view('admin.topDestinations.edit', $data);
        } elseif ($_POST) {
            $rules = array(
                'title'    => 'required|max:100',
                'status'  =>'required'
                );

            $fieldNames = array(
                    'title'    => 'Top Destination Name',
                    'status'  =>'Status'
                    );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $newTd =TopDestination::find($request->id);

                $newTd->title  = $request->title;
                $newTd->status=$request->status;
                $newTd->descripion=$request->description;
                
                $image     =   $request->file('image');

                if ($image) {
                    $extension =   $image->getClientOriginalExtension();
                    $filename  =   'starting_city_'.time() . '.' . $extension;
    
                    $success   = $image->move('public/front/images/top_destinations', $filename);
        
                    if (! $success) {
                         return back()->withError('Could not upload Image');
                    }

                    $newTd->image = $filename;
                }

                $newTd->save();

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/settings/top-destinations');
            }
        } else {
            return redirect('admin/settings/top-destinations');
        }
    }
    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            $delTd = TopDestination::find($request->id);
            $file_path       = public_path().'/front/images/top_destinations/'.$delTd->image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            TopDestination::find($request->id)->delete();
            $this->helper->one_time_message('success', 'Deleted Successfully');
        }
        
        return redirect('admin/settings/top-destinations');
    }



    
}
