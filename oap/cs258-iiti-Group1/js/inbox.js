
    function showApplication(leaveDetailId, location){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById('applicationContent').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open('GET', 'showApplication.php?leaveDetailId='+leaveDetailId+'&location='+location, true);
        xmlhttp.send();
    }

    function approveApplication(leaveDetailId){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById('modal_body').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open('GET', 'approveApplication.php?leaveDetailId='+leaveDetailId, true);
        xmlhttp.send();          
    }

    function recommendApplication(leaveDetailId){
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
        xmlhttp.open('GET', 'recommendApplication.php?leaveDetailId='+leaveDetailId, true);
        xmlhttp.send();              
    }

    function rejectApplication(leaveDetailId){
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
        xmlhttp.open('GET', 'rejectApplication.php?leaveDetailId='+leaveDetailId, true);
        xmlhttp.send();              
    }

    function search(keyword, type){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById(type+'ApplicationsList').innerHTML = xmlhttp.responseText;  
            }
        }
        xmlhttp.open('GET', 'search.php?keyword='+keyword+'&type='+type, true);
        xmlhttp.send();
    }

    var allLeaves = new Array();

    function readyDeleteApplication(leaveDetailId, checked){
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

    function deleteApplications(){
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
        xmlhttp.open('GET', 'deleteApplication.php?allLeaves='+JSON.stringify(allLeaves)+'&allLeavesCount='+allLeaves.length, true);
        xmlhttp.send();              
    }