@extends('layouts.master')
@section('css')
    
@section('title')
    {{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <!-- زرار موديل إضافة قسم-->
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('Sections_trans.add_section') }}</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!--عرض المراحل Table-->
                <div class="card card-statistics h-99">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">
                            @foreach ($Grades as $Grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $Grade->Name }}</a>
                                    <div class="acd-des">
                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('Sections_trans.Name_Section') }}</th> <!--اسم القسم-->
                                                                    <th>{{ trans('Sections_trans.Name_Class') }}</th><!--اسم الصف-->
                                                                    <th>{{ trans('Sections_trans.Status') }}</th><!--الحالة-->
                                                                    <th>{{ trans('Sections_trans.Processes') }}</th><!--العمليات-->
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($Grade->Sections as $list_Sections)<!--عشان اجيب القسم الموجود في كل مرحلة section العلاقة اللي اسمها-->
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $list_Sections->Name_Section }}</td> <!--اسم القسم-->
                                                                        <td>{{ $list_Sections->My_classs->Name_Class }}</td> <!--My_classs العلاقة اللي اسمها -->
                                                                        <td>
                                                                            @if ($list_Sections->Status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <a href="#"
                                                                               class="btn btn-outline-info btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#edit{{ $list_Sections->id }}">{{ trans('Sections_trans.Edit') }}</a>
                                                                            <a href="#"
                                                                               class="btn btn-outline-danger btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#delete{{ $list_Sections->id }}">{{ trans('Sections_trans.Delete') }}</a>
                                                                        </td>
                                                                    </tr>


                                                                    <!--تعديل قسم جديد -->
                                                                @include('pages.Sections.modals.edit') 

                                                                    <!--موديل حذف قسم -->
                                                                    @include('pages.Sections.modals.delete') 

                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                    <!--موديل إضافة قسم -->
                    @include('pages.Sections.modals.add') 
                </div>
            </div>
        </div>
        <!-- row closed -->
        @endsection
        @section('js')
            <script>
                $(document).ready(function () {
                    //
                    $('select[name="Grade_id"]').on('change', function () { //دا selectهاتلي ال
                        var Grade_id = $(this).val(); //اللي اختاره idاعملي متغير خزنلي فيه قيمة ال
                        if (Grade_id) { //idلو في 
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + Grade_id, //idدا ومررله ال urlروح ع ال
                                type: "GET",
                                dataType: "json",
                                success: function (data) { //لو تمت العملية بنجاح
                                    $('select[name="Class_id"]').empty(); //بتاع اسم الصف فاضي selectال

                                    $.each(data, function (key, value) { //option واسم المرحلة خزنهم في idال controllerهيجيلك من ال
                                        $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
            </script>
@endsection
