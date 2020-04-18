let messageInput = document.querySelector("#chatMessage");
let btnSend = document.querySelector("#btnSendMessage");

if(messageInput.value.trim() === ""){
  btnSend.classList.add("invisible");
}

messageInput.addEventListener("keyup", (e) => {

  if(messageInput.value.trim() != ""){
    btnSend.classList.remove("invisible");
  }else{
    btnSend.classList.add("invisible");
  }

  if(e.keyCode == 13 && messageInput.value.trim() != ""){
    //receiverId
    let receiverId = btnSend.dataset.receiverid;
    
    //message
    let message = messageInput.value.trim();

    //send to database
    let formData = new FormData();
    formData.append('message', message);
    formData.append('receiverId', receiverId);

    fetch('ajax/saveMessage.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      if(result.status === "success"){
        let newMessage = document.createElement('div');
        newMessage.setAttribute("class","media mb-2 float-right");

        newMessage.innerHTML = `<div class="media-body">
        <h5 class="mt-0">Me</h5>
        ${result.body.message}
        <small class="float-right">${result.body.timestamp}</small>
        </div>`;

        document.querySelector(".chatMessages").appendChild(newMessage);
      }
      
      messageInput.value = "";
      messageInput.focus();
      btnSend.classList.add("invisible");
    })
    .catch(error => {
      console.error('Error:', error);
    });

    
  }
});

btnSend.addEventListener("click", () => {
  //receiverId
  let receiverId = btnSend.dataset.receiverid;
  
  //message
  let message = document.querySelector("#chatMessage").value;

  //send to database
  let formData = new FormData();
  formData.append('message', message);
  formData.append('receiverId', receiverId);

  fetch('ajax/saveMessage.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    if(result.status === "success"){
      let newMessage = document.createElement('div');
      newMessage.setAttribute("class","media mb-2 float-right");

      newMessage.innerHTML = `<div class="media-body">
      <h5 class="mt-0">Me</h5>
      ${result.body.message}
      <small class="float-right">${result.body.timestamp}</small>
      </div>`;

      document.querySelector(".chatMessages").appendChild(newMessage);
    }
    messageInput.value = "";
    messageInput.focus();
    btnSend.classList.add("invisible");
  })
  .catch(error => {
    console.error('Error:', error);
  });
});