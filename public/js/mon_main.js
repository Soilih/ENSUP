$(document).ready(function() {
      $('#data').DataTable({
        
        info:     false ,
        lengthMenu: [
            [5, 20, 30, 40 , 50],
            [ 5 ,20 ,30 , 50, 'All'],
        ], 
        "lengthChange": true , 
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
          }] , 
          "language": {
            "searchPlaceholder": "nom , prenom , nin , identifiant ....",
            "sSearch": "Rechercher" , 
            "sLengthMenu": "Afficher _MENU_",
            "sZeroRecords": "Cet etudiant n'est pas inscrit ",
            "sProcessing": "Chargement...",
            "oPaginate": {
                sNext: '<span class="pagination-default">&#x276f;</span>',
                sPrevious: '<span class="pagination-default">&#x276e;</span>'
            }
        } , 

        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Imprimer',
                exportOptions: {
                    columns: ':visible' , 
                   
                }
            },
            {  extend : 'colvis' ,
               text : "colonne visible"
        
          } ,
          {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible' // Column index which needs to export
                }
             },
             {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible' // Column index which needs to export
                }
             },
             {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible' // Column index which needs to export
                }
             } 
        ],
        columnDefs: [ {
            targets: -1,
            visible: false
        } ]
       
      });
  } );

