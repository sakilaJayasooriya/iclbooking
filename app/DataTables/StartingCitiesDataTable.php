<?php

namespace App\DataTables;

use App\Models\StartingCities;
use Yajra\Datatables\Services\DataTable;

class StartingCitiesDataTable extends DataTable
{
    protected $exportColumns = ['name', 'image'];

    public function ajax()
    {
        $startingCities = $this->query();

        return $this->datatables
            ->of($startingCities)
            ->addColumn('image', function ($startingCities) {
                return '<img src="' . $startingCities->image_url . '" width="200" height="100">';
            })
            ->addColumn('action', function ($startingCities) {
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-cities/' . $startingCities->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a href="' . url('admin/settings/delete-starting-cities/' . $startingCities->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('name', function ($startingCities) {
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-cities/' . $startingCities->id) . '">' . $startingCities->name . '</a>';
            })
            ->addColumn('city_description', function ($startingCities) {
                //this addcolmn added newly
                if($startingCities->description_city!=null){
                    $city_des='<p>' .substr($startingCities->description_city,0,20). '.......</p>';
                }
                else{
                    $city_des='<p>Empty</p>';
                }
                return $city_des;
            })
            ->addColumn('city_weather', function ($startingCities) {
                //this addcolmn added newly
                if($startingCities->weather!=null){
                    $weather='<p>' .$startingCities->weather. '</p>';
                }
                else{
                    $weather='<p>Empty</p>';
                }
                return $weather;
            })
            ->addColumn('city_population', function ($startingCities) {
                //this addcolmn added newly
                if($startingCities->population!=null){
                    $population='<p>' .$startingCities->population. '</p>';
                }
                else{
                    $population='<p>Empty</p>';
                }
                return $population;
            })
            ->addColumn('city_mayor', function ($startingCities) {
                //this addcolmn added newly
                if($startingCities->mayor!=null){
                    $mayor='<p>' .$startingCities->mayor. '</p>';
                }
                else{
                    $mayor='<p>Empty</p>';
                }
                return $mayor;
            })
            ->addColumn('city_municipality', function ($startingCities) {
                //this addcolmn added newly
                if($startingCities->municipality!=null){
                    $municipality='<p>' .$startingCities->municipality. '</p>';
                }
                else{
                    $municipality='<p>Empty</p>';
                }
                return $municipality;
            })
            ->make(true);
    }

    public function query()
    {
        $startingCities = StartingCities::select();
        return $this->applyScopes($startingCities);
    }

    public function html()
    {
        return $this->builder()
        ->columns([
            'name',
            'image',
        ])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
        ->addColumn(['data' => 'city_description', 'name' => 'properties.city_description', 'title' => 'Description'])
        ->addColumn(['data' => 'city_weather', 'name' => 'properties.city_weather', 'title' => 'Weather'])
        ->addColumn(['data' => 'city_population', 'name' => 'properties.city_population', 'title' => 'Population'])
        ->addColumn(['data' => 'city_mayor', 'name' => 'properties.city_mayor', 'title' => 'Mayor'])
        ->addColumn(['data' => 'city_municipality', 'name' => 'properties.city_municipality', 'title' => 'Municipality'])
        ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => [],
            'pageLength' => \Session::get('row_per_page'),
        ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename()
    {
        return 'spacetypedatatables_' . time();
    }
}
