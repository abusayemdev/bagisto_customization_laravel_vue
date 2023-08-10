<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class PickupLocationDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('pickup_locations')
        ->leftJoin('courier_zones', 'pickup_locations.courier_zone_id', '=', 'courier_zones.id')
        ->addSelect('pickup_locations.id', 'pickup_locations.name','pickup_locations.address', 'pickup_locations.opening_hours','pickup_locations.price','courier_zones.zone_name');

        $this->addFilter('id', 'pickup_locations.id');
        $this->addFilter('name', 'pickup_locations.name');
        $this->addFilter('address', 'pickup_locations.address');
        $this->addFilter('opening_hours', 'pickup_locations.opening_hours');
        $this->addFilter('price', 'pickup_locations.price');
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
            'index'      => 'name',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'address',
            'label'      => trans('admin::app.datagrid.address'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'opening_hours',
            'label'      => trans('admin::app.datagrid.opening-hours'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'price',
            'label'      => trans('admin::app.datagrid.price'),
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
            'route'  => 'admin.pickup-location.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.pickup-location.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Pickup Location']),
            'icon'         => 'icon trash-icon',
        ]);
    }
}