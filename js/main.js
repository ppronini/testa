window.addEventListener('DOMContentLoaded', function() {

    setTimeout(function () {
        let hideall=document.querySelectorAll(".alert");
        for (let i = 0; i < hideall.length; i++) {
            hideall[i].classList.add("hidden");
        }
    },4000);

    let linksall=document.querySelectorAll(".addnewobjecta");
    let linksalldel=document.querySelectorAll(".deleteobject");
    let linksalledit=document.querySelectorAll(".editobject");
    let linksallshowuser=document.querySelectorAll(".showdescruser");
    let linksshowmore=document.querySelectorAll(".showmore");

    for (let i = 0; i < linksall.length; i++) {
        linksall[i].addEventListener('click', addNewObj, false);
    }

    for (let i = 0; i < linksalldel.length; i++) {
        linksalldel[i].addEventListener('click', deleteObj, false);
    }

    for (let i = 0; i < linksalledit.length; i++) {
        linksalledit[i].addEventListener('click', editObj, false);
    }

    for (let i = 0; i < linksallshowuser.length; i++) {
        linksallshowuser[i].addEventListener('click', showDescr, false);
    }

    for (let i = 0; i < linksshowmore.length; i++) {
        linksshowmore[i].addEventListener('click', showNextLevel, false);
    }

    function addNewObj(){
        let attrLevel = this.getAttribute("data-level");
        let attrParent = this.getAttribute("data-code");
        let objLevel=document.getElementById("objLevel");
        let objParent=document.getElementById("objParent");

        objLevel.value=attrLevel;
        objParent.value=attrParent;

        let modalShow = new bootstrap.Modal(document.getElementById('modalobject'));

        modalShow.show();

    }

    function deleteObj(){
        let objName=this.getAttribute("data-objname");
        let delObjCode=this.getAttribute("data-code");
        if(confirm(`Уверены что хотите удалить объект ${objName} с кодом: ${delObjCode}?`)){

            let http = new XMLHttpRequest();
            let url = '/app/script.php';
            let params = `deletemecode=${delObjCode}`;
            http.open('POST', url, true);

            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() {
                if(http.readyState === 4 && http.status === 200) {
                    let response=http.responseText;
                    if(response.trim()==="delok") {
                        alert("Успешно удалили");
                        location.reload();
                    }
                    else{
                        alert("Ошибка удаления"+response);
                        return false;
                    }
                }
            }
            http.send(params);


        } else{
            return false;
        }

    }

    function editObj(){
        let attrCode = this.getAttribute("data-code");
        let currentName=document.getElementById(`idname${attrCode}`);
        let currentDescr=document.getElementById(`iddescr${attrCode}`);
        let objNameEdit=document.getElementById("objNameEdit");
        let objDescrEdit=document.getElementById("objDescrEdit");
        let objCode=document.getElementById("objCodeEditMe");
        let header=document.getElementById("editmeobject");

        objNameEdit.value=currentName.textContent;
        objDescrEdit.value=currentDescr.textContent;
        header.textContent=": "+attrCode;
        objCode.value=attrCode;

        let modalShow = new bootstrap.Modal(document.getElementById('modaleditobject'));
        modalShow.show();

    }

    function showDescr(){
        let attrCode = this.getAttribute("data-code");

        let http = new XMLHttpRequest();
        let url = '/app/script.php';
        let params = `showmedescrobject=${attrCode}`;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState === 4 && http.status === 200) {
                let response=http.responseText;
                if(response.trim()==="cantshow") {
                    alert("Ошибка");
                    return false;
                }

                else{
                    let tarea=document.getElementById('showDescrFromObj');
                    tarea.textContent=response;
                    return false;
                }
            }
        }
        http.send(params);

    }


    function showNextLevel(){

        let showDiv=this.getAttribute("data-code");

        console.clear();
        console.log(showDiv);

        let mylink=this;
        let children=document.querySelectorAll(`.${showDiv}`);
        children.forEach(function (e) {

        e.classList.remove("hidden");



        })

    }

});