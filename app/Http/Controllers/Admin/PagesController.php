<?php

/**
 * Pages Controller
 *
 * Pages Controller manages Pages by admin.
 *
 * @category   Pages
 * @package    vRent
 * @author     Techvillage Dev Team
 * @copyright  2020 Techvillage
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @email      support@techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PagesDataTable;
use App\Models\Page;
use Validator;
use App\Http\Helpers\Common;

class PagesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.view');
    }
    
    public function add(Request $request)
    {
        if (! $_POST) {
             return view('admin.pages.add');
        } elseif ($_POST) {
            $rules = array(
                    'name'           => 'required|max:100',
                    'url'            => 'required|unique:pages|max:100',
                    'content'        => 'required',
                    'position'       => 'required|max:40'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'url'               => 'Url',
                        'content'           => 'Content',
                        'position'          => 'Position'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $page = new Page;
                $page->name             = $request->name;
                $page->url              = $request->url;
                $page->content          = strip_tags($request->content);
                $page->position         = $request->position;
                $page->status           = $request->status;
                $page->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/pages');
            }
        }
    }

    public function update(Request $request)
    {
        if (!$_POST) {
            $data['result'] = Page::find($request->id);

            return view('admin.pages.edit', $data);
        } else if ($_POST) {
            $rules = array(
                    'name'           => 'required|max:100',
                    'url'            => 'required|max:100',
                    'content'        => 'required',
                    'position'       => 'required|max:40'
                    );

            $fieldNames = array(
                        'name'          => 'Name',
                        'url'           => 'Url',
                        'content'       => 'Content',
                        'position'      => 'Position'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $page = Page::find($request->id);

                $page->name            = $request->name;
                $page->url             = $request->url;
                $page->content         = strip_tags($request->content);
                $page->position        = $request->position;
                $page->status          = $request->status;
                $page->save();

                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/pages');
            }
        }
    }

    public function delete(Request $request)
    {
        Page::find($request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/pages');
    }
}
