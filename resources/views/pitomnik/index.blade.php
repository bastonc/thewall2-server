<HTML>
<head>
    <title> Питомник</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <style>
        .closed {
            display: none;
        }
        .overlay {
            position: fixed;
            /*display:none;*/
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 50;

            background: rgba(0, 0, 0, 0.6);
        }
        .close-button {
            position: absolute;
            z-index: 150;
            top: 10px;
            right: 20px;
            border: 0;
            background: black;
            color: white;
            padding: 5px 10px;
            font-size: 1 rem;
        }
        .form{
            width: 300px;
            max-width: 100%;
            height: 200px;
            max-height: 100%;
            position: fixed;
            z-index: 100;
            left: 50%;
            top: 50%;
            /* Центруем */
            transform: translate(-50%, -50%);
            background: white;
            box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
            text-align: center;
            padding-top:30px;
            padding-left:30px;
            /*width:100 px;
            height:50 px;
            position: absolute;
            top: 100px;
            left: 60%;

            /*border:2 px;*/
        }
        .stateModal{
            width: 300px;
            max-width: 100%;
            height: 200px;
            max-height: 100%;
            position: fixed;
            z-index: 150;
            left: 50%;
            top: 50%;
            /* Центруем */
            transform: translate(-50%, -50%);
            background: white;
            box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
            text-align: center;
            padding-top:30px;
            padding-left:30px;
            /*width:100 px;
            height:50 px;
            position: absolute;
            top: 100px;
            left: 60%;

            /*border:2 px;*/
        }
        .animals{
            width: 500px;
            max-width: 100%;
            height: 300px;
            max-height: 100%;
            position: fixed;
            z-index: 100;
            left: 50%;
            top: 50%;
            /* Центруем */
            transform: translate(-50%, -50%);
            background: white;
            box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
            text-align: center;
            padding-top:30px;
            padding-left:30px;
            font-family: Lato;
            text-align-all: center;
            /*width:100 px;
            height:50 px;
            position: absolute;
            top: 100px;
            left: 60%;

            /*border:2 px;*/
        }

        .addButtonForm{
            width:100;
            /*height:20;*/
            position: absolute;
            top: 100px;
            left: 5%;
            border: 3px double #645a4e;
            /*text-align: center;*/
            /*border:2 px;*/
        }
        .delButtonForm{
            width:100;
            /*height:20;*/
            position: absolute;
            top: 100px;
            left: 85%;
            border: 3px double #645a4e;
            /*text-align: center;*/
            /*border:2 px;*/
        }
        .statePitomnik{
            /*width:100 px;
            height:200 px;*/
            position: absolute;
            top: 100px;
            left: 17%;
            /*text-align: center;*/
            /*border:2 px;*/
        }
        .balance{
            /*width:100 px;
            height:200 px;*/
            position: absolute;
            top: 50px;
            left: 50%;
            /*text-align: center;*/
            /*border:2 px;*/
        }
        .buttonMoney{
            /*width:100 px;
            height:200 px;*/
            position: absolute;
            top: 50px;
            left: 70%;
            /*text-align: center;*/
            /*border:2 px;*/
        }
        .transaction{
            /*width:400 px;
            height:200 px;*/
            position: absolute;
            top: 100px;
            left: 55%;
            /*text-align: center;*/
            /*border:2 px;*/
        }
        .balans{
            /*width:100 px;
            height:50 px;*/
            position: absolute;
            top: 100px;
            left: 75%;
            /*text-align: center;*/
            /*border:2 px;*/
        }



    </style>
</head>


<body>
<!-- слой кнопки для добавления животного -->
<div class="addButtonForm" id="addAnimalDiv">
    <span id="testresponse"></span>
    <button id="addAnimalBtn">Принять животное</button>
</div>
<!------------------------------------------>
<!-- слой кнопки для удаления животного -->
<div class="delButtonForm" id="delAnimalDiv">
    <button id="delAnimalBtn">Пристроить животное</button>
</div>
<!------------------------------------------>
<!-- слой кнопки для статистики питомника -->
<div class="statePitomnik" id="stateCellDiv">

</div>
<!------------------------------------------>
<!-- слой кнопки для финансовых событий (транзакций) -->
<div class="transaction" id="transactionDiv">

</div>
<!------------------------------------------>
<input type="button" value="" id="buttonMoney" class="buttonMoney closed">
<!-- слой кнопки для счет получения денег из казначейства -->
<div class="balans" id="transactionDiv">

</div>
<!------------------------------------------>
<div class="overlay closed" id="overlayDiv"></div>


<!--форма добавления/удаления животного -->
<div class="form closed" id="formAnimal">

    <button class="close-button" id="closeButton" title="Закрыть модальное окно">X</button>
    <div id="stateModal" class="stateModal closed">  </div>
    <div id="formModal" class="form closed">
    <form method=GET action="" id="AnimalForm" name="Animalform" onsubmit="return validateForm ();" >
        <table>
            <tr><td colspan=2 align="center"><span id="actAnimal"></span></td></tr>
            <tr><td>Вид животного:</td><td><select size="1" name="typeAnimal" id="typeAnimal">
                        <option value="cat"selected>Кошка</option>
                        <option value="dog">Собака</option>
                    </select></td><tr>
            <tr><td>Кличка:</td><td><input class="inputForm" id="addName" name="nameAnimal"><span style="color:red; font-size:10px;" id="nameError"></span></td></tr>
            <tr><td>Возраст</td><td><input size=4 class="inputForm" id="addAge" name="ageAnimal"><span style="color:red; font-size:10px;" id="ageError"></span></td></tr>
            <tr><td>Характер</td><td><select size="1" name="character" id="character">
                                            <option value="kind" selected>Добрый</option>
                                            <option value="evil">Злой</option>
                                     </select></td>
            </tr>
            <tr><td colspan=2 align="center"><input type="submit" id="submitButton" value=""></td></tr>
        </table>
    </form>
    </div>
</div>
<!---------------------------------------->
<!--слой перечня животных в клетке -->
<div class="animals closed" id="animalInCell">

    <button class="close-button" id="closeButtonAnimal" title="Закрыть модальное окно">X</button>
    <div class="animals" id="animalsInCellContent">

</div>
</div>
<!----------------------------------------->
<!--слой баланса -->
    <div class="balance" id="balance">
        Баланс:
    </div>
    <!---------------------------------------->






<script>
    window.onload = function (){
        addAnimalDiv.addEventListener("click", function(){showModal("formAnimal","formModal","overlayDiv","closed");
            //var pathForm = document.querySelector("#addAnimalForm");
            //document.getElementById('AnimalForm').action="/addanimal";
            document.getElementById('actAnimal').innerHTML="Принять животное в питомник";
            document.getElementById('submitButton').value = "Принять животное";
        },false);

        closeButton.addEventListener("click", function(){showModal("formAnimal","formModal","overlayDiv","closed");} ,false);
        closeButtonAnimal.addEventListener("click", function(){showModal("animalInCell","formModal","overlayDiv","closed");} ,false);

        delAnimalDiv.addEventListener("click", function(){showModal("formAnimal","formModal","overlayDiv","closed");
            document.getElementById('AnimalForm').action="/delanimal";
            document.getElementById('actAnimal').innerHTML="Отдать животное в добрые руки";
            document.getElementById('submitButton').value = "Пристроить животное";
        },false);
        addName.addEventListener("input", function () {document.getElementById("nameError").innerHTML = "";},false)
        addAge.addEventListener("input", function () {document.getElementById("ageError").innerHTML = "";},false)
        addAge.addEventListener("blur", function () {document.getElementById("ageError").innerHTML = "";},false)
        addAge.addEventListener("input", function () {if (!document.Animalform.ageAnimal.value.match(/^\d+$/)){

            document.getElementById("ageError").innerHTML = "Возраст должен состоять только из цифр";
        }},false)
        //submitButton.addEventListener("click", function(){alert(1);
        // },false);
        params="_token=<?php echo csrf_token() ?>&state=init";
        ajaxPost('getall',params)



    }

    function showModal(formDiv,layDiv, overlayDiv, classtoggle){
        var formAdd = document.querySelector("#"+formDiv);
        var layDiv = document.querySelector("#"+layDiv);
        var overlay = document.querySelector("#"+overlayDiv);

        formAdd.classList.toggle(classtoggle);
        layDiv.classList.toggle(classtoggle);
        overlay.classList.toggle(classtoggle);
        //formAddAnimal.style.display = "block";



    }
    function validateForm(){
        var result=true;

        if(document.Animalform.nameAnimal.value=="") {
            result=false;
            document.getElementById("nameError").innerHTML = "Заполните кличку Животного";
        }
        if(document.Animalform.nameAnimal.value=="") {
            result=false;
            document.getElementById("ageError").innerHTML = "Заполните возраст Животного";
        }
        if (!document.Animalform.ageAnimal.value.match(/^\d+$/)) {
            result=false;
            document.getElementById("ageError").innerHTML = "Возраст должен состоять только из цифр";
        }

        if(result==true) {

            params = "_token=<?php echo csrf_token() ?>&nameAnimal=" + document.Animalform.nameAnimal.value + "&ageAnimal=" + document.Animalform.ageAnimal.value + "&typeAnimal="
                + document.Animalform.typeAnimal.value + "&character=" + document.Animalform.character.value;

            if (document.getElementById('submitButton').value == 'Принять животное') {

                ajaxPost("addanimal", params);
            }
            if (document.getElementById('submitButton').value == 'Пристроить животное') {
                ajaxPost("delanimal", params);
            }
        }

        return false;
    }
    function getAnimalInCell(id){
        $.ajax({
            type: 'POST',
            url: 'animalincell',
            data:{'id':id, '_token':'{{ csrf_token()}}'},
            success: function (data) {
               // console.log(data);
                var i=0;
                 animals='<table align="center" border=0 cellspacing="0"><tr><td colspan=5 align="center">Все жители клетки'+data.idCell+'</td></tr>' +
                     '<tr><td width=20></td><td></td><td width=40 align="center">Имя</td><td width=10 align="center">Возраст (месяцев)</td><td width=40 align="center">Характер</td></tr>';

                for(idAnimals in data.animalInCellArray){
                    i++;
                    if(i%2 == 0) bgcolor='#999999'; else bgcolor='#ffffff';
                    if(data.animalInCellArray[idAnimals].characterAnimal=='evil') character='злой'; else character='добрый';
                    if(data.animalInCellArray[idAnimals].typeAnimal=='dog') typeAnimal='собака'; else typeAnimal='кот';
                    animals = animals + '<tr bgcolor="'+bgcolor+'"><td align="center"> '+i+'</td><td align="center">'+typeAnimal+'</td><td align="center"> '+data.animalInCellArray[idAnimals].name+'</td><td align="center">'+data.animalInCellArray[idAnimals].age+'</td><td align="center">'+character+'</td></tr>';
                }
                animals=animals+'</table>';
                document.getElementById('animalsInCellContent').innerHTML=animals;
                showModal("animalInCell", "formModal", "overlayDiv", "closed");
            },
            error: function (data) {

                errorJson(data);
            }
        });

    }
    function renderCellState(data){
        htmltext="<table><tr><td>Тип клетки</td><td>Вместимость</td><td>Стоимость</td><td>Жителей</td></tr>";
      // alert(data['0']['cost']);
        for(cells in data){
            if(data[cells].typeAnimal == 'cat') typeAnimal='Кошачья';
            if(data[cells].typeAnimal == 'dog') typeAnimal='Собачья';
            if(data[cells].typeCell == '10') typeCell='Групповая 10';
            if(data[cells].typeCell == '1') typeCell='Одиночка';

            htmltext=htmltext+'<tr><td>'+typeAnimal+'</td><td>'+typeCell+'</td><td>'+data[cells].cost+'</td><td onclick="getAnimalInCell(\''+ data[cells].id+'\')">'+data[cells].stata+'</td></tr>';
        }
        htmltext=htmltext+'</table>';
        document.getElementById('stateCellDiv').innerHTML=htmltext;
    }
    function renderTransaction (data){
        htmltext="<table><tr><td>Транзакция</td><td>Стоимость</td></tr>";
        for(transaction in data){
            if(data[transaction].type == 0)
            htmltext=htmltext+'<tr><td>'+data[transaction].what+'</td><td>'+data[transaction].how+'</td></tr>';
        }
        htmltext=htmltext+'</table>';
        document.getElementById('transactionDiv').innerHTML=htmltext;
    }
    function stateButton (data){
        //alert(data[0].moneyWait);
        if(data.moneyFromKazn[0].moneyWait >0){
            //alert(data[0].moneyWait);
            var btnMoney = document.querySelector("#buttonMoney");
            document.getElementById('buttonMoney').style.display = 'block';
            document.getElementById('buttonMoney').value="получить из казны: "+data.moneyFromKazn[0].moneyWait;
            params="_token={{ csrf_token()}}";
            buttonMoney.addEventListener("click", function () { ajaxPost('givemoney',params)},false)


        } else if(data.moneyFromKazn[0].moneyWait == 0){document.getElementById('buttonMoney').style.display = 'none';}
    }
    function renderBalance(data){
       // console.log(data);
        balanceDigit=data.moneyFromKazn[0].money+data.allMoney[0].money;
        balanceStr='Баланс: '+balanceDigit;
        //console.log(balance);
        document.getElementById('balance').innerHTML=balanceStr;
    }
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function reciveJson(data) {
        //alert(data);
       // console.log(data);
        if(data.state=='addAnimal' || data.state=='delAnimal'){
          showModal("formAnimal","formModal", "overlayDiv", "closed");
          renderCellState(data.cellStataArray);
          renderTransaction(data.transactionArray);
          stateButton(data.balance);
          renderBalance(data.balance);

        }
        if(data.state=='givemoney' ){
            renderBalance(data.balance);
            stateButton(data.balance);

        }
        if(data.state=='init' ){
            renderCellState(data.cellStataArray);
            renderTransaction(data.transactionArray);
            stateButton(data.waitMonneyArray);
            renderBalance(data.waitMonneyArray);
        }
        if(data.state =='delanimal'){
            if(data.error!=''){

                document.getElementById("stateModal").innerHTML = "Такого животного не найдено";
                document.getElementById("stateModal").style.display='block';
                setTimeout(function() { document.getElementById("stateModal").style.display='none'; }, 2000);
            }else if(data.error==''){
                renderCellState(data.cellStataArray);
                renderTransaction(data.transactionArray);
                stateButton(data.waitMonneyArray);
                renderBalance(data.waitMonneyArray);
                showModal("formAnimal","formModal", "overlayDiv", "closed");
                console.log(data);
            }

        }


    }
    function errorJson(data) {
        console.log(data);
        //alert(data);
        if (data.status == "422") {
            if(data.responseJSON.errors.nameAnimal != "")

                document.getElementById("nameError").innerHTML = "Кличка должна быть уникальной";

            //console.log(data.responseJSON.errors.nameAnimal);
        }

    }
    function ajaxPost(url, params) {

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





        /*var f = callback || function(data){};
        alert('Готовсь к Ajax');
//работаем с Ajax
        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(request.readyState==4){
                if (request.status==200){
                    //alert(1);
                    //console.log=request.responseText;
                    callback(request.responseText);
                }callback(request.status)
            }
        }
        request.open('POST', url);
        request.setRequestHeader('Content-Type','aplication/x-www-form-urlencoded');
        request.send(params);

        showModal("formAnimal","overlayDiv","closed");
*/



    //AnimalForm.addEventListener ("submit",validateForm,false);



</script>
</body>
</html>
