/**
 * declaration des variables 
 */
let  delete_candidature = document.getElementById('candidat');
let  valider_candidature = document.getElementById('valider_candidature');

/**Fin url */
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
//je cree une fonction qui suprime les informatio dans 
//la base de donnees avec ajax 
function deleteAjax(idelement  , attribut , url ){
  fetch( url ,  {
    method: "DELETE"
  }).then(res=> console.log("okkk"));
}




//supression information baccalaureat 
function appelAjax_1(){
const delete_bac = document.getElementById("baccalaureat");
const  id = delete_bac.getAttribute("data-id");
    fetch(`/information/bac/delete/${id}` , {
      method: "DELETE"
    }).then(res=> console.log("okkk"));
}

/**
 * les founction de supression 
 */
function delete_baccalaureat(){
swal({
    title: "Supression baccalaureat",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletebac)=>{
    if(deletebac){
      appelAjax_1();
      setTimeout(window.location.reload(),10);
     swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}

function delete_responsable(){
let   responsable = document.getElementById("responsable");
let   attr_responsable = responsable.getAttribute("data-id");
let url_responsable = `/responsable/delete/${attr_responsable}`; 


  swal({
    title: "Supression Responsable",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletebac)=>{
    if(deletebac){
      deleteAjax(responsable , attr_responsable , url_responsable  )
      setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}

function delete_experience(){
  
  let   experience = document.getElementById("experience");
  let   attr_experience = experience.getAttribute("data-id");
  let   url_experience = `/experience/delete/${attr_experience}`;
  swal({
    title: "Supression Experience",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletebac)=>{
    if(deletebac){
     //ici j'appelle la fonction de supression 
     deleteAjax(experience , attr_experience , url_experience)
     setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}

function delete_bourse(){
  const  bourse = document.getElementById("bourse");
  const   attr_bourse = bourse.getAttribute("data-id");
  let url_bourse = `/bourse/delete/${attr_bourse}`;
  swal({
    title: "Supression bourse",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletebac)=>{
    if(deletebac){
     //ici j'appelle la fonction de supression 
     deleteAjax(bourse , attr_bourse , url_bourse)
     setTimeout(window.location.reload(),10);
    // setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}

function delete_diplomes(){
  const diplome = document.getElementById("diplome");
  const attr_diplome = diplome.getAttribute("data-id");
  let url_diplome = `/diplome/delete/${attr_diplome}`;
  swal({
    title: "Supression diplome ",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletediplome)=>{
    if(deletediplome){
     //ici j'appelle la fonction de supression 
     deleteAjax(diplome , attr_diplome , url_diplome)
     setTimeout(window.location.reload(),5);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })

}

function delete_cursus_interne(){
  const cursus_interne = document.getElementById("cursus_interne");
  const attr_interne = cursus_interne.getAttribute("data-id");
  let url_interne = `/parcours/universitaire/delete/${attr_interne}`;
  swal({
    title: "Supression cursus ",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletediplome)=>{
    if(deletediplome){
     //ici j'appelle la fonction de supression 
     deleteAjax(cursus_interne , attr_interne , url_interne)
     setTimeout(window.location.reload(),5);
    // setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}

function delete_flux_entrant(){
  const flux_entrant = document.getElementById("flux_entrant");
  const attr_flux_entrant = flux_entrant.getAttribute("data-id");
  let url_flux_entrant  = `/flux/delete/${attr_flux_entrant}`;
  swal({
    title: "Supression flux entrant ",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletediplome)=>{
    if(deletediplome){
     //ici j'appelle la fonction de supression 
     deleteAjax(flux_entrant , attr_flux_entrant , url_flux_entrant)
     setTimeout(window.location.reload(),5);

    // setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })

}

function delete_flux_sortant(){
  const flux_sortant  = document.getElementById("flux_sortant");
  const attr_sortant  = flux_sortant.getAttribute("data-id");
  let url_flux_sortant = `/flux/sortant/delete/${attr_sortant}`;
  swal({
    title: "Supression flux sortant ",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deletediplome)=>{
    if(deletediplome){
      console.log(deletediplome);
     //ici j'appelle la fonction de supression 
     deleteAjax(flux_sortant , attr_sortant , url_flux_sortant)
     setTimeout(window.location.reload(),5);
    // setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}

function delete_user(){
  const users  = document.getElementById("id_user");
  const attr_user  = users.getAttribute("data-id");
  
   let url_users = `/admin/delete/${attr_user}`;
   console.log(url_users)
  swal({
    title: "Supression users ",
    text: "etes vous sure de suprimer ces informations ? ",
    icon: "success",
    buttons: true,
    dangerMode: true,
  }).then((deleteuser)=>{
    if(deleteuser){
      console.log(deleteuser);
     //ici j'appelle la fonction de supression 
     deleteAjax(users  , attr_user , url_users )
     setTimeout(window.location.reload(),5);
    // setTimeout(window.location.reload(),10);
      swal("suprimé!", "les informations sont bien suprimés.", "success");
    }else{
      swal("Annulé", "les informations ne sont pas suprimées  :)", "error");

    }
  })
}





/** Validation de la candidature   */

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
      window.location.reload();
      swal("Votre dossier est bien valider avec success ", {
        icon: "success",
      });
    } else {
      swal("validation dossier est annulé !");
    }
  });
}  



//decision administrative 
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



  

