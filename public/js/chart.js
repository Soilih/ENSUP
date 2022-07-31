
/**Rapport*/
"use strict"

    let categories = document.querySelector("#flux")

    let bourse = document.querySelector("#bourse")
    let niveau = document.querySelector("#niveau")
    let statut  = document.querySelector("#status")
    let cursus = document.querySelector("#cursus")
   

    
    
 
    let categGraph2 = new Chart(bourse, {
        type: "pie",
        data: {
            labels:  ["Boursier ", "Non boursier"],
            datasets: [{
                data: [65,59],
                label: "Répartition boursier et non boursier",
                    backgroundColor: 
                    [ '#6ab04c',
                    '#eb4d4b'
                    ]
            }]
        }
    })
    
    let categGraph3 = new Chart(niveau, {
        type: "pie",
        data: {
            labels:  ["Bac ", "L1" , "L2" , "L3" , "M1" , "M2" , 'Doctorat' , 'Ingenieur'],
            datasets: [{
                data: [65,59 , 10 , 17 , 12 ,20 , 10 , 23 ],
                label: "Répartition des niveau",
                    backgroundColor: 
                    [ '#f1c40f',
                      '#e74c3c' , 
                      '#2c3e50',
                      '#3498db',
                      '#74b9ff',
                      '#e17055' , 
                      '#badc58' , 
                      '#4834d4' 
    
    
                    ]
            }]
        }
    })
    
    let categGraph4 = new Chart(statut , {
        type: "pie",
        data: {
            labels:  ["etudiant ", "travailleur"],
            datasets: [{
                data: [65 ,59],
                label: "Répartition des catégories",
                    backgroundColor: 
                    [ '#f0932b',
                      '#4834d4' , 
                      
    
    
                    ]
            }]
        }
    })
    
    let categGraph5 = new Chart(cursus , {
        type: "pie",
        data: {
            labels:  ["Interne ", "externe" , "Interne-externe"],
            datasets: [{
                data: [65,59,10],
                label: "Répartition des catégories",
                    backgroundColor: 
                    [ '#F79F1F',
                      '#009432' , 
                      '#ED4C67',
                    ]
            }]
        }
    })
    
    
    
    
    
