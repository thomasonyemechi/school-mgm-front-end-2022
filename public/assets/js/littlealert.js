const api_url = 'http://127.0.0.1:8000/api/control/'
const api_url_root = 'http://127.0.0.1:8000/'

function littleAlert(msg, t = 0) {
    color = (t == 1) ? 'danger' : 'success';
    icon = (t == 1) ? 'ban' : 'checked';
    ret = `
        <div class="alert bg-${color}" style="position:fixed; top:55px; right:15px; z-index:1">
            <i class="icon fe fe-${color}  text-white"> ${msg}  </i>
        </div>
    `
    alat = $('.littleAlert');
    alat.fadeIn();
    alat.html(ret);

    setTimeout(function() {
        alat.fadeOut();
    }, 3000);
}

function parseError(error) {
    error_text = '';
    if (!error) {
        error_text = 'Error processing request, Pls try again';
    } else if (error.message) {
        error_text = error.message;
    } else if (error.errors) {
        errs = error.errors;
        errs.forEach(err => {
            error_text += err + '<br>'
        });
    } else {
        error_text = 'Error, Processing Request'
    }
    littleAlert(error_text, 1);
    return error_text;
}

function btnProcess(selector, btn_text, moment) {
    if (moment == 'before') {
        $(selector).attr('disabled', 'disabled');
        $(selector).html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>processing request ... </i>`);
    } else if (moment == 'after') {
        $(selector).removeAttr('disabled');
        $(selector).html(btn_text);
    }
}

function term_text(term) {
    val = '';
    if (term == 1) {
        val = 'First Term'
    } else if (term == 2) {
        val = 'Second Term'
    } else if (term == 3) {
        val = 'Third Term';
    }

    return val;
}

function staff_role(role_id) {
    txt = ''
    if (role_id == 10) {
        txt = 'Administrator 1'
    } else if (role_id == 9) {
        txt = 'Administrator'
    } else if (role_id == 8) {
        txt = 'Accountant'
    } else if (role_id == 7) {
        txt = 'Teacher'
    } else if (role_id == 6) {
        txt = 'Sales Rep'
    }
    return txt;
}


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];


    return `${day} ${monthNames[month - 1]}, ${year}`;
}



function dropPaginatedPages(links) {
    link_txt = ''
    links.forEach(link => {
        link_txt += ` <li class = "page-item goToList ${ (link.active == true) ? 'active' :''}"data - data = '${JSON.stringify(link)}' >
        <a href = "?page=${link.label}"class = "page-link" > ${ link.label } </a></li > `;
    });

    body = ` <div class = "d-flex justify-content-center mt-3 mb-3" >
        <div class = "card-tools" >
        <ul class = "pagination" >${ link_txt }</ul> </div> </div>
    `
    return (links.length > 3) ? body : '';
}




const moneyFormat = (num) => {
    var numb = new Intl.NumberFormat();
    return '$ ' + numb.format(num);
}


function checkRes(res) {
    obj = res;
    if (res == null) {
        obj = { t1: 0, t2: 0, t3: 0, exam: 0, total: 0 }
    }
    return obj;
}
