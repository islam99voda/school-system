<!--موديل إضافة قسم -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
               id="exampleModalLabel">
               <!--كلمة إضافة قسم جوه الموديل-->
               {{ trans('Sections_trans.add_section') }}</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">
           <form action="{{ route('Sections.store') }}" method="POST">
               {{ csrf_field() }}
               <div class="row">
                   <!--إضافة اسم القسم بالعربي input-->
                   <div class="col">
                       <input type="text" name="Name_Section_Ar" class="form-control"
                              placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                   </div>
                   <!--إضافة اسم القسم بالانجليزي input-->
                   <div class="col">
                       <input type="text" name="Name_Section_En" class="form-control"
                              placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                   </div>
               </div>
               <br>
               <div class="col">
                    <!--اسم المرحلة-->
                   <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                   <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())"> <!--خزن في الكونسول-->
                       <!--حدد المرحلة-->
                       <option value="" selecteddisabled>{{ trans('Sections_trans.Select_Grade') }} </option>
                       <!--بتاع اسم المرحلة اللي اليوزر هيختارها idخزن في الكونسول ال-->
                       @foreach ($list_Grades as $list_Grade)
                           <option value="{{ $list_Grade->id }}"> {{ $list_Grade->Name }} 
                           </option>
                       @endforeach
                   </select>
               </div>
               <br>
               <div class="col">
                   <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                   <!--اسم الصف-->
                   <select name="Class_id" class="custom-select"> 
                   </select>
               </div><br>
               <div class="col">
                   <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                   <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                       @foreach($teachers as $teacher)
                           <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                       @endforeach
                   </select>
               </div>
       </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-secondary"
                   data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
           <button type="submit"
                   class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
       </div>
       </form>
   </div>
</div>
</div>