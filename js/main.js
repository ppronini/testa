window.addEventListener('DOMContentLoaded', function() {

    let linksall=document.querySelectorAll(".addnewobjecta");
    let linksalldel=document.querySelectorAll(".deleteobject");

    for (let i = 0; i < linksall.length; i++) {
        linksall[i].addEventListener('click', addNewObj, false);
    }

    for (let i = 0; i < linksalldel.length; i++) {
        linksalldel[i].addEventListener('click', deleteObj, false);
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
                    if(response.trim()==="delallok"){
                        alert("Успешно удалили вместе с потомками");
                        location.reload();
                    }
                    else{
                        alert("Ошибка удаления"+response);
                        return false;
                    }
                }
            }
            http.send(params);
            console.log("удали меня полностью");

        } else{
            return false;
        }

    }


});