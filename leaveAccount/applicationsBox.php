<?php
    include 'head.php';
?>
<body>

        <link rel="stylesheet" href="../css/layouts/marketing.css">
        <link rel="stylesheet" href="../css/layouts/side-menu.css">

<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed" style="background:#111;">
        <a class="pure-menu-heading" href="">Online Administration Portal</a>

        <ul style="width:60%;">
            <li style="width:60%;">
                <form class="pure-form pure-form-stacked" id="search_form">
                    <fieldset>
                        <input type="text" class="pure-form input-rounded" placeholder="Search..." style="width:100%;margin:0;" onkeyUp="search(this.value, 'inbox');">
                    </fieldset>
                </form>
            </li>
            <li class="pure-menu-selected"><a href="#">Home</a></li>
            <li><a href="mail.google.com">GoogleMail</a></li>
            <li><a href="webmail.iiti.ac.in">Webmail</a></li>
        </ul>
    </div>
</div>

<div class="content-wrapper">

    <div class="ribbon l-box-lrg pure-g" style="height:10%;">
        
    </div>

    <div class="content" style="background:#2d3e50;margin-left:0;padding:0;height:100%;">

        <div id="navigation" style="position:fixed;width:10%;float:left;height:100%;">
            <div class="pure-menu pure-menu-open" style="height:100%;background:#2d3e50;border:none;">

                <style type="text/css">
                    .ul-nav{
                        font-size:90%;
                        background:#2d3e50;
                        font-weight: 600;
                    }
                    .ul-nav li a{
                        color: white;
                         text-shadow: 0.5px 0.5px 0.5px #111; 
                    }
                    .ul-nav li a:hover,
                    .ul-nav li a:focus {
                        background: #111;
                    }

                </style>
                <ul class="ul-nav">
                    <li>
                        <a href="#" class="pure-button pure-button-primary" style="padding:0.5em;margin:10%;font-weight:normal;color:#2d3e50;font-size:80%;" onclick="compose();">COMPOSE</a>
                    </li>
                    <li>
                        <a href="#" onclick="var b=change_search_type('inbox'); navigate('inbox.php'); return b">Inbox</a>
                    </li>
                    <li>
                        <a href="#" onclick="navigate('outbox.php');change_search_type('outbox');">Outbox</a>
                    </li>
                    <li>
                        <a href="#" onclick="var c=change_search_type('trashBox'); navigate('trashBox.php'); return c">Trash Box</a>
                    </li>
                    <li>
                        <a href="#" onclick="navigate('profile.php');">Profile</a>
                    </li>
                    <li>
                        <a href="#" onclick="navigate('serviceBook.php');">Service Book</a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="navigation_content" class="content" style="width:100%;padding:0;margin:0;">

            <?php require 'inbox.php'; ?>

        </div>

    </div>

</div>

<!--div class="footer l-box is-center">
    View the source of this layout to learn more. Made with love by the YUI Team.
</div-->

<script type="text/javascript">

   function navigate(pageName){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById('navigation_content').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open('GET', pageName, true);
        xmlhttp.send();
    }

    function change_search_type(toType){
        if(window.XMLHttpRequest){
            xmlhttp_change_search_type = new XMLHttpRequest();
        }else{
            xmlhttp_change_search_type = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp_change_search_type.onreadystatechange = function(){
            if(xmlhttp_change_search_type.readyState==4 && xmlhttp_change_search_type.status==200){
                document.getElementById('search_form').innerHTML = xmlhttp_change_search_type.responseText;
            }
        }
        xmlhttp_change_search_type.open('GET', 'changeSearchType.php?type='+toType, true);
        xmlhttp_change_search_type.send();
    }

    function compose(){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById('new_application').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open('GET', 'newApplication.php', true);
        xmlhttp.send();
    }

</script>

<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui-min.js"></script>
<script>
YUI().use('node-base', 'node-event-delegate', function (Y) {
    // This just makes sure that the href="#" attached to the <a> elements
    // don't scroll you back up the page.
    Y.one('body').delegate('click', function (e) {
        e.preventDefault();
    }, 'a[href="#"]');
});
</script>
<script src="../js/trashBox.js"></script>
<script src="../js/inbox.js"></script>
<script src="../js/jquery.js"></script>
</body>
