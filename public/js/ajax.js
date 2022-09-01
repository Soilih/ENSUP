const delete_candidature = document.getElementById('candidat');
const valider_candidature = document.getElementById('valider_candidature');
if (delete_candidature) {
  delete_candidature.addEventListener('click', e => {
    if (e.target.className === 'btn btn-danger delete-candidature') {
      if (confirm('Are you sure?')) {
        const id = e.target.getAttribute('data-id');
      
        fetch(`/candidature/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}

if(valider_candidature){
   valider_candidature.addEventListener('click' , e => {
    e.preventDefault();
     validerDossier() ;

}) 
}

function validerDossier() {
  swal({
    title: "Validation dossier ",
    text: "Etes vous sure de valider votre dossier. si oui vous ne pouvez pas modifier ni suprimer vos informations ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      appelAjax();
      swal("Votre dossier est bien valider avec success ", {
        icon: "success",
      });
    } else {
      swal("validation dossier est annulé !");
    }
  });
}    
//decision admiistrative 


function appelAjax(){
  var iddom = document.getElementById("valider_candidature") ;
  var div_btn =  document.getElementById("btn-valider");
  
  const id = iddom.getAttribute('data-id');
  console.log(id)
  var url = `candidature/activer/${id} `  ;
   fetch(`candidature/activer/${id}` , {
    method : 'GET'
   }).then(response=> {
    console.log(response)
      //ici je cache div qui contient l button valider 
      div_btn.style.display ="none";
     
   })
   

}

      

