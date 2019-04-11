function CustomAlert(){
    this.render = function(dialog){
        let winH = window.innerHeight;
        let dialogoverlay = document.getElementById('dialogoverlay');
        let dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";

        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = "Access Denied";
        document.getElementById('dialogboxbody').innerHTML = "Users with \"visitor\" permissions are unable to access this page. Insead, visitors may only process changes to the Major Pages. If you have any questions or concerns as it pertains tot this matter, you are welcome to <a href=\"https://shanewalders.com/contact.php\">contact</a> an administrator directly." ;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">Go Back</button>';
    }
    this.ok = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
    }
}
var Alert = new CustomAlert();
