function ResultTemplate(result, set) {
    school = result.school;

    title = result.surname + ' ' + result.firstname + ' ' + result.othername;
    data = { id: result.others.result_id, name: title, p_rem: result.others.principal_remark, t_rem: result.others.teacher_remark }

    subject_string = ''
    total_score = 0;

    check_prev_term = 0;

    result.results.forEach(res => {

        total_score += res.total;
        if (check_prev_term == 0) {
            check_prev_term = (res.prev == 0) ? 0 : 1;
        }
        last_term = cauclatePrev(res.prev);
        ttr = (res.prev == 0) ? `` : `
            <td class="center">${num(last_term)}</td>
            <td class="center">${num(res.total)}</td>
        `;
        subject_string += `
        <tr>
            <td class="center">${res.subject}</td>
            <td class="center">${res.t1}</td>
            <td class="center">${res.t2}</td>
            <td class="center">${res.t3}</td>
            <td class="center">${res.exam}</td>
            <td class="center">${res.term_total}</td>
                ${ttr}
            <td class="center">${num(res.cla_avr)}</td>
            <td class="center">${res.grade}</td>
            <td class="center">${res.remark}</td>
        </tr>
        `
    });


    chg = (check_prev_term == 0) ? `<th>Total</th>` : `
        <th>Term Total</th>
        <th>Last Term</th>
        <th>Total</th>
    `;

    head = `
        <tr>
            <th>Subjects</th>
            <th>CA1</th>
            <th>CA2</th>
            <th>CA3</th>
            <th>Exam</th>
            ${chg}
            <th>Class Av</th>
            <th>Grade</th>
            <th>Remark</th>
        </tr>
    `


    return `
    <p class="p-0 m-0" style="page-break-before: always">
    <div class="card">
        <div class="card-body p-1">
            <div style="border: solid thin #CCC" class="mb-1 p-2">
                <table class="" width="100%">
                    <tr>
                        <th>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <img width="100" class="img-circle" src="${api_url_root+school.logo}">
                                    </td>
                                    <td width="50%">
                                        <div class="text-center">
                                            <h1 style="font-size: 25px; font-weight:bold;" class="mb-0">
                                                ${school.name}</h1>
                                            <p class="mb-0">${school.address} </p>
                                            <h3 style="font-size: 15px;" class="mt-0">TERMLY CONTINOUS
                                                ASSESSMENT DOSSIER <br>${term_text(result.term.term)}, ${result.term.session} ACADEMIC SESSION </h3>
                                        </div>
                                    </td>
                                    <td width="25%"></td>
                                </tr>
                            </table>
                        </th>
                    </tr>

                </table>
            </div>

            <table class="table table-bordered mb-1">
                <thead>
                    <tr>
                        <td colspan="4"><b>Name:</b> ${title}</td>
                        <td colspan="4"><b>Class:</b> ${result.others.class}</td>
                        <td colspan="4"><b>Gender:</b> ${result.sex}</td>
                    </tr>
                </thead>
            </table>

            <table class="table table-bordered mb-1">
                <thead>
                    ${head}
                </thead>
                <tbody>
                    ${subject_string}
                </tbody>

            </table>

            <table class="table table-bordered">
                <tfoot>
                    <tr>
                        <th colspan="2">Subjects: ${result.results.length}</th>
                        <th colspan="2">Total Score: ${num(total_score)}</th>
                        <th colspan="2">Average: ${num(total_score/result.results.length)}</th>
                        <th colspan="2">Class Average: </th>
                        <th colspan="2">No in class: 20</th>
                    </tr>
                </tfoot>
            </table>
            <table class="table table-bordered mt-1" width="100%">
                <tfoot>
                    <tr>
                        <th>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Vacation Date: </b><span style="font-weight: lighter">${result.term.close}</span>
                                        </div>
                                        <div class="col-6">
                                            <b>Resumption Date: </b><span style="font-weight: lighter">${result.term.resume}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Teacher's Comment:</b><br>
                                            <span style="font-weight: lighter" class="t_rem">
                                            ${result.others.teacher_remark}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <b>Principal's Comment: </b><br>
                                            <span style="font-weight: lighter" class="p_rem">
                                                ${result.others.principal_remark}
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-12 hide@print mt-3" >
                    <button class="btn btn-info float-right" onclick="print()">Print</button>
                    <button class="btn btn-secondary float-right mr-2 up_rem" data-data='${JSON.stringify(data)}'>Update Remarks</button>
                </div>
            </div>
        </div>
    </div>
</p>
   `
}


const num = (num) => {
    return num.toFixed(0)
}



function cauclatePrev(prev) {
    total = 0;
    c = 0;
    if (prev == 0) { return 0; }
    prev.forEach(sc => {
        if (sc.total > 0) {
            c++;
        }
        total += sc.total
    });
    if (total == 0) {
        return 0;
    }
    val = total / c
    return val;
}


$('body').on('click', '.up_rem', function() {
    data = $(this).data('data');
    modal = $('#updateRemark');
    modal.modal('show');
    $(modal).find('input[name="teacher"]').val(`${data.t_rem}`);
    $(modal).find('input[name="principal"]').val(`${data.p_rem}`);
    $(modal).find('input[name="id"]').val(`${data.id}`);
    $(modal).find('.modal-title').html(`Update Remark ${data.name}`);
})


$('body').on('click', '.updateRemark', function(e) {
    e.preventDefault();
    modal = $('#updateRemark');
    p = $(modal).find('input[name="principal"]').val();
    t = $(modal).find('input[name="teacher"]').val();
    id = $(modal).find('input[name="id"]').val();

    $.ajax({
        method: 'post',
        url: api_url + 'result/update_remark',
        data: {
            result_id: id,
            principal_remark: p,
            teacher_remark: t
        },
        beforeSend: () => {
            btnProcess('.updateRemark', '', 'before');
        }
    }).done(function(res) {
        littleAlert(res.message);
        btnProcess('.updateRemark', 'Update', 'after');
        $('.t_rem').html(t);
        $('.p_rem').html(p);
    }).fail(function(res) {
        parseError(res.responseJSON);
        btnProcess('.updateRemark', 'Update', 'after');
    })
})