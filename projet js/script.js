
var selectrow=null



envoyer=()=>
{ 
   if (valider())
   {
    var formData=readData();
    if (selectrow==null)
    insert(formData);
    else
    update(formData);
    }   
    reset();
}
var val=true//
valider=()=>
{
    if (document.getElementById("nh").value==""){
document.getElementById("nh").style.backgroundColor="red";
val=false
}
if (document.getElementById("ph").value==""){
    document.getElementById("message").innerHTML="champ obligatoire";
    document.getElementById("message").style.color="red"
    val=false}
    if (document.getElementById("nom").value==""){
        document.getElementById("ms").innerHTML="champ obligatoire";
        document.getElementById("ms").style.color="red"
        val=false}
return val
}
function readData()
{
    var formData={};
formData["nom"]=document.getElementById("nom").value;
formData["matricule"]=document.getElementById("matricule").value;
formData["nombreheure"]=document.getElementById("nh").value;

formData["prixheure"]=document.getElementById("ph").value;
return formData;
}
var generateMat=()=>{return Math.round(Math.random()*1000000000)}
insert=(data)=>
{
    var table=document.getElementById('listemploye').getElementsByTagName('tbody')[0];
    var newRow=table.insertRow(table.length);
    cell1=newRow.insertCell(0);
    cell1.innerHTML=generateMat();
    cell2=newRow.insertCell(1);
    cell2.innerHTML=data.nom;
    cell3=newRow.insertCell(2);
    cell3.innerHTML=data.prixheure;
    cell4=newRow.insertCell(3);
    cell4.innerHTML=parseFloat(data.nombreheure)*parseFloat(data.prixheure)
    cell5=newRow.insertCell(4);
    cell5.innerHTML=parseFloat(data.nombreheure)*parseFloat(data.prixheure)
    cell6=newRow.insertCell(5);
    cell6.innerHTML='<button onclick="modifier(this)" class="envoie btn btn-warning">modifier</button><button onclick="supprimer(this)" class="envoie btn btn-danger">supprimer</button>'

}
reset=()=>
{
    document.getElementById("nom").value="";
    document.getElementById("matricule").value="";
    document.getElementById("nh").value="";
    document.getElementById("ph").value="";
}
supprimer=(td)=>
{
    if(confirm("voulez vous vraiment supprimer?"))
    {
        row=td.parentElement.parentElement;
        document.getElementById('listemploye').deleteRow(row.rowindex);
    }
}
modifier=(td)=>
{   
    selectrow=td.parentElement.parentElement;
    document.getElementById("matricule").value=selectrow.cells[0].innerHTML;
    document.getElementById("nom").value=selectrow.cells[1].innerHTML;
    document.getElementById("nh").value=selectrow.cells[2].innerHTML;
    document.getElementById("ph").value=selectrow.cells[3].innerHTML;
}
update=(formData)=>
{
    selectrow.cells[0].innerHTML=formData.matricule;
    selectrow.cells[1].innerHTML=formData.nom;
    selectrow.cells[2].innerHTML=formData.nombreheure;
    selectrow.cells[3].innerHTML=formData.prixheure;
}