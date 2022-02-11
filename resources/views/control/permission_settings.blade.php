@extends('layouts.app')

@section('page_title')
Permission Settings
@endsection

@section('page_content')
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Permission</li>
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
                            <i class="fas fa-edit"></i>
                            Edit Staff Permissions
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Staff</th>
                                        <th class="text-center">Reg Mgm</th>
                                        <th class="text-center">Fee Mgm</th>
                                        <th class="text-center">Result</th>
                                        <th class="text-center">Other</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="user_body_list">

                                </tbody>
                            </table>
                        </div>

                        <div id="page_links" style="color: rgb(36, 35, 32)">

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





            function pullPermission() {
                $.ajax({
                    method: 'get',
                    url: api_url+`users/permission?page={{$_GET['page'] ?? 1}}`
                }).done(function(res) {
                    body = $('#user_body_list')
                    body.html(``)
                    res.data.data.map((user, index) => {
                        body.append(`
                            <tr class="single">
                                <td class="align-middle">${index+1}</td>
                                <td class="align-middle" >${user.name} (${staff_role(user.role)})</td>
                                <td class="text-center">
                                    <input type="hidden" name="permission_id" value="${user.permission.id}" >
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="reg" value="${(user.permission.registration == 1) ? 1 : 0}" ${(user.permission.registration == 1) ? 'checked' :''} id="reg${index}">
                                        <label for="reg${index}" data-id="reg${index}" ></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="fee" value="${(user.permission.fee == 1) ? 1 : 0}" ${(user.permission.fee == 1) ? 'checked' :''} id="fee${index}">
                                        <label for="fee${index}" data-id="fee${index}" ></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="result" value="${(user.permission.u_result == 1) ? 1 : 0}" ${(user.permission.u_result == 1) ? 'checked' :''} id="u_result${index}">
                                        <label for="u_result${index}" data-id="u_result${index}"></label>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="other" value="${(user.permission.other == 1) ? 1 : 0}" ${(user.permission.other == 1) ? 'checked' :''} id="other${index}">
                                        <label for="other${index}" data-id="other${index}"></label>
                                    </div>
                                </td>

                                <td class="align-middle"><button class="btn btn-xs btn-success save_change float-right"><i class="fas fa-save"></i> Save</button></td>


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
                })
            }
            pullPermission();


            $('body').on('click', '.save_change', function() {
                btn  = $(this);
                parent_td = btn.parent();
                parent_siblings = parent_td.siblings()
                ///extracting the registration permssion value and the permssion id
                reg_parent = parent_siblings[2].children;
                permission_id = reg_parent[0].value;
                reg_per = reg_parent[1].children[0].value;
                //extracting the fee permission id
                fee_per = parent_siblings[3].children[0].children[0].value;
                result_per = parent_siblings[4].children[0].children[0].value;
                other_per = parent_siblings[5].children[0].children[0].value;
                $.ajax({
                    method: 'post',
                    url: api_url+'permission/update',
                    data: {
                        permission_id: permission_id,
                        registration: reg_per,
                        result: result_per,
                        fee: fee_per,
                        other: other_per
                    },
                    beforeSend:() => {
                        $('.save_change').attr('disabled', 'diabled');
                        btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> ...`)
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    $('.save_change').removeAttr('disabled');
                    btn.html(`<i class="fas fa-save"></i> Save`)
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    $('.save_change').removeAttr('disabled');
                    btn.html(`<i class="fas fa-save"></i> Save`)
                })
            })


            $('body').on('click', 'label', function() {
                label = $(this).data('id');
                inp = $(`#${label}`);
                new_val = (inp.val() == 0 ) ? 1 : 0;
                inp.val(new_val);
            })


            $('body').on('click', '.save_all', function() {
                trs = $('.single')
                data = [];
                trs.map(row => {
                    parent = trs[row].children

                    reg_parent = parent[2].children;
                    permission_id = reg_parent[0].value;
                    reg_per = reg_parent[1].children[0].value;
                    //extracting the fee permission id
                    fee_per = parent[3].children[0].children[0].value;
                    result_per = parent[4].children[0].children[0].value;
                    other_per = parent[5].children[0].children[0].value;

                    arr = { permission_id: permission_id, registration: reg_per, fee: fee_per, result: result_per, other: other_per}
                    data.push(arr)
                });

                $.ajax({
                    method: 'post',
                    url: api_url+'permission/update_all',
                    data: {
                        data: data
                    },
                    beforeSend:() => {
                        $('.save_change').attr('disabled', 'diabled');
                        btnProcess('.save_all', '', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.save_all', '<i class="fas fa-save"></i> Save all changes', 'after')
                    $('.save_change').removeAttr('disabled');
                }).fail(function(res) {
                    parseError(res.responseJSON)
                    btnProcess('.save_all', '<i class="fas fa-save"></i> Save all changes', 'after')
                    $('.save_change').removeAttr('disabled');
                })

            })
        })
    </script>

@endsection
