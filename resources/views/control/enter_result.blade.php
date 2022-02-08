@extends('layouts.app')

@section('page_title')
Upload Results
@endsection

@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Upload Result</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Result</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-secondary card-outline">
                            <div class="card-body">
                                <form id="startResult">
                                    <div class="form-group">
                                        <label>Select Programme</label>
                                        <select name="program" id="program" class="form-control select2bs4">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-secondary float-right startResult">Start Result</button>
                                    </div>
                                    <input type="hidden" id="setup">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span class="t_text">Broad sheet</span>
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th class="ca1">CA1</th>
                                        <th class="ca2">CA2</th>
                                        <th class="ca3">CA3</th>
                                        <th class="exam">Exam</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="result_body">

                                </tbody>
                            </table>
                        </div>

                        <div id="page_links">

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });


            function fetchProgram() {
                $.ajax({
                    method: 'get',
                    url: api_url+'fetch_teacher_subject/{{user()->id}}'
                }).done(function(res) {
                    body = $('#program');
                    body.html(`<option selected disabled>Select Option</option>`);
                    res.data.map(pro => {
                        body.append(`<option value="${pro.id}">${pro.class.class} ${pro.subject.subject}</option>`)
                    })
                }).fail(function(res) {
                })
            }

            fetchProgram();


            $('#startResult').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                program = $(form).find('select[name=program]').val();
                if(!program){ littleAlert('Pls select a program to start result', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'start_result',
                    data: {
                        set_id: program
                    },
                    beforeSend:() => {
                        btnProcess('.startResult', '', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.startResult', 'Start Result', 'after');
                    location.href=`/control/result/upload/${program}`
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.startResult', 'Start Result', 'after');
                })
            })


            function loadProgram() {
                program = `{{$program}}`;
                body = $('#result_body');
                if(program == 0) { littleAlert('Pls select a program to upload/edit result', 1); return; }
                $.ajax({
                    method: 'get',
                    url: api_url+`load/program/${program}?page={{$_GET['page'] ?? 1}}`,
                    beforeSend:() => {
                        body.html(`
                            <tr>
                                <td colspan="12">
                                    <div class="text-center">
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <i> Loading ... </i>
                                    </div>
                                </td>
                            </tr>
                        `)
                    }
                }).done(function(res) {
                    $('.t_text').html(`${res.cap} Result`);
                    body = $('#result_body');
                    set = res.setup;
                    body.html(``);
                    if(!res.setup) {
                        body.html(`
                            <tr>
                                <td colspan="12"><div class="text-center"><b>Result Setup is not complete <br> Contact an admin to complete setup</b></div></td>
                            </tr>
                        `); return;
                    }
                    $('#setup').val(JSON.stringify(set));
                    $('.ca1').html(`CA1 (${set.ca1})`);
                    $('.ca2').html(`CA2 (${set.ca2})`);
                    $('.ca3').html(`CA3 (${set.ca3})`);
                    $('.exam').html(`Exam (${set.exam})`);
                    littleAlert('You can now edit student result');
                    res.data.data.map((rsu, index) => {
                        body.append(`
                            <tr class="single">
                                <td>${index+1}</td>
                                <td>${rsu.student.surname} ${rsu.student.firstname}</td>
                                <td>
                                    <input type="hidden" name="id" value="${rsu.id}">
                                    <input type="number" name="ca1" class="form-control" value="${rsu.t1}" ${(set.ca1 == 0) ? 'disabled' : ''} style="width: 70px; height: 30px">
                                </td>
                                <td><input type="number" name="ca2" class="form-control" value="${rsu.t2}" ${(set.ca2 == 0) ? 'disabled' : ''} style="width: 70px; height: 30px"></td>
                                <td><input type="number" name="ca3" class="form-control" value="${rsu.t3}" ${(set.ca3 == 0) ? 'disabled' : ''}  style="width: 70px; height: 30px"></td>
                                <td><input type="number" name="exam" class="form-control" value="${rsu.exam}" ${(set.exam == 0) ? 'disabled' : ''} style="width: 70px; height: 30px"></td>
                                <td>${rsu.t1 + rsu.t2 + rsu.t3 + rsu.exam}</td>
                                <td><button class="btn btn-xs btn-success save_change float-right"><i class="fas fa-save"></i> Save</button></td>
                            </tr>
                        `)
                    })


                    body.append(`
                        <tr>
                            <td colspan="12">
                                <button class="btn btn-success save_all float-right"><i class="fas fa-save"></i> Save all changes</button>
                            </td>
                        </tr>
                    `)



                    $('#page_links').html(dropPaginatedPages(res.data.links))
                }).fail(function(res) {
                });
            }
            loadProgram();


            $('body').on('click', '.save_change', function() {
                btn = $(this); set = JSON.parse($('#setup').val()); error = 0;
                parent = btn.parent();
                td_siblings = parent.siblings()
                //result id
                result_id = td_siblings[2].children[0].value

                ///ca1 fetch and check
                ca1 = parseInt(td_siblings[2].children[1].value);
                if(ca1 > set.ca1 || 0 > ca1) { td_siblings[2].classList.add('bg-danger'); error++; } else { td_siblings[2].classList.remove('bg-danger'); }

                ///ca2
                ca2 = parseInt(td_siblings[3].children[0].value);
                if(ca2 > set.ca2 || 0 > ca2) { td_siblings[3].classList.add('bg-danger'); error++; } else { td_siblings[3].classList.remove('bg-danger'); }

                /////ca3
                ca3 = parseInt(td_siblings[4].children[0].value);
                if(ca3 > set.ca3 || 0 > ca3) { td_siblings[4].classList.add('bg-danger'); error++; } else { td_siblings[4].classList.remove('bg-danger'); }

                /////exam
                exam = parseInt(td_siblings[5].children[0].value);
                if(exam > set.exam || 0 > exam) { td_siblings[5].classList.add('bg-danger'); error++; } else { td_siblings[5].classList.remove('bg-danger'); }

                total = ca1 + ca2 + ca3 + exam
                if(error > 0) { littleAlert(`There are ${error} errors in the score inputed, pls check and try again`, 1);  return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'update/student/result',
                    data: {
                        result_id : result_id,
                        ca1: ca1,
                        ca2: ca2,
                        ca3: ca3,
                        exam: exam
                    },
                    beforeSend:() => {
                        btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>...</i>`);
                        $('.save_change').attr('disabled', 'disabled');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    $('.save_change').removeAttr('disabled');
                    btn.html(`<i class="fas fa-save"></i> Save`);
                    td_siblings[6].innerHTML = total;
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btn.html(`<i class="fas fa-save"></i> Save`);
                    $('.save_change').removeAttr('disabled');
                })
            })




            $('body').on('click', '.save_all', function() {

                set = JSON.parse($('#setup').val()); error = 0;


                trs = $('.single')
                data = []; total = [];
                trs.map(row => {
                    td_siblings = trs[row].children
                    //result id
                    result_id = td_siblings[2].children[0].value

                    ///ca1 fetch and check
                    ca1 = parseInt(td_siblings[2].children[1].value);
                    if(ca1 > set.ca1 || 0 > ca1) { td_siblings[2].classList.add('bg-danger'); error++; } else { td_siblings[2].classList.remove('bg-danger'); }

                    ///ca2
                    ca2 = parseInt(td_siblings[3].children[0].value);
                    if(ca2 > set.ca2 || 0 > ca2) { td_siblings[3].classList.add('bg-danger'); error++; } else { td_siblings[3].classList.remove('bg-danger'); }

                    /////ca3
                    ca3 = parseInt(td_siblings[4].children[0].value);
                    if(ca3 > set.ca3 || 0 > ca3) { td_siblings[4].classList.add('bg-danger'); error++; } else { td_siblings[4].classList.remove('bg-danger'); }

                    /////exam
                    exam = parseInt(td_siblings[5].children[0].value);
                    if(exam > set.exam || 0 > exam) { td_siblings[5].classList.add('bg-danger'); error++; } else { td_siblings[5].classList.remove('bg-danger'); }

                    arr = {result_id: result_id, ca1: ca1, ca2:ca2, ca3: ca3, exam: exam }
                    data.push(arr);
                    total.push(ca1+ca2+ca3+exam);
                });

                if(error > 0) { littleAlert(`There are ${error} errors in the score inputed, pls check and try again`, 1);  return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'update/student/result/all',
                    data: {
                        data: data
                    },
                    beforeSend:() => {
                        $('.save_change').attr('disabled', 'disabled');
                        btnProcess('.save_all', '', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    $('.save_change').removeAttr('disabled');
                    btnProcess('.save_all', '<i class="fas fa-save"></i> Save all changes', 'after');

                    trs.map(row => {
                        td_siblings = trs[row].children
                        td_siblings[6].innerHTML = total[row];
                    });

                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.save_all', '<i class="fas fa-save"></i> Save all changes', 'after');
                    $('.save_change').removeAttr('disabled');
                })
            })
        })
    </script>

@endsection
