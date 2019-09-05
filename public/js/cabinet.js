function reciveJson(data) {
    //alert(data);

    if (data.flag == 'close') {
        console.log('close');
        console.log(data.returndata);

        podstanov = data.returndata;
        bt = document.getElementById('closeBt' + podstanov).style.background = '#90ee90';
        bt = document.getElementById('closeBt' + podstanov).innerHTML = `<div onclick="openMe ('` + data.returndata + `')" id="closeProgram">Відновити</div>`;
        bg = document.getElementById('backgr' + podstanov).style.background = '#CAC9AD';
        document.getElementById('edit' + podstanov).innerHTML = "Редагувати";
    }
    if (data.flag == 'open') {
        console.log('open');
        console.log(data.returndata);
        podstanov = data.returndata;
        bt = document.getElementById('closeBt' + podstanov).style.background = '#f0e68c';
        bt = document.getElementById('closeBt' + podstanov).innerHTML = `<div onclick="closeMe ('` + data.returndata + `')" id="closeProgram">Завершити</div>`;
        bg = document.getElementById('backgr' + podstanov).style.background = '#aee770';
        document.getElementById('edit' + podstanov).innerHTML = "<a href='/edit?t=" + data.returndata + "' >Редагувати</a>";


    }

}

function errorJson(data) {
    console.log(data);
    //alert(data);
    if (data.status == "422") {
        if (data.responseJSON.errors.nameAnimal != "")
            document.getElementById("nameError").innerHTML = "Не удалось остановить";
        //console.log(data.responseJSON.errors.nameAnimal);
    }
}

function ajaxPost(url, params) {
    //alert('url:'+url+' Params: '+params);
    $.ajax({
        type: 'POST',
        url: url,
        data: params,
        success: function (data) {
            reciveJson(data);
        },
        error: function (data) {
            errorJson(data);
        }
    });
}

function closeMe(token) {
    params = "_token=<?php echo csrf_token() ?>&t=" + token;
    ajaxPost('close', params);
}

function openMe(token) {
    params = "_token=<?php echo csrf_token() ?>&t=" + token;
    ajaxPost('/open', params);
}
