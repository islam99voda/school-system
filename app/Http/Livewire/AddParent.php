<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Models\Religion;
use Livewire\WithFileUploads;
use App\Http\Models\My_Parent;
use App\Http\Models\Type_Blood;
use App\Http\Models\Nationalitie;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\ParentAttachment;
use Illuminate\Support\Facades\Storage;

class AddParent extends Component
{
    use WithFileUploads; 


    public $catchError,$show_table,$updateMode=false,    $Parent_id;
    public $photos = [];
    public $successMessage = [];

    public $currentStep = 1,

        $Name_Father,$Email, $Password,
        $Name_Father_en, $Religion_Father_id,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

        public function render()
        {
            return view('livewire.add-parent', [
                'Nationalities' => Nationalitie::all(),
                'Type_Bloods' => Type_Blood::all(),
                'Religions' => Religion::all(),
                'my_parents' => My_Parent::all(),
            ]);
        }

        public function showformadd(){ //add parent
            $this->show_table = true;
        }


        public function firstStepSubmit() //second step
        {
            $this->validate([ //فاليديشن inputsمتنفذهاش غير لما تعمل على كل ال
                'Email' => 'required|unique:my__parents,Email,'.$this->id,
                'Password' => 'required',
                'Name_Father' => 'required',
                'Name_Father_en' => 'required',
                'Job_Father' => 'required',
                'Job_Father_en' => 'required',
                'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->id,
                'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->id,
                'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'Nationality_Father_id' => 'required',
                'Blood_Type_Father_id' => 'required',
                'Religion_Father_id' => 'required',
                'Address_Father' => 'required',
            ]);
            $this->currentStep = 2; // do override 2
        }


        public function updated($propertyName)
        {
            $this->validateOnly($propertyName, [
                'Email' => 'required|email',
                'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'Passport_ID_Father' => 'min:10|max:10',
                'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'Passport_ID_Mother' => 'min:10|max:10',
                'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
            ]);
        }

    //secondStepSubmit
    public function secondStepSubmit() //third step
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){
        try {
        $My_Parent = new My_Parent();
        // Father_INPUTS
        $My_Parent->Email = $this->Email;
        $My_Parent->Password = bcrypt($this->Password); // Hashing the password
        $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
        $My_Parent->National_ID_Father = $this->National_ID_Father;
        $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
        $My_Parent->Phone_Father = $this->Phone_Father;
        $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
        $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
        $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
        $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
        $My_Parent->Religion_Father_id = $this->Religion_Father_id;
        $My_Parent->Address_Father = $this->Address_Father;

        // Mother_INPUTS
        $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
        $My_Parent->National_ID_Mother = $this->National_ID_Mother;
        $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
        $My_Parent->Phone_Mother = $this->Phone_Mother;
        $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
        $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
        $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
        $My_Parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
        $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
        $My_Parent->Address_Mother = $this->Address_Mother;
        $My_Parent->save();

        if (!empty($this->photos)){
            foreach ($this->photos as $photo) {
                $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                ParentAttachment::create([
                    'file_name' => $photo->getClientOriginalName(),
                    'parent_id' => My_Parent::latest()->first()->id,
                ]);
            }
        }
        $this->successMessage = trans('messages.success');
        $this->clearForm(); //اللي كاتبها تحت methodهاتلي ال
        $this->currentStep = 1;
        }
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }


    public function firstStepSubmit_edit()
    {
        $this->updateMode = true; //فعل التعديل
        $this->currentStep = 2; //روح ع الخطوة 2
    }

    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3; //روح ع الخطوة 3
    }

    public function submitForm_edit(){
        try {
            if ($this->Parent_id){
                $parent = My_Parent::find($this->Parent_id);
                if ($parent) {
                    $parent->update([
                        'Email' => $this->Email,
                        'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                        'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                        'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                        'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                        'National_ID_Father' => $this->National_ID_Father,
                        'Passport_ID_Father' => $this->Passport_ID_Father,
                        'Phone_Father' => $this->Phone_Father,
                        'Nationality_Father_id' => $this->Nationality_Father_id,
                        'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                        'Religion_Father_id' => $this->Religion_Father_id,
                        'Address_Father' => $this->Address_Father,
                        'National_ID_Mother' => $this->National_ID_Mother,
                        'Passport_ID_Mother' => $this->Passport_ID_Mother,
                        'Phone_Mother' => $this->Phone_Mother,
                        'Nationality_Mother_id' => $this->Nationality_Mother_id,
                        'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                        'Religion_Mother_id' => $this->Religion_Mother_id,
                        'Address_Mother' => $this->Address_Mother,
                    ]);
                    $this->successMessage = trans('messages.success');
                    $this->clearForm();
                    $this->updateMode = true;  //فعل وضع التعديل
                    $this->show_table = false;  //اخفي الجدول وافتح الفورم
                } else {
                    $this->catchError = "Parent not found with ID: " . $this->Parent_id;
                }
            } else {
                $this->catchError = "Parent ID is not set.";
            }
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }



    public function edit($id) //اللي بيفتح فورم التعديل
    {
        $this->updateMode = true;  //فعل وضع التعديل
        $this->show_table = true;  //اخفي الجدول وافتح الفورم
        $My_Parent = My_Parent::where('id',$id)->first(); //املى بيانات الفورم
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->Blood_Type_Father_id;
        $this->Address_Father =$My_Parent->Address_Father;
        $this->Religion_Father_id =$My_Parent->Religion_Father_id;

        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->Blood_Type_Mother_id;
        $this->Address_Mother =$My_Parent->Address_Mother;
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id;
    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }

    public function delete($id){

        $parent = My_Parent::findOrFail($id);

        $attachments = ParentAttachment::where('parent_id', $parent->id)->get();

        if ($attachments->isNotEmpty()) {
            foreach ($attachments as $attachment) {
                // Delete the attachment file from storage
                Storage::disk('parent_attachments')->delete($attachment->file_name);
            }
            // Delete the attachment records from the database
            ParentAttachment::where('parent_id', $parent->id)->delete();
        }
        // Delete the user
        $parent->delete();

        return redirect()->to('/add_parent');
    }



    public function back($step)
    {
        $this->currentStep = $step;
    }
}
