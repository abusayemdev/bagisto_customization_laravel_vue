<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class CitiesDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('cities')
        ->leftJoin('courier_zones', 'cities.courier_zone_id', '=', 'courier_zones.id')
        
        ->addSelect('cities.id','cities.name', 'cities.country_code','cities.state_code', 'cities.name','courier_zones.zone_name', 'cities.country_name','cities.state_name');

        $this->addFilter('id', 'cities.id');
        $this->addFilter('name', 'cities.name');
        $this->addFilter('country_code', 'cities.country_code');
        $this->addFilter('state_code', 'cities.state_code');
        $this->addFilter('zone_name', 'courier_zones.zone_name');
        $this->addFilter('country_name', 'cities.country_name');
        $this->addFilter('state_name', 'cities.state_name');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'country_code',
            'label'      => trans('admin::app.datagrid.country-code'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'state_code',
            'label'      => trans('admin::app.datagrid.state-code'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'country_name',
            'label'      => trans('admin::app.datagrid.country-name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'state_name',
            'label'      => trans('admin::app.datagrid.state-name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'zone_name',
            'label'      => trans('admin::app.datagrid.zone-name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.cities.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.cities.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Exchange Rate']),
            'icon'         => 'icon trash-icon',
        ]);
    }
}