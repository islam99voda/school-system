<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>
<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>




<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>



@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif


<!--تفعيل تحديد الكل-->
<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>

<!--جلب الصفوف الدراسية-->
<script>
    $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="Classroom_id"]').empty();
                        $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('select[name="Grade_id"], select[name="Classroom_id"], select[name="section_id"]').on('change', function () {
            var Grade_id = $('select[name="Grade_id"]').val();
            var Classroom_id = $('select[name="Classroom_id"]').val();
            var section_id = $('select[name="section_id"]').val();
            
            var languagePreference = window.location.pathname.split('/')[1]; // Extract language from URL
            
            if (Grade_id && Classroom_id && section_id) {
                $.ajax({
                    url: "{{ url('Get_students_table') }}/" + Grade_id + '/' + Classroom_id + '/' + section_id,
                    type: "GET",
                    data: {
                        Grade_id: Grade_id,
                        Classroom_id: Classroom_id,
                        section_id: section_id,
                    },
                    dataType: "json",
                    success: function (data) {
                        $('#students-table-body').empty(); // Clear existing table body
                        var count = 0; // Initialize count variable
                        $.each(data, function (key, student) {
                            count++; // Increment count 
                            // Get the student name based on the language in url
                            $('#students-table-body').append(
                                '<tr>' +
                                    '<td>' + count + '</td>' + 
                                    '<td>' + (languagePreference === 'en' ? student.gender.Name.en : student.gender.Name.ar) + '</td>' +
                                    '<td>' + student.email + '</td>' +
                                    '<td>' + (languagePreference === 'en' ? student.gender.Name.en : student.gender.Name.ar) + '</td>' +
                                    '<td>' + (languagePreference === 'en' ? student.grade.Name.en : student.grade.Name.ar) + '</td>' +
                                    '<td>' + (languagePreference === 'en' ? student.classroom.Name_Class.en : student.classroom.Name_Class.ar) + '</td>' +
                                    '<td>' + (languagePreference === 'en' ? student.section.Name_Section.en : student.section.Name_Section.ar) + '</td>' +
                                '</tr>'
                            );
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            } else {
                console.log('Please select all required fields');
            }
        });
    });
</script>




<!--جلب الصفوف الدراسية-->
<script>
    $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="Classroom_id"]').empty();
                        $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<!--جلب القسم-->
<script>
    $(document).ready(function () {
        $('select[name="Classroom_id"]').on('change', function () {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>




<!--جلب الصفوف الدراسية الجديدة-->
<script>
    $(document).ready(function () {
        $('select[name="Grade_id_new"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="Classroom_id_new"]').empty();
                        $('select[name="Classroom_id_new"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="Classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<!--جلب الاقسام الدراسية الجديدة-->
<script>
    $(document).ready(function () {
        $('select[name="Classroom_id_new"]').on('change', function () {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id_new"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


