@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Grades_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.Grades') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!--زرار إضافة مرحلة-->
            <button type="button" class="button x-small" data-toggle="modal" data-target="#add">
                {{ trans('Grades_trans.add_Grade') }}
            </button>
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('Grades_trans.Name') }}</th>
                            <th>{{ trans('Grades_trans.Notes') }}</th>
                            <th>{{ trans('Grades_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($Grades as $Grade)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $Grade->Name }}</td>
                                <td>{{ $Grade->Notes }}</td>
                                <td>
                                <!--زرار موديل تعديل مرحلة-->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                <!--زرار موديل حذف مرحلة-->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Grade->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- موديل تعديل مرحلة -->
                            @include('pages.Grades.edit_modal') 

                             <!-- موديل حذف مرحلة -->
                             @include('pages.Grades.delete_modal') 
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- موديل أضافة مرحلة -->
@include('pages.Grades.add_modal') 


</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
