@extends('layouts.app')

@section('page_title')
    Time Table
@endsection

<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 class_name">Time Table</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">TIme Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="students">0</h3>

                        <p>Periods Per Week</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="t_fee">0</h3>

                        <p>Time Table</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/control/class/fee/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="t_pay">0</h3>
                        <p>Setups</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/control/class/payments/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="teachers">0</h3>

                        <p>Periods Today</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/control/class/teachers/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link " href="#view_table" data-toggle="tab">View Time Tables</a></li>
                            <li class="nav-item"><a class="nav-link active" href="#add_new_time_table" data-toggle="tab">Add New</a></li>
                            <li class="nav-item"><a class="nav-link" href="#time_table_setup" data-toggle="tab">Time Table Setup</a></li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="view_table">
                                <div class="text-center">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <i> Loading ... </i>
                                </div>
                            </div>

                            <div class="tab-pane active" id="add_new_time_table">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title text-bold">Class Subject Setup</h4>
                                    </div>
                                    <div class="card-body">
                                        <form  id="class_setup" class="row">
                                            <div class="col-md-4 form-group">
                                                <label >Title</label>
                                                <input type="text" class="form-control"  placeholder="e.g SS 2a time table" >
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label >Class</label>
                                                <select name="class" class="form-control" >
                                                    <option selected disabled>..Select Class...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label>Setup</label>
                                                <select name="setup" class="form-control"  >
                                                    <option selected disabled>..Select Time Table Setup...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="setup_info d-flex justify-content-between col-md-6 mb-2">
                                                </div>
                                                <div class="subject_setup row">

                                                </div>
                                                <button class="btn btn-secondary mt-3 float-right class_setup_btn" >Create Time Table</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-bold">SS 3a Time Table</h3>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-hover time_table_set">
                                            </table>
                                            <button class="btn btn-secondary float-right swapsubjects">Swap Subjects</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane" id="time_table_setup">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title text-bold">Create Time Table Setup</h4>
                                    </div>
                                    <div class="card-body">
                                        <form  id="createSetup" class="row">
                                            <div class="col-md-6 form-group">
                                                <label >Setup Title</label>
                                                <input type="text" class="form-control" placeholder="e.g JSS Setup">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label >Number of periods per day including break</label>
                                                <select id="setup_periods" class="form-control" >
                                                    <option selected disabled>..Select Periods...</option>
                                                    @for ($i=1; $i<=12; $i++)
                                                        <option  > {{$i}} </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <table width="100%" class="mt-3" id="setperiod">

                                                </table>

                                                <button class="btn btn-secondary mt-3 float-right" id="createSetupBtn" >Create Setup</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-bold">Recent Setups</h3>
                                    </div>
                                    <div class="card-body p-1 ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped recent_setups">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });

            $('#setup_periods').on('change', function() {
                displaySetupPeriods(this.value)
            })

            $('.swapsubjects').on('click', function() {
                table_id = $(this).data('table_id');
                subjects = $('.swapper'); swaps = []; contents = [];
                subjects.map(sub => {
                    sub = subjects[sub];

                    if(sub.checked) {
                        swaps.push(sub.value);
                        label = $(sub.parentNode).find('label')[0]
                        arr = { input_id: sub.id, input_val: sub.value, label: label.innerText }
                        contents.push(arr);
                    }
                });
                if(swaps.length != 2) { littleAlert('Select two subjects to swap', 1); return; }

                $.ajax({
                    method: 'POST',
                    url: api_url+'time_table/swap',
                    data: {
                        time_table_id: table_id,
                        index_1 : swaps[0],
                        index_2 : swaps[1],
                    },
                    beforeSend:() => {
                        btnProcess('.swapsubjects', '', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.swapsubjects', 'Swap Subjects', 'after');
                    //manipulate Dom
                    id_one = contents[0].input_id; id_two = contents[1].input_id;
                    $(`#`+id_one).val(contents[1].input_val); $(`#`+id_two).val(contents[0].input_val);
                    label_one = `label[for="${id_one}"]`; label_two = `label[for="${id_two}"]`;
                    $(label_one).html(contents[1].label); $(label_two).html(contents[0].label);
                    $(`#`+id_one).removeAttr('checked');
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.swapsubjects', 'Swap Subjects', 'after');
                })
            })




            function fetchTimeTableInfo()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'time_table/2'
                }).done(function(res) {

                    console.log(res.title);
                    $('.swapsubjects').attr('data-table_id', res.id);
                    periods = res.periods; body = $('.time_table_set');
                    periods.map(day => {

                        period_string = ''
                        day.period.map((per, index) => {
                            period_string += `
                                <td class="align-middle align-center"  ${(per.type == 1) ? '' : 'bgcolor="grey"'}>
                                    ${(per.type == 1) ? `<div class="icheck-primary d-inline">
                                        <input type="checkbox" class="swapper" id="swap${per.index}" value="${per.index}">
                                        <label for="swap${per.index}">${per.subject}</label>
                                    </div>` : `<b>Break</b>` }
                                </td>
                            `
                        })


                        console.log(day);
                        body.append(`
                            <tr>
                                <td class="align-middle"><b>${day.day}<b></td>
                                ${period_string}
                            </tr>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchTimeTableInfo();


            $('#class_setup').on('submit', function(e) {
                e.preventDefault()
                title = $(this).find('input[class="form-control"]');
                cla = $(this).find('select[name="class"]');
                setup = JSON.parse($(this).find('select[name="setup"]').val());
                if(!title || !cla || !setup) {
                    littleAlert('The title, class and setup fields are require', 1);
                    return;
                }
                sum = 0;
                all_per = $('.period_per_week'); periods = [];
                all_per.map(per => {
                    per = all_per[per];
                    value = parseInt(per.value)
                    if(value > 0) {
                        pa = $(per).parent()
                        subject_id = $(pa).find('input').val();
                        console.log(subject_id);
                        arr = { subject_id:subject_id, periods:value }
                        periods.push(arr);
                        sum += value;
                    }
                });
                if(setup.lessons != sum){ littleAlert('You have not reached your subjects limit', 1); return; }
                $.ajax({
                    method: 'post',
                    url: api_url+'time_table/add',
                    data: {
                        setup_id: setup.id,
                        class_id: cla.val(),
                        title: title.val(),
                        periods: periods
                    },
                    beforeSend:() =>  {
                        btnProcess('.class_setup_btn', '', 'before');
                    }
                }).done(function(res) {
                    console.log(res);
                    littleAlert(res.message);
                    btnProcess('.class_setup_btn', 'Create Time Table', 'after');
                    $('.period_per_week').prop('selectedIndex',0)
                    title.val(``)
                    cal.prop('selectedIndex',0)
                }).fail(function(res) {
                    console.log(res);
                    parseError(res.responseJSON);
                    btnProcess('.class_setup_btn', 'Create Time Table', 'after');
                });
            })

            $('body').on('change', '.period_per_week', function() {
                data = JSON.parse($('select[name="setup"]').val())
                all_per = $('.period_per_week'); sum = 0;
                lessons = parseInt(data.lessons);

                all_per.map(per => {
                    per = all_per[per];
                    val = parseInt(per.value);
                    sum += val;
                    check_box = per.parentNode.children[0].children[0];

                    if(val == 0){check_box.removeAttribute('checked', 'checked')}
                    else {check_box.setAttribute('checked', 'checked')}
                });

                if(sum > lessons){
                    alert('You have exceeded maximum number of periods')
                    pa = $(this).parent()
                    $(pa).find('input').removeAttr('checked');
                    $(this).prop('selectedIndex',0)
                    return
                }
                body = $('.setup_info').html(`
                    <span>Setup: <b>${data.title}</b></span>
                    <span>Lessons: <b>${data.lessons}</b></span>
                    <span>Breaks: <b>${data.breaks}</b></span>
                    <span>Used: <b>${sum} of ${data.lessons}</b></span>
                `)
            })


            $('select[name="setup"]').on('change', function() {
                data = JSON.parse(this.value);
                $('.period_per_week').removeAttr('disabled');
                $('.period_per_week').prop('selectedIndex',0)
                $('.box').removeAttr('checked');
                body = $('.setup_info').html(`
                    <span>Setup: <b>${data.title}</b></span>
                    <span>Lessons: <b>${data.lessons}</b></span>
                    <span>Breaks: <b>${data.breaks}</b></span>
                    <span>Used: <b>0 of ${data.lessons}</b></span>
                `)
            })

            function fetchTimeTableReq()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'time_table/requirement'
                }).done(function(res) {
                    console.log(res);
                    class_setup = $('#class_setup')
                    cla_1 = $(class_setup).find('select[name="class"]')
                    res.classes.map(cla => {
                        cla_1.append(`<option value="${cla.id}">${cla.class}</opton>`)
                    })

                    subject = $('.subject_setup')

                    period_string = ''
                    for (i=0; i <= 12; i++) {
                        period_string += `<option>${i}</option>`

                    }
                    res.subjects.map((sub,index) => {
                        subject.append(`
                            <div class="col-md-6">
                                <div class="single_subject m-1 p-2 bg-secondary d-flex justify-content-between" style="opacity: .9; border-radius: 10px">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" class="box" value="${sub.id}">
                                        <label for="box${index}"> ${sub.subject} </label>
                                    </div>
                                    <select class="form-control period_per_week" disabled style="width: 70px; height: 33px ">
                                        ${period_string}
                                    </select>
                                </div>
                            </div>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }
            fetchTimeTableReq();



            function fetchSetups()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'time_table_setup/fetch'
                }).done(function(res) {
                    console.log(res);
                    body = $('.recent_setups');
                    body.html(``);

                    //apen for others
                    setup = $('#class_setup').find('select[name="setup"]')
                    res.data.map(set => {

                        arr = { id:set.id, title: set.title, lessons: set.lesson_periods, breaks: set.break_periods }
                        console.log(arr);
                        setup.append(`<option value='${JSON.stringify(arr)}' >${set.title}</opton>`)

                        string = ''
                        set.data.map((per, index) => {
                            string += `
                                <td  ${(per.type == 1) ? '' : 'bgcolor="grey"'}><b> ${(per.type == 1) ? 'Period '+ (index+1) : 'Break'} </b><br>${per.from} - ${per.to}</td>
                            `
                        })

                        body.append(`<tr>
                            <td class="align-middle"><b>${set.title}</b></td>
                            <td><b>Lessons</b><br>${set.lesson_periods}</td>
                            <td><b>Breaks</b><br>${set.break_periods}</td>
                            ${string}
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchSetups();

            $('#createSetupBtn').on('click', function(e) {
                e.preventDefault();
                btn = $('#createSetupBtn');
                form = $('#createSetup');
                title = $(form).find('input[type="text"]').val()
                period_total = $('#setup_periods').val();
                periods = [];

                trs = $('.single_period');
                trs.map(tr => {
                    tr = trs[tr].children;
                    type = tr[1].children[0].value;
                    from = tr[2].children[0].value;
                    to = tr[3].children[0].value;
                    arr = { type: type, from: from, to:to }
                    periods.push(arr);
                });

                $.ajax({
                    method : 'post',
                    url: api_url+'time_table_setup/add',
                    data: {
                        'title' : title,
                        'total_periods' : period_total,
                        'periods' : periods
                    },
                    beforeSend:() => {
                        btnProcess('#createSetupBtn', '', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('#createSetupBtn', 'Create Setup', 'after');
                    $('#setperiod').html(``)
                    form[0].reset();
                    fetchSetups();

                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('#createSetupBtn', 'Create Setup', 'after');
                })

            })



            function displaySetupPeriods(periods)
            {
                i = 1;
                body = $('#setperiod').html(`<tr><th>Period</th><th>Type</th><th>From</th><th>To</th></tr>`);
                while(i <= periods){
                    body.append(`
                        <tr class="single_period">
                            <td>Period ${i} </td>
                            <td>
                                <select class="form-control">
                                    <option value="1">Class Period</option>
                                    <option value="0">Break Period</option>
                                </select>
                            </td>
                            <td>
                                <input type="time" class="form-control" required />
                            </td>
                            <td>
                                <input type="time" class="form-control" required />
                            </td>
                        </tr>;
                    `);
                    i++;
                }
            }

        })
    </script>



@endsection
