btnSendRequests = document.querySelectorAll(".sendRequest");

btnSendRequests.forEach(btnSendRequest => {
  btnSendRequest.addEventListener("click", (e)=>{
    e.preventDefault();
    //receiverId
    let buddyId = e.target.dataset.buddyid;

    //send to database
    let formData = new FormData();
    formData.append('buddyId', buddyId);

    fetch('ajax/saveBuddy.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      if(result.status === "success"){
        if(result.message === "requestSend"){ 
          btnSendRequest.classList.add("btn-danger");
          btnSendRequest.classList.remove("btn-primary");
          btnSendRequest.innerHTML = "Cancel request";
        }else{
          btnSendRequest.classList.add("btn-primary");
          btnSendRequest.classList.remove("btn-danger");
          btnSendRequest.innerHTML = "Send request";
        }
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });

  });
});