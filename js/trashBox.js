    function trashBoxSearch(keyword){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById('applicationsList').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open('GET', 'trashBoxSearch.php?keyword='+keyword, true);
        xmlhttp.send();
    }

    var allLeaves = new Array();

    function readyRestoreApplication(leaveDetailId, checked){
        if(checked==true){
            allLeaves.push(leaveDetailId);
        }else{
            for (var i = allLeaves.length - 1; i >= 0; i--) {
                if (allLeaves[i]==leaveDetailId) {
                    allLeaves[i] = "";
                    break;
                };
            };
        };
    }

    function restoreApplications(){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                alert(xmlhttp.responseText);
            }
        }
        xmlhttp.open('GET', 'restoreApplication.php?allLeaves='+JSON.stringify(allLeaves)+'&allLeavesCount='+allLeaves.length, true);
        xmlhttp.send();              
    }