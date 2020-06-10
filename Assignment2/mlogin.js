

        //javascirpt for manager page created by Rahul
        
        var xhr = false;
        if (window.XMLHttpRequest) {
        	xhr = new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
        	xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }


				function managerLogin(){
					// Store

					var uname= document.getElementById("uname").value;
          sessionStorage.setItem("managerid", uname);


var password = document.getElementById('password').value;

xhr.open("GET", "mlogin.php?uname=" + uname +  "&password=" +password, true);

xhr.onreadystatechange = testTheInput;
xhr.send(null);

				}


        function testTheInput() {

        	if ((xhr.readyState == 4) && (xhr.status == 200)) {
        		document.getElementById('msg').innerHTML = xhr.responseText;
            
        	}

}
