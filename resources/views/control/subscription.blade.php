@extends('layouts.app')

@section('page_title')
Subscriptions
@endsection

@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subscriptions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Subscriptions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title n">
                            <i class="fas fa-plus-square"></i>
                            Link Livepetal Wallet
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="linkWallet" class="row" >
                            <div class="col-md-12 form-group">
                                <b>Note:</b> You have to link your livpetal wallet before you can perform transactions
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="liveid" class="form-control" placeholder="Live Petal ID">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="" autocomplete="off" autofill="close" name="pwd" class="form-control" placeholder="Live Petal Password">
                            </div>
                            <div class="form-group col-12 mb-0 ">
                                <button type="submit"  class="btn btn-secondary float-right linkWallet">Link Wallet</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Recently Linked Wallets
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody id="wallets_linked">


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>


            <div class="col-lg-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-plus-square"></i>
                            Purchased Registration Slots
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span><b>Total</b>: <span class="total_slot">0</span></span>
                            <span><b>Used</b>: <span class="used_slot">0</span></span>
                            <span><b>Availabe</b>: <span class="slots_av">0</span></span>
                        </div>
                        <br>

                        <form action="" id="slotPurchase" class="row">
                            <div class="col-md-6 form-group">
                                <input type="number" name="slots" min="1" class="form-control" placeholder="Number to purchase">
                            </div>
                            <div class="col-md-6 form-group">
                                <select name="pack" class="form-control">
                                    <option value=1>Basic | {{moneyFormat(500)}} / Student </option>
                                </select>
                            </div>
                            <div class="form-group col-12 mb-0 ">
                                <span><b>Wallet Balance: <span class="walletbalance">0</span></b></span>
                                <button type="submit"  class="btn btn-secondary  float-right" disabled>Continue Process</button>
                                <button type="submit"  class="btn btn-secondary slotPurchase float-right" style="margin-right: 10px">Pay With Livepetal</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Slot Purchase History
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Slots</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>By</th>
                                </tr>
                            </thead>
                            <tbody id="slots_history">


                            </tbody>
                        </table>
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


            $('#linkWallet').on('submit', function(e) {
                e.preventDefault()
                form = $(this)

                liveid = $(form).find('input[name="liveid"]').val();
                password = $(form).find('input[name="pwd"]').val();


                $.ajax({
                    method: 'post',
                    url: api_url+'link/wallet',
                    data: {
                        id: liveid,
                        password: password
                    },
                    beforeSend:() => {
                        btnProcess('.linkWallet', '', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.linkWallet', 'Link Wallet', 'after')
                    fetchLinkedWallets();
                    form[0].reset();
                    walletBalance();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.linkWallet', 'Link Wallet', 'after')
                })
            })


            function slotBalance()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'available_slots'
                }).done(function(res) {
                    $('.total_slot').html(res.total)
                    $('.used_slot').html(res.used)
                    $('.slots_av').html(res.available)
                }).fail(function(res) {
                })
            }

            slotBalance();





            function fetchLinkedWallets()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'linked_wallet'
                }).done(function(res) {
                   body = $('#wallets_linked');
                   body.html('')
                   res.data.map(wal => {
                       body.append(`
                            <tr>
                                <td>${wal.live_id}</td>
                                <td>${wal.name}</td>
                                <td>${wal.email}</td>
                                <td>${wal.phone}</td>
                            </tr>
                       `)
                   })
                }).fail(function(res) {
                })
            }


            fetchLinkedWallets();


            function slotsPurchaseHistory()
            {
                $.ajax({
                    method: 'post',
                    url: api_url+'slot/history'
                }).done(function(res) {
                    console.log(res);
                    body = $('#slots_history')
                    body.html(``);
                    res.data.map(slt => {
                        body.append(`
                            <tr>
                                <td>${slt.slots}</td>
                                <td>${moneyFormat(slt.amount)}</td>
                                <td>${formatDate(slt.created_at)}</td>
                                <td>${slt.user.name}</td>
                            </tr>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }

            slotsPurchaseHistory();

            function walletBalance()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'wallet_balance'
                }).done(function(res) {
                    $('.walletbalance').html(moneyFormat(res.balance))
                }).fail(function(res) {
                })
            }

            walletBalance();


            $('#slotPurchase').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                slots = $(form).find('input[name="slots"]').val();
                pack = $(form).find('select[name="pack"]').val();
                term_id = `{{$term_id}}`
                if(!slots || slots <= 0) { littleAlert('The slots field is required', 1); return; }
                $.ajax({
                    method: 'post',
                    url: api_url+'purchase_slot',
                    data: {
                        slots: slots,
                        pack: pack,
                        term_id: term_id,
                    },
                    beforeSend:() => {
                        btnProcess('.slotPurchase', '', 'before')
                    }
                }).done(function(res){
                    littleAlert(res.message);
                    btnProcess('.slotPurchase', 'Pay With Livepetal', 'after')
                    slotsPurchaseHistory();
                    slotBalance();
                    walletBalance();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.slotPurchase', 'Pay With Livepetal', 'after')
                    console.log(res);
                })
            })


        })



    </script>


@endsection
