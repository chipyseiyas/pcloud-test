var job;

window.addEventListener("DOMContentLoaded", function(event) {
    let options = {};       
    options.method = 'get';            
    options.headers = {'Content-Type': 'application/json'};                       
    fetch('index.php?c=Default&a=getResult', options).then(r => r.json()).then(data => {
        if(data.success)
        {
            document.getElementById("response-container").innerHTML = createTable(data.data.job); 
        }    
    });
});

function detail(index)
{
    var html = '';            
    html += '<div class="container project-info-box mt-0">'; 
    html += '<h4 class="text-center"> Detalle de vacante </h4>';
    html += '<div class="text-right date">'+ job[index].date + '</div>';          
    html += '<h5>Descripción:</h5>';  
    html += '<h6>'+job[index].description+'</h6>';             
    html += '</div>'                
    document.getElementById("detail").innerHTML  = html;
}

function createTable(json)
{
    job = json;
    var html = '';
    json.forEach((obj,index) => {
        html += '<div class="project-info-box mt-0" id="'+obj.referencenumber+'">';                
        html += '<h6> Empresa: '+obj.company+'</h6>'; 
        html += '<h6> Titulo: '+obj.title+'</h6>'; 
        html += '<h6> Fecha de publicación: '+obj.date+'</h6>'; 
        html += '<h6> Lugar: '+obj.city+' '+obj.state+' '+obj.country+'</h6>'; 
        html += '<h6> Titulo: '+obj.title+'</h6>';                     
        html += "Acciones: <a href='#' onclick='detail("+index+")'>";
        html += "Ver Detalle</a></div>";
    });
    
    return html;
}