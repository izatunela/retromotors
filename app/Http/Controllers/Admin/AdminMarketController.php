<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MarketAutomobile;
use App\Models\MarketTruck;
use App\Models\MarketMotorcycle;
use App\Models\MarketParts;
use App\Models\MarketEquipment;

class AdminMarketController extends Controller
{
    private $ajax_layout = 'admin/admin-master-empty';
    private $layout = 'admin/admin-master';

    private function ajaxContent(Request $req,$view,$data){
        if ($req->ajax()) {
            return response()->json(['html'=>view($view,['data'=>$data,'ext'=>$this->ajax_layout])->render()]);
        }
        return view($view,['data'=>$data,'ext'=>$this->layout]);
    }

    public function market()
    {
        return view('admin/market/admin-market-index');
    }
    public function automobile(Request $req)
    {
        $view = 'admin/market/automobile';
        $items = MarketAutomobile::all();
        $del_items = MarketAutomobile::onlyTrashed()->get();
        $data = ['items'=>$items,'del_items'=>$del_items];

        return $this->ajaxContent($req,$view,$data);
    }

    public function marketDelete(Request $req)
    {
        $cat = ucfirst($req->cat);
        $model = '\\App\\Market'.$cat;
        // $item = $model::with('user','brand','country','model')->where('id',$req->id)->get();
        $item = $model::find($req->id);
        $item->delete();
        // return response()->json($item);
        // return $item;
    }

    public function marketRestore(Request $req)
    {
        $cat = ucfirst($req->cat);
        $model = '\\App\\Market'.$cat;
        $item = $model::onlyTrashed()->where('id',$req->id);
        $item->restore();
        $restored = $model::find($req->id);
        $restored->marketAllPhotos()->restore();
    }


    public function motorcycle(Request $req)
    {
        $view = 'admin/market/motorcycle';
        $items = MarketMotorcycle::all();
        $del_items = MarketMotorcycle::onlyTrashed()->get();
        $data = ['items'=>$items,'del_items'=>$del_items];

        return $this->ajaxContent($req,$view,$data);
    }

    public function truck(Request $req)
    {
        $view = 'admin/market/truck';
        $items = MarketTruck::all();
        $del_items = MarketTruck::onlyTrashed()->get();
        $data = ['items'=>$items,'del_items'=>$del_items];

        return $this->ajaxContent($req,$view,$data);
    }

    public function parts(Request $req)
    {
        $view = 'admin/market/parts';
        $items = MarketParts::all();
        $del_items = MarketParts::onlyTrashed()->get();
        $data = ['items'=>$items,'del_items'=>$del_items];

        return $this->ajaxContent($req,$view,$data);
    }

    public function equipment(Request $req)
    {
        $view = 'admin/market/equipment';
        $items = MarketEquipment::all();
        $del_items = MarketEquipment::onlyTrashed()->get();
        $data = ['items'=>$items,'del_items'=>$del_items];

        return $this->ajaxContent($req,$view,$data);
    }
}
