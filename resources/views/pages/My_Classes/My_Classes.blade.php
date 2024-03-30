@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('My_Classes_trans.title_page') }}
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
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('My_Classes_trans.add_class') }}
            </button>
                <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('My_Classes_trans.delete_checkbox') }}
                </button>
            <br><br>
                <form action="{{ route('Filter_Classes') }}" method="POST">
                    {{ csrf_field() }}
                    <select class="selectpicker" data-style="btn-info" name="Grade_id" required  onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('My_Classes_trans.Search_By_Grade') }}</option>
                        @foreach ($Grades as $Grade)
                            <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                        @endforeach
                    </select>
                </form>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                            <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                            <th>{{ trans('My_Classes_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if (isset($details))

                        <?php $List_Classes = $details; ?>
                    @else

                        <?php $List_Classes = $My_Classes; ?>
                    @endif

                        <?php $i = 0; ?>
                        @foreach ($List_Classes as $My_Class)
                            <tr>
                                <td> <input class="box1" type="checkbox"  value="{{ $My_Class->id }}"  > </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $My_Class->Name_Class }}</td>
                                <td>{{ $My_Class->Grades->Name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                        class="fa fa-trash"></i></button>
                                </td>
                            </tr>


                            @include('pages.My_Classes.modals.edit')

                            @include('pages.My_Classes.modals.delete')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <!-- add_modal_class -->
    @include('pages.My_Classes.modals.add')

<!-- حذف مجموعة صفوف -->
@include('pages.My_Classes.modals.delete_all')



</div>

</div>

<!-- row closed -->
@endsection
@section('js')
<!--عدم فتح موديل الحذف عند عدم التحديد-->
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() { //لو متحدد
                selected.push(this.value); // modelافتح ال
            });
//modelلو مش متحدد على حاجة متفتحش ال
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>

@endsection
