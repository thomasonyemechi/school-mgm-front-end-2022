@extends('layouts.app')

@section('page_title')
Renew Subscription
@endsection

@section('page_content')


<style>
    .sub-start{
        background-image: url('http://127.0.0.1:8000/assets/img/schoolpetal.png');
        /* background: linear-gradient(to right, rgb(0, 168, 255), rgb(43, 43, 189)); */
        background: rgb(0, 168, 255);
        color: white;
        border-color: green;
        border-style: inset;
        opacity: 0.7;
    }

    .sub-start:hover {
        cursor: pointer;
    }

    .package-name {
        background: linear-gradient(to right, rgb(0, 168, 255), rgb(43, 43, 189));
        color: white;
        text-align: center;
        border-radius: 10px 0 0 5px;
        padding: 10px 0;
    }

    .package-name, .sub-start {
        border-top-right-radius: 50px;
        border-top-left-radius: 50px;
    }



    .btn-default, .sub-start {
        border-bottom-right-radius: 50px;
        border-bottom-left-radius: 50px;
    }



/*
    .package-end {
        border-bottom-right-radius: 300px;
        border-bottom-left-radius: 300px;
    } */

    .package-end{
        background: linear-gradient(to right, rgb(0, 168, 255), rgb(43, 43, 189));
        height: 50px;
    }


    .package-content{
        padding: 10px 30px;
    }
</style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 tt-ti">Renew Subscription</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Renew Subscription</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-body">
                        <div class="row" id="pack_body">


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
                    'Authorization': `Bearer {{access_token()}}`,
                }
            });


            function fetchSpot() {
                $.ajax({
                    method: 'get',
                    url: api_url+`renewal/spot/{{$term_id}}`
                }).done(function(res) {
                    console.log(res);
                    if(res.term.paid == 1) {
                        littleAlert('This time has already been paid for, you cannot repay', 1)
                    }
                    term_text = `${term_text(res.term.term)}, ${res.term.session.session}`

                    $('.tt-ti').html(`Suscribe (${term_text})`)
                    body = $('#pack_body');
                    body.html('');
                    res.data.map(pac => {
                        feature_string = ''

                        pac.features.forEach(fea => {
                            feature_string += `
                                <li>${fea}</li>
                            `
                        });
                        body.append(`
                            <div class="col-lg-5 offset-lg-1 col-md-6">
                                <div class="sub-start">
                                    <div class="package-name">
                                        <h2>${pac.name}</h2>
                                    </div>
                                    <div class="package-content">
                                        <div class="text-center mb-2">
                                            <h2 class="mb-0">${moneyFormat(pac.amount)}/<small>Student</small></h2>
                                            <span class=" mb-5" style="word-spacing: 5px; letter-spacing: 5px;">Every Term</span>
                                        </div>
                                        <div class="text-center mb-2">
                                            <ul style="font-size: larger">
                                                ${feature_string}
                                            </ul>
                                        </div>
                                        <div class="text-center">
                                            <div class="mb-3">
                                                <span>Total Students: <b>${pac.total_student}</b></span><br>
                                                <span>Active: <b>${pac.active}</b></span><br>
                                                <span>Price: <b>${moneyFormat(pac.price)}</b></span>
                                            </div>

                                            <button class="btn btn-default btn-block subscribe" data-id = ${pac.id} ${(res.term.paid == 1) ? 'disabled' : ''}>Subscribe For ${term_text}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchSpot();

            $('body').on('click', '.subscribe', function() {
                if(!confirm('The required amount will be deducted from you live petal wallet')){ return ;}
                id = $(this).data('id');
                term = `{{$term_id}}`
                btn = $(this)
                btn_text = btn.html()
                console.log();
                    $.ajax({
                        method: 'post',
                        url: api_url+'renew',
                        data: {
                            pack: id,
                            term_id: term,
                        },
                        beforeSend:() => {
                            btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>processing request ... </i>`)
                            btn.attr('disabled', 'disabled');
                        }
                    }).done(function(res) {
                        littleAlert(res.message);
                        console.log(res);
                        btn.removeAttr('disabled');
                        btn.addClass('text-success');
                        btn.html('Subscription was sucessfull');
                        setTimeout(() => {
                            location.href = '/control/setting/general'
                        }, 300);
                    }).fail(function(res) {
                        console.log(res);
                        parseError(res.responseJSON);
                        btn.html(btn_text)
                        btn.removeAttr('disabled');
                    })
            })


        })



    </script>


@endsection
