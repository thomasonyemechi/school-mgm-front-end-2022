@extends('layouts.app')

@section('page_title')
Broad Sheet
@endsection

@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Broad Sheet</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Broad Sheet</li>
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
                                <form id="loadSheet">
                                    <div class="form-group">
                                        <label>Select Programme</label>
                                        <select name="program" id="program" class="form-control select2bs4">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-secondary float-right loadSheet">View Sheet</button>
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
                                        <td colspan="2"></td>
                                        <th colspan="5" class="text-center"> 1<sup>st</sup> Term </th>
                                        <th colspan="5" class="text-center">2<sup>nd</sup> Term</th>
                                        <th colspan="5" class="text-center">3<sup>rd</sup> Term</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th class="ca1">CA1</th>
                                        <th class="ca2">CA2</th>
                                        <th class="ca3">CA3</th>
                                        <th class="exam">Exam</th>
                                        <th>Total</th>

                                        <th class="ca1">CA1</th>
                                        <th class="ca2">CA2</th>
                                        <th class="ca3">CA3</th>
                                        <th class="exam">Exam</th>
                                        <th>Total</th>

                                        <th class="ca1">CA1</th>
                                        <th class="ca2">CA2</th>
                                        <th class="ca3">CA3</th>
                                        <th class="exam">Exam</th>
                                        <th>Total</th>
                                        <th>£f</th>

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

            $('#loadSheet').on('submit', function(e) {
                e.preventDefault();
                prog = $($(this)).find('select[name="program"]').val();
                if(!prog) { littleAlert('Pls select a program',1); return; }
                location.href=`/control/broad-sheet/${prog}`;
                btnProcess('.loadSheet', '', 'before');
            });




            function loadProgram() {
                program = `{{$program}}`;
                console.log(program);
                body = $('#result_body');
                if(program == 0) { littleAlert('Pls select a program view result', 1); return; }
                $.ajax({
                    method: 'get',
                    url: api_url+`broad/${program}`,
                    beforeSend:() => {
                        body.html(`
                            <tr>
                                <td colspan="20">
                                    <div class="text-center">
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <i> Loading ... </i>
                                    </div>
                                </td>
                            </tr>
                        `)
                    }
                }).done(function(res) {
                    $('.t_text').html(`${res.cap} Broad Sheet`);
                    body = $('#result_body');
                    set = res.setup;
                    body.html(``);
                    res.data.map((stu, index) => {
                        first = checkRes(stu.first);
                        second = checkRes(stu.second);
                        third = checkRes(stu.third);
                        total = first.total + second.total + third.total ;
                        divisor = ((first.total > 0) ? 1 : 0) + ((second.total > 0) ? 1 : 0) + ((third.total > 0) ? 1 : 0);
                        ef = total/divisor;
                        body.append(`
                            <tr class="single">
                                <td>${index+1}</td>
                                <td>${stu.surname} ${stu.firstname}</td>
                                <td>${first.t1}</td>
                                <td>${first.t2}</td>
                                <td>${first.t3}</td>
                                <td>${first.exam}</td>
                                <td>${first.total}</td>

                                <td>${second.t1}</td>
                                <td>${second.t2}</td>
                                <td>${second.t3}</td>
                                <td>${second.exam}</td>
                                <td>${second.total}</td>

                                <td>${third.t1}</td>
                                <td>${third.t2}</td>
                                <td>${third.t3}</td>
                                <td>${third.exam}</td>
                                <td>${third.total}</td>

                                <td>${ef}</td>

                            </tr>
                        `)
                    })

                }).fail(function(res) {
                    console.log(res);
                });
            }
            loadProgram();






        })
    </script>

@endsection
