
    function DisableMenu()
    {
        if(document.getElementById("registeras").value=="Client")
        {
            document.getElementById("certificate").enabled = "false";
            document.getElementById("registration").enabled = "false";
               
        }
        else
        {
            document.getElementById("certificate").enabled = "true";
            document.getElementById("registration").enabled = "true";
            
        }                       
    }                   
