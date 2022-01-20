@extends('layouts.app')

@section('page_title')
    Set School Fee
@endsection

@php
    $page = isset($_GET['page']) ? $_GET['page'] : 1 ;
@endphp


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Set Fee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Set Fee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fas fa-toolbox"></i>
                            Set school fee
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" class="row" id="setSchoolFees">
                            <div class=" col-md-4 form-group">
                                <label>Select Class</label>
                                <select name="class" class="form-control select2bs4">
                                    <div></div>
                                </select>
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Select Fee Cateogry</label>
                                <select name="fee_category" id="" class="form-control select2bs4" >
                                    <div></div>
                                </select>
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Input Amount</label>
                                <input type="number" name="fee_amount" class="form-control" placeholder="Fee Amount" >
                            </div>


                            <div class="col-12 form-group">
                                <button class="btn btn-secondary float-right setSchoolFees ">Set Fee</button>
                            </div>


                        </form>
                    </div>
                </div>


                <div class="card card-secondary card-outline">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between m-0 p-0">
                            <h3 class="card-title fee_list_card">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                Student Fee
                            </h3>

                            <div class="row">
                                    <form class="form-group col-12 m-0 p-0 d-flex justify-content-between " action="" id="viewFee">
                                        <select class="form-control mr-2" name="cla" id="cla" style="height: 30px" >
                                            <option selected disabled>Class</option>
                                        </select>

                                        <select class="form-control mr-2" name="fee_cat" id="fee_cat" style="height: 30px" >
                                            <option selected disabled>Fee</option>
                                        </select>

                                        <button class="btn btn-xs btn-secondary float-right viewFee"> View</button>
                                    </form>


                            </div>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="exampl1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="record_table">
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

            c_fee ='{{$fee ?? 0}}'
            c_class = '{{$class ?? 0}}'




            function fetchSettedFee(fee, clas){
                data = $.ajax({
                    method: 'get',
                    url: api_url+`fetch_fee/${fee}/${clas}?page={{$page}}`
                }).done(function(res) {
                    $('.fee_list_card').html(`<i class="fa fa-list-alt" aria-hidden="true"></i>
                    <b>Record For ${res.data.class.class}, ${res.data.fee.fee}, ${term_text(res.data.term.term)} </b>`);

                    record = $('#record_table')
                    record.html(``);

                    t_amount = 0 ; t_discount = 0;
                    res.data.records.data.map((pay, index) => {
                        t_discount += Math.abs(pay.discount)
                        t_amount += Math.abs(pay.amount)
                        record.append(`
                            <tr class="single">
                                <td class="align-middle">${index + 1}</td>
                                <td class="align-middle">${pay.student.surname + ' ' + pay.student.firstname}</td>
                                <td class="align-middle"> <input type="number" class="form-control" name="amount" value="${Math.abs(pay.amount)}" style="width: 100px; height: 30px">
                                    <input type="hidden" name="id" value="${pay.id}" >
                                </td>
                                <td class="align-middle"> <input type="number" class="form-control" name="discount" min="0" max="${Math.abs(pay.amount)}" value="${Math.abs(pay.discount)}" style="width: 100px; height: 30px" > </td>
                                <td class="align-middle"> ${moneyFormat( Math.abs(pay.amount) - Math.abs(pay.discount)) } </td>
                                <td class="align-middle"> <button class="save_changes btn btn-success float-right btn-xs"><i class="fas fa-save"></i> Save</button> </td>
                            </tr>
                        `)
                    })

                    record.append(`
                        <tr>
                            <th colspan="2"></th>
                            <th class="total_amount">${moneyFormat(t_amount)}</th>
                            <th class="total_discount">${moneyFormat(t_discount)}</th>
                            <th class="total">${moneyFormat(t_amount - t_discount)}</th>
                            <th></th>
                        </tr>
                    `)

                    record.append(`
                        <tr>
                            <th colspan="12"><button class="save_all btn btn-success  float-right"><i class="fas fa-save"></i> Save All Changes</button></th>
                        </tr>
                    `);

                    $('#page_links').html(dropPaginatedPages(res.data.records.links));
                }).fail(function (res) {
                })
            }



            if(c_fee > 0 && c_class > 0) {
                fetchSettedFee(c_fee, c_class)
            }

            function fetchFeeRequirments()
            {
                $.ajax({
                    method: 'get',
                    url: 'http://127.0.0.1:8000/api/control/fee_requirements'
                }).done(function (res) {
                    form = $('#setSchoolFees');
                    clas = $(form).find('select[name="class"]')
                    clas.html(`<option disabled selected>Select a Class</option>`)
                    $('#cla').html(`<option disabled selected>Class</option>`)
                    res.data.classes.map(cla => {
                        clas.append(`<option value="${cla.id}" >${cla.class}</option>`)
                        $('#cla').append(`<option value="${cla.id}" ${ (c_class == cla.id) ? 'selected' : ''} >${cla.class}</option>`)
                    })

                    fee_body = $(form).find('select[name="fee_category"]')
                    fee_body.html(`<option disabled selected>Select Fee Category</option>`)
                    $('#fee_cat').html(`<option disabled selected>Fee </option>`)
                    res.data.fees.map(fee => {
                        fee_body.append(`<option value="${fee.id}" >${fee.fee}</option>`)
                        $('#fee_cat').append(`<option value="${fee.id}" ${ (c_fee == fee.id) ? 'selected' : ''} >${fee.fee}</option>`);
                    })
                }).fail(function (res) {
                })
            }
            fetchFeeRequirments();

            $('#viewFee').on('submit', function (e) {
                e.preventDefault();
                form = $(this);
                cla = $(form).find('select[name="cla"]').val();
                fee = $(form).find('select[name="fee_cat"]').val();
                if(!cla || !fee) { littleAlert('The class and fee field is required', 1); return; }
                location.href= `/control/set_fee/${fee}/${cla}`
            })


            $('#setSchoolFees').on('submit', function(e) {
                e.preventDefault();
                form = $(this);

                amount = $(form).find('input[name="fee_amount"]').val();
                cla = $(form).find('select[name="class"]').val();
                fee_category = $(form).find('select[name="fee_category"]').val();

                if(!amount || !cla || !fee_category) { littleAlert('All fields are required', 1); return }

                $.ajax({
                    method: 'post',
                    url: 'http://127.0.0.1:8000/api/control/set_fee',
                    data: {
                        fee_cat_id: fee_category,
                        class_id: cla,
                        amount: amount
                    },
                    beforeSend:() => {
                        btnProcess('.setSchoolFees', 'Set Fee', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    btnProcess('.setSchoolFees', 'Set Fee', 'after');
                    location.href=`/control/set_fee/${fee_category}/${cla}`

                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.setSchoolFees', 'Set Fee', 'after');
                })

            })


            $('body').on('click', '.save_all', function() {
                trs = $('.single')
                data = [];
                t_amount = 0
                t_discount = 0
                trs.map(row => {
                    tr = trs[row].children;
                    td_amt = tr[2].children
                    discount = tr[3].children[0].value
                    amount = td_amt[0].value;
                    id = td_amt[1].value;
                    arr = { id: id, amount: amount, discount: discount}
                    data.push(arr)
                    t_amount += parseInt(amount)
                    t_discount += parseInt(discount)
                });

                $.ajax({
                    method : 'post',
                    url: api_url+'update_school_fee_record',
                    data: {
                        payments: data
                    },
                    beforeSend:() => {
                        btnProcess('.save_all', 'Save All Changes', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    $('.total_amount').html(moneyFormat(t_amount))
                    $('.total_discount').html(moneyFormat(t_discount))
                    $('.total').html(`${moneyFormat(t_amount - t_discount)} `)
                    btnProcess('.save_all', '<i class="fas fa-save"></i> Save All Changes', 'after');
                }).fail(function(res) {
                    parseError(res.responseJSON)
                    btnProcess('.save_all', '<i class="fas fa-save"></i> Save All Changes', 'after');
                })

            })



            function calculateAmount() {
                amounts = $('input[name="amount"]'); amount = 0
                discounts = $('input[name="discount"]'); discount = 0
                amounts.map((index) => {
                    amt = amounts[index];
                    amount += parseInt(amt.value)
                });
                discounts.map((index) => {
                    dis = discounts[index]
                    discount += parseInt(dis.value);
                })

                $('.total_amount').html(moneyFormat(amount))
                $('.total_discount').html(moneyFormat(discount))
                $('.total').html(`${moneyFormat(amount - discount)} `)
                return [amount, discount];
            }



            $('body').on('click', '.save_changes', function () {
                btn = $(this);
                td = btn.parent();
                td_siblings = td.siblings()
                td_siblings_elements = td_siblings[2].children
                discount_node = td_siblings[3].children[0]
                amount_node = td_siblings_elements[0];
                id = td_siblings_elements[1].value;
                amount = amount_node.value
                discount = discount_node.value

                // if(discount > amount) { littleAlert('Discount cannot be greater than amount ...', 1); return }

                $.ajax({
                    method: 'post',
                    url: api_url+'update_school_fee_per_record',
                    data: {
                        payment_id: id,
                        amount: amount,
                        discount: discount
                    },
                    beforeSend:() => {
                        btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>Processing...</i>`)
                        $('.save_changes').attr('disabled', 'disabled');
                    }
                }).done(function(res) {
                    littleAlert(res.message);

                    discount_node.max =  amount_node.value

                    btn.html(`<i class="fas fa-save"></i> Save`)
                    $('.save_changes').removeAttr('disabled');
                    calculateAmount();

                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btn.html(`<i class="fas fa-save"></i> Save`)
                    $('.save_changes').removeAttr('disabled');

                })





            })

        })
    </script>


@endsection
