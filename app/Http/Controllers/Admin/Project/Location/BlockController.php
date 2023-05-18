<?php

namespace App\Http\Controllers\Admin\Project\Location;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\District;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlockController extends Controller
{
               /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $districts = District::where('is_active',1)->get();
        if ($request->ajax()) {
            $blocks = Block::all();

            return DataTables::of($blocks)
            ->addIndexColumn()
            ->setRowId(function ($block) {
                return 'row'.$block->id;
            })
            ->addColumn('District Name', function ($block) {
                return $block->district !=null ? $block->district->name :'';
            })
            ->addColumn('Code', function ($block) {
                return $block->code;
            })
            ->addColumn('Block Name', function ($block) {
                return $block->name;
            })
            ->addColumn('Status', function ($block) {
                $status='';
                if($block->is_active ==1){
                    $status ='Active';
                }else{
                    $status= 'Deactive';
                }
                return $status;
            })

            ->addColumn('action', function($block){
                if($block->is_active ==1){
                    $status = 'Deactivate';
                }else{
                    $status = 'Activate';
                }
                return '<div class="dropdown">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" onClick="editModel('.$block->id.')" href="#">Edit</a>
                        <a class="dropdown-item" href="'.url('project/location/blocks/change-status/'.$block->id).'">'.$status.'</a>

                        </div>
                    </div>';

            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.pages.project.location.block',['districts' => $districts]);

    }

    public function save(Request $request)
    {
        if($request->id !=null){
            $request->validate([
                'district_id' => 'required|numeric',
                'name' => 'required|unique:blocks,name,'.$request->id.',id',
            ]);
        }else{
            $request->validate([
                'district_id' => 'required|numeric',
                'name' => 'required|unique:blocks,name',
            ]);
        }
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $data['code'] = ucfirst(substr( $request->name,0,2));

        recordSave(Block::class,$data,null,null);
        if($request->id !=null){
            return redirect()->back()->with(['success'=>'Block Has been updated successfully.']);
        }
        return redirect()->back()->with(['success'=>'Block Has been created successfully.']);
    }

    public function edit($id)
    {
        $block = block::with('district')->find($id);
        return ok($block);
    }

    public function changeStatus($id)
    {
        $block = Block::find($id);
        $value = !$block->is_active;

        $block->update([
            'is_active' => (int) $value,
        ]);

        return redirect()->back()->with(['success'=>'Block status change successfully.']);
    }
}
