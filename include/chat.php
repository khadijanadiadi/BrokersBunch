<html>
<head>
<title> </title>
<script src="../assets/js/chat.js"></script>
<link href="../assets/css/chat.css" rel="stylesheet">

</head>

<body>


 <button class="open-button" onclick="openForm()"><img  class="icon" src="../msg.png" height="55 " width="55" align="middle" /></button>

<div class="chat-popup  stylefont" id="myForm" >
  <form action="/action_page.php" class="form-container">
    <label for="msg"> <font color="white"><b>Send a Message</b></font></label>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>


</body>
</html>