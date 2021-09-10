<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule as MasterModel;
use App\Models\Phone;
use Redirect;
use Session;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function __construct() {
        $this->middleware('permissionsSchedule');

        $this->active = "schedules";
        $this->model = "Schedule";
        $this->select = [
            'id',
            'name',
            'email',
            'created_at'
        ];
        // 1 = all
        // 2 = only
        // 3 = exeptions
        $this->request_whit = 1;
        $this->only = [
        ];
        $this->exeptions = [
        ];
        $this->compact = ['word', 'word1', 'active', 'model', 'view', 'columns', 'select', 'actions'];

        //Catalogs
    }

    public function columns()
    {
        $columns = [
            trans('validation.attributes.id'),
            trans('validation.attributes.name'),
            trans('validation.attributes.email'),
            trans('validation.attributes.created_at'),
            trans('validation.attributes.actions'),
        ];

        return $columns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $word = "";
        $word1 = "";
        $active = "";
        $model = "";
        $view = "";
        $columns = "";
        $select = "";
        $actions = "";
        $item = "";
        $phones = [];
        $active = $this->active;
        $model = $this->model;
        $view = 'index';
        $word = trans('module_'.$this->active.'.module_title');
        $columns = $this->columns();
        $select = $this->select;
        // 1 = (show, edit, delete)
        // 2 = (show, edit)
        // 3 = (show, delete)
        // 4 = (edit, delete)
        // 5 = (show)
        // 6 = (edit)
        // 7 = (delete)
        $actions = 1;

        return view('admin.index', compact($this->compact, "item", "phones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $word = "";
        $word1 = "";
        $active = "";
        $model = "";
        $view = "";
        $columns = "";
        $select = "";
        $actions = "";
        $item = "";
        $phones = [];
        $active = $this->active;
        $model = $this->model;
        $word = trans('module_'.$this->active.'.module_title');
        $columns = $this->columns();
        $select = $this->select;

        // Catalogs
        $word1 = trans('module_'.$this->active.'.module_title_s');

        return view('admin.create', compact($this->compact, "item", "phones"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $timestamp = date("Y-m-d H:i:s");

            /*Stored Procedure to save schedule data*/
            $item = DB::select("
                CALL createContact('".$request->name."' ,'".$request->email."' ,'".$request->phone."' ,'".$request->address."', '".$timestamp."')
            ");
            /*Stored Procedure to get last schedule id*/

            /*Get last schedule id*/
            $last_id = DB::select("CALL getLastScheduleId()")[0]->id;

            /* Store phones */
            $phones = $request->phones;

            if( $phones ) {
                ksort($phones);

                foreach( $phones as $phone ) {
                    $item_phone = DB::select("
                        CALL createPhone('".$last_id."', '".$phone."', '".$timestamp."')
                    ");
                }
            }

            DB::commit();

            if( $request->ajax() )
                return response()->json(["status"=>"success", "message" => trans('module_'.$this->active.'.crud.create.success')]);

            return Redirect::route($this->active)->with('success', trans('module_'.$this->active.'.crud.create.success'));
        } catch(Throwable $e) {
            DB::rollback();

            if( $request->ajax() )
                return response()->json(["status"=>"error", "message" => trans('module_'.$this->active.'.crud.create.error')]);

            return Redirect::back()->with('error', trans('module_'.$this->active.'.crud.create.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $word = "";
        $word1 = "";
        $active = "";
        $model = "";
        $view = "";
        $columns = "";
        $select = "";
        $actions = "";
        $item = MasterModel::find($id);
        $phones = Phone::where("schedule_id", $id)->get();

        $active = $this->active;
        $word = trans('module_'.$this->active.'.module_title');
        $word1 = trans('module_'.$this->active.'.module_title_s');

        return view('admin.show', compact($this->compact, 'item', "phones"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $word = "";
        $word1 = "";
        $active = "";
        $model = "";
        $view = "";
        $columns = "";
        $select = "";
        $actions = "";
        $item = MasterModel::find($id);

        $active = $this->active;
        $model = $this->model;
        $word = trans('module_'.$this->active.'.module_title');
        $columns = $this->columns();
        $select = $this->select;

        $phones = Phone::where("schedule_id", $id)->get();

        return view('admin.edit', compact($this->compact, 'item', "phones"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = MasterModel::find($id);

        $requestAll = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
        ];

        $item->fill($requestAll);
        $item2 = true;
        $item3 = 0;

        /*Delete phones in case we update any of them*/
        $del_phones = Phone::where("schedule_id", $item->id)->delete();

        /* Store updated phones */
        $phones = $request->phones;

        if( $phones ) {
            ksort($phones);

            foreach( $phones as $phone ) {
                $requestAll2 = [
                    "schedule_id" => $item->id,
                    "phone" => $phone,
                ];

                $item_phone = Phone::create($requestAll2);

                if( !$item_phone )
                    $item3++;
            }

            if( $item3>0 )
                $item2 = false;
        }

        if($item->save() && $item2){
            if( $request->ajax() ) {
                Session::flash('success', trans('module_'.$this->active.'.crud.update.success'));
                return response()->json(["status"=>"success"]);
            }
            return Redirect::route($this->active)->with('success', trans('module_'.$this->active.'.crud.update.success'));
        }else{
            if( $request->ajax() ) {
                return response()->json(["status"=>"error", "message"=>trans('module_'.$this->active.'.crud.update.error')]);
            }
            return Redirect::back()->with('error', trans('module_'.$this->active.'.crud.update.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(MasterModel::destroy($request->id)){
            return Redirect::route($this->active)->with('success', trans('module_'.$this->active.'.crud.delete.success'));
        }else{
            return Redirect::back()->with('error', trans('module_'.$this->active.'.crud.delete.error'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRestore()
    {
        $word = "";
        $word1 = "";
        $active = "";
        $model = "";
        $view = "";
        $columns = "";
        $select = "";
        $actions = "";
        $active = $this->active;
        $model = $this->model;
        $view = 'delete';
        $word = trans('module_'.$this->active.'.module_title');
        $columns = $this->columns();
        $select = $this->select;
        $actions = 1;
        $word1 = trans('module_'.$this->active.'.module_title_s');

        return view('admin.deleted', compact($this->compact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postRestore(Request $request)
    {
        $item = MasterModel::onlyTrashed()->find($request->id);

        if($item->restore()){
            return Redirect::route($this->active.'.deleted')->with('success', trans('module_'.$this->active.'.crud.restore.success'));
        }else{
            return Redirect::back()->with('error', trans('module_'.$this->active.'.crud.restore.error'));
        }
    }
}
