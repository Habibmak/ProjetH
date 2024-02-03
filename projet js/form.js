formulaire=()=>
{
    var data=readData()
    insert(data)
}
function readData()
{
    var FormData={};
    FormData["name"]=document.getElementById('name').value;
    FormData["emp"]=document.getElementById('emp').value;
    FormData["salary"]=document.getElementById('salary').value;
    FormData["city"]=document.getElementById('city').value;
    return FormData;
}
var empMat=()=>{return Math.round(Math.random()*1000)}

insert=(data)=>
{
    var table=document.getElementById('employe').getElementsByTagName('tbody')[0];
    var newRow=table.insertRow(table.length);
    cell1=newRow.insertCell(0);
    cell1.innerHTML=data.name;
    cell2=newRow.insertCell(1);
    cell2.innerHTML=empMat();
    cell3=newRow.insertCell(2);
    cell3.innerHTML=data.salary;
    cell4=newRow.insertCell(3);
    cell4.innerHTML=data.city;
    cell6=newRow.insertCell(5);
    cell6.innerHTML='<button onclick="modifier(this)" class="envoie btn btn-warning">modifier</button><button onclick="supprimer(this)" class="envoie btn btn-danger">supprimer</button>'
   
}