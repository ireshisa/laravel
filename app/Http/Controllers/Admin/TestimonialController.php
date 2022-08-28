<?php


namespace App\Http\Controllers\Admin;


use Larapen\Admin\app\Http\Controllers\PanelController;

class TestimonialController extends PanelController
{


    public function setup()
    {
        $this->xPanel->setModel('App\Models\Advertising');
        $this->xPanel->setRoute(admin_uri('advertisings'));
        $this->xPanel->setEntityNameStrings(trans('admin::messages.advertising'), trans('admin::messages.advertisings'));
        $this->xPanel->denyAccess(['create', 'delete']);
    }


}