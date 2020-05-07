let messageInput = document.querySelector("#chatMessage");
let btnSend = document.querySelector("#btnSendMessage");
let btnReacts = document.querySelectorAll(".btnReact");
let reactionModal = document.querySelector("#reactions");

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
        <div class="float-right">
        <small>${result.body.timestamp}</small>
        <button type="button" class="btn btn-primary btnReact" data-toggle="modal" data-target="#reactions" data-messageid="${result.body.id}">
          Reaction
        </button>
      </div></div>`;

        document.querySelector(".chatMessages").appendChild(newMessage);
      }
      
      messageInput.value = "";
      messageInput.focus();
      btnSend.classList.add("invisible");
      btnReacts = document.querySelectorAll(".btnReact");
      btnReacts.forEach(btnReact => {
        btnReact.addEventListener("click", (e)=>{
          reactionModal.setAttribute("data-messageid", e.target.dataset.messageid);
        });
      });
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
      <div class="float-right">
        <small>${result.body.timestamp}</small>
        <button type="button" class="btn btn-primary btnReact" data-toggle="modal" data-target="#reactions" data-messageid="${result.body.id}">
          Reaction
        </button>
      </div>
      </div>`;

      document.querySelector(".chatMessages").appendChild(newMessage);
    }
    messageInput.value = "";
    messageInput.focus();
    btnSend.classList.add("invisible");
    btnReacts = document.querySelectorAll(".btnReact");
    btnReacts.forEach(btnReact => {
      btnReact.addEventListener("click", (e)=>{
        reactionModal.setAttribute("data-messageid", e.target.dataset.messageid);
      });
    });
  })
  .catch(error => {
    console.error('Error:', error);
  });
});

btnReacts.forEach(btnReact => {
  btnReact.addEventListener("click", (e)=>{
    reactionModal.setAttribute("data-messageid", e.target.dataset.messageid);
  });
});

reactionModal.addEventListener("click", (e)=>{
  if(e.target.classList.contains("reaction")){
    let reaction = e.target.innerHTML;
    let messageId = reactionModal.dataset.messageid;

    //send to database
    let formData = new FormData();
    formData.append('reaction', reaction);
    formData.append('messageId', messageId);

    fetch('ajax/addReaction.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      if(result.status === "success"){
        document.querySelector(`.btnReact[data-messageid="${messageId}"]`).innerHTML = result.body;
      }

      reactionModal.removeAttribute("data-messageid");
      $('#reactions').modal('hide');
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

});