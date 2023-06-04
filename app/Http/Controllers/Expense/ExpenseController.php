<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    public $data=[];

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(auth()->user()->role->name == 'admin'){
                $expenses = Expense::with('expanse_type','checkedby','creator','expensable')->latest();
            }else{
                $expenses = Expense::where('created_by',auth()->user()->id)->with('expanse_type','checkedby','creator','expensable')->latest();
            }

            return DataTables::of($expenses)
                    ->addIndexColumn()
                    ->setRowId(function ($expense) {
                        return 'row'.$expense->id;
                    })
                    ->addColumn('Expense Type', function ($expense) {
                        return $expense->expanse_type->name;
                    })
                    ->addColumn('Status', function ($expense) {
                        if($expense->status =='approved'){
                            $status ='<span class="badge bg-success">Approved</span>';
                        }elseif($expense->status =='pending'){
                            $status= '<span class="badge bg-yellow">Pending</span>';
                        }else{
                            $status= '<span class="badge bg-danger">Reject</span>';
                        }
                        return $status;
                    })

                    ->addColumn('Amount', function ($expense) {
                        return ucfirst($expense->amount);
                    })
                    ->addColumn('Description', function ($expense) {
                        return $expense->description;
                    })

                    ->addColumn('Added By', function ($expense) {
                        return $expense->creator ? $expense->creator->name : '';
                    })
                    ->addColumn('Created Date', function ($expense) {
                        return $expense->created_at->format('d-m-Y');
                    })

                    ->addColumn('action', function($expense){


                        if(auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'manager'){
                            return '<div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <a class="dropdown-item" onClick="expenseView('.$expense->id.')" href="#">View</a>
                                <a class="dropdown-item" onClick="updateStatus('.$expense->id.')" href="#">Update Status</a>

                                </div>
                            </div>';
                        }else{
                            $class ='';
                            if($expense->status != 'pending'){
                                $class ='disabled';
                            }
                            $model="'expense'";

                            return '<div class="dropdown">
                            <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                            <a class="dropdown-item" onClick="expenseView('.$expense->id.')" href="#">View</a>
                            <a class="dropdown-item '.$class.'" href="'.url('expenses/edit/'.$expense->id).'">Edit</a>
                            <a class="dropdown-item" onClick="deleteConfirmation('.$expense->id.','.$model.')" href="#">Delete</a>
                            </div>
                        </div>';
                        }


                    })
                    ->rawColumns(['action','Status'])
                    ->make(true);
        }
        return view('admin.pages.expense.list');
    }

    public function create()
    {
        $this->data['expenseTypes'] = ExpenseType::all();
        return view('admin.pages.expense.add',['data' => $this->data]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'expanse_type_id' => 'required',
            'amount' =>'required',
            'description' =>'required',
        ]);

        $data = $request->except(['avatar']);
        $data['created_by'] = auth()->user()->id;

        $expense = recordSave(Expense::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$expense,'local');
            $image['document_type']='support_document';
            $expense->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'Expense has been added successfully.']);
    }

    public function edit($id)
    {
        $this->data['expenseTypes'] = ExpenseType::all();
        $this->data['expense'] = Expense::find($id);
        return view('admin.pages.expense.edit',['data' => $this->data]);
    }

    public function show($id)
    {
        $expense = Expense::with('expanse_type','checkedby','creator')->find($id);
        return ok($expense);
    }

    public function update(Request $request)
    {
        $request->validate([
            'expanse_type_id' => 'required',
            'amount' =>'required',
            'description' =>'required',
        ]);
        $expense = Expense::find($request->id);

        if(auth()->user()->id != $expense->created_by){
            return redirect()->back()->with(['warning'=>'You do not have permission.']);
        }

        $data = $request->except(['avatar']);

        $expense = recordSave(Expense::class,$data,null,null);
        if($request->avatar !=null){
            $image = fileUpload($request->avatar,$expense,'local');
            $image['document_type']='support_document';
            $expense->image()->create($image);
        }

        return redirect()->back()->with(['success'=>'Expense Has been updated successfully.']);
    }

    public function expenseStatusChange(Request $request)
    {
        if($request->status !=null){
            if( $request->status=='reject'){
                $request->validate([
                    'cancel_reason' =>'required',
                ]);
            }
            $data = $request->all();
            $data['date'] = Carbon::now();
            $data['checked_by'] = auth()->user()->id;
            recordSave(Expense::class,$data,null,null);

            return redirect()->back()->with(['success'=>'Expense Has been updated successfully.']);

        }
        return redirect()->back()->with(['warning'=>'status value required.']);
    }
}
