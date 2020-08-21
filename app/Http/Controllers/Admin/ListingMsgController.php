<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\ListingMsgDataTable;
use App\Models\ListingMsg;
use Validator;
use App\Http\Helpers\Common;



class ListingMsgController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(ListingMsgDataTable $dataTable)
    {
        return $dataTable->render('admin.listingMsg.view');
    }
    public function add(Request $request)
    {
        if (! $_POST) {
             return view('admin.topDestinations.add');
        } elseif ($_POST) {
            $rules = array(
                    'title'    => 'required|max:100',
                    'sender_id'   => 'required',
                    'receiver_id'  =>'required',
                    'property_id'  =>'required',
                    'msg'  =>'required'
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
    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            ListingMsg::find($request->id)->delete();
            $this->helper->one_time_message('success', 'Deleted Successfully');
        }
        
        return redirect('admin/listing-message');
    }
}
