<?php


namespace App\Repository;


use App\Http\Models\Fee;
use App\Http\Models\Grade;
use App\Http\Models\Fee_invoice;
use App\Http\Models\Student;
use App\Http\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{

    public function index()
    {
        $Fee_invoices = Fee_invoice::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));
    }

    public function show( $id)
    {
        $student = Student::findorfail($id); //هات الطالب اللي اختاره 
        $fees = Fee::where('Classroom_id',$student->Classroom_id)->get(); //لما صف الطالب يساوي الصف اللي في جدول الفواتير هات بيانات الرسوم
        return view('pages.Fees_Invoices.add',compact('student','fees')); //الطالب وبيانات الصف بتاعه id هيروح معاه
    }

    public function edit($id)
    {
        $fee_invoices = Fee_invoice::findorfail($id);
        $fees = Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    }

    
    public function store($request)
    {
        $List_Fees = $request->List_Fees;
    
        DB::beginTransaction();
    
        try {
            foreach ($List_Fees as $List_Fee) {
                $Fees = Fee_invoice::firstOrCreate([ //dont repeat insert
                    'student_id' => $List_Fee['student_id'],
                    'fee_id' => $List_Fee['fee_id'],
                ], [
                    'invoice_date' => date('Y-m-d'),
                    'Grade_id' => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'amount' => $List_Fee['amount'],
                    'description' => $List_Fee['description'],
                ]);
                // Create StudentAccount entry
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->Debit = $List_Fee['amount']; //مدين عشان اثبت الفاتورة اني عايز من الطالب المبلغ دا
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }
            DB::commit();
    
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    



    public function update($request)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = Fee_invoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee_invoice::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
