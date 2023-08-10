<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class CountryStatesDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('country_states')
        ->leftJoin('courier_zones', 'country_states.courier_zone_id', '=', 'courier_zones.id')
        ->leftJoin('countries', 'country_states.country_id', '=', 'countries.id')
        ->addSelect('country_states.id', 'country_states.country_code','country_states.code', 'country_states.default_name','courier_zones.zone_name', 'countries.name as country_name');

        $this->addFilter('id', 'country_states.id');
        $this->addFilter('country_code', 'country_states.country_code');
        $this->addFilter('code', 'country_states.code');
        $this->addFilter('default_name', 'country_states.default_name');
        $this->addFilter('country_name', 'countries.name');
        $this->addFilter('zone_name', 'courier_zones.zone_name');

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
            'index'      => 'default_name',
            'label'      => trans('admin::app.datagrid.default-name'),
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
            'index'      => 'code',
            'label'      => trans('admin::app.datagrid.code'),
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
            'route'  => 'admin.countrystates.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.countrystates.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Exchange Rate']),
            'icon'         => 'icon trash-icon',
        ]);
    }
}