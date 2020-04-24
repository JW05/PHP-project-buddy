document.querySelector("#btnAddUser").addEventListener("click",function(){
console.log("test");
    
    //coment text
    let emailId=this.dataset.emailId;
    let email = document.querySelector("#email").Value;
    
    console.log(emailId);
    console.log(email);
    
    
    
    //post naar database (AJAX)
    let formData = new FormData();
    
    
    formData.append('email', email);
    formData.append('emailId', emailId);
    
    fetch("ajax/saveUser.php", {
      method: 'POST',
      body: formData
    })
        .then((response) => response.json())
        .then((result) => {
            let newUser = document.createElement('p');
            newComment.innerHtml = result.body;
            document.querySelector(".emailAlert").appendChild(newUser);
    
            console.log('Success:', result);
    })
        .catch((error) => {
            console.error('Error:', error);
    });
    
    
        
    });