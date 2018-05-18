var myObj;
function firstcall(str,myObjdata){

myObj = myObjdata;

var id=str;



function find1l1(id){
var fl1="";
var first;
try{
var info=myObj[id];
first=info["1"];
}
catch(err){
first="nil";
}
if(first.length>0){
fl1=first;
}



return fl1;
}

function find2l1(id){
var fl1="";
var first;
try{
var info=myObj[id];
first=info["2"];
}
catch(err){
first="nil";
}
if(first.length>0){
fl1=first;
}
return fl1;
}

function find3l1(id){
var fl1="nil";
var first;
try{
var info=myObj[id];
first=info["3"];
}
catch(err){
first="nil";
}
if(first.length>0){
fl1=first;
}
return fl1;
}

function findname(id){
var name="nil";
try{
var x=myObj[id];
name=x.info[0].applicantName;
}
catch(err){
name="nil";
}
return name;
}

function find2ndlevel(id){
//var name=findname(id);

var firstchild,secondchild,thirdchild;
try{
firstchild=find1l1(id);
}
catch(err){
firstchild="nil";
}
try{
secondchild=find2l1(id);
}
catch(err){
secondchild="nil";
}
try{
thirdchild=find3l1(id);
}
catch(err){
thirdchild="nil";
}
var ret=[firstchild,secondchild,thirdchild];

return ret;

}

document.getElementById("parent").innerHTML = findname(id)+"("+id+")";
document.getElementById("parent").value = id;

var id2=find1l1(id);
var l11child=findname(id2);
document.getElementById("parent2").innerHTML = findname(find1l1(id))+"("+find1l1(id)+")";
document.getElementById("parent2").value = find1l1(id);
document.getElementById("parent3").innerHTML = findname(find2l1(id))+"("+find2l1(id)+")";
document.getElementById("parent3").value = find2l1(id);
document.getElementById("parent4").innerHTML = findname(find3l1(id))+"("+find3l1(id)+")";
document.getElementById("parent4").value = find3l1(id);



var childs1=find2ndlevel(find1l1(id));
var childs2=find2ndlevel(find2l1(id));
var childs3=find2ndlevel(find3l1(id));

if(childs1.length>0){
document.getElementById("child1").innerHTML = findname(childs1[0])+"("+childs1[0]+")";
document.getElementById("child1").value = childs1[0];
if(!(childs1[0]=="nil")){
document.getElementById("achild1").value =childs1[0] ;
}
document.getElementById("child2").innerHTML = findname(childs1[1])+"("+childs1[1]+")";
document.getElementById("child2").value = childs1[1];
if(!(childs1[1]=="nil")){
document.getElementById("achild2").value =childs1[1] ;
}
document.getElementById("child3").innerHTML = findname(childs1[2])+"("+childs1[2]+")";
document.getElementById("child3").value = childs1[2];
if(!(childs1[2]=="nil")){
document.getElementById("achild3").value =childs1[2] ;
}
}
if(childs1.length>0){
document.getElementById("child4").innerHTML = findname(childs2[0])+"("+childs2[0]+")";
document.getElementById("child4").value = childs2[0];
if(!(childs2[0]=="nil")){
document.getElementById("achild4").value =childs2[0] ;
}
document.getElementById("child5").innerHTML = findname(childs2[1])+"("+childs2[1]+")";
document.getElementById("child5").value = childs2[1];
if(!(childs2[1]=="nil")){
document.getElementById("achild5").value =childs2[1] ;
}
document.getElementById("child6").innerHTML = findname(childs2[2])+"("+childs2[2]+")";
document.getElementById("child6").value = childs2[2];
if(!(childs2[2]=="nil")){
document.getElementById("achild6").value =childs2[2] ;
}
}
if(childs1.length>0){
document.getElementById("child7").innerHTML = findname(childs3[0])+"("+childs3[0]+")";
document.getElementById("child7").value = childs3[0];
if(!(childs3[0]=="nil")){
document.getElementById("achild7").value =childs3[0] ;
}
document.getElementById("child8").innerHTML = findname(childs3[1])+"("+childs3[1]+")";
document.getElementById("child8").value = childs3[1];
if(!(childs3[1]=="nil")){
document.getElementById("achild8").value =childs3[1] ;
}
document.getElementById("child9").innerHTML = findname(childs3[2])+"("+childs3[2]+")";
document.getElementById("child9").value = childs3[2];
if(!(childs3[2]=="nil")){
document.getElementById("achild9").value =childs3[2] ;
}
}

}
function secondcall(str){
var key=document.getElementById(str).value;
firstcall(key);
}

function searchcall(){
var key=document.getElementById("search").value;
firstcall(key);
}

function showdetails(key){
var arr;
var myObj = myObj;  
var x=myObj[key];
var y=x.info[0];
//arr=[y["0"],y["1"],y["2"],y["3"],y["4"]];
document.getElementById("uid").innerHTML=y["0"];
document.getElementById("uname").innerHTML=y["1"];
document.getElementById("upackage").innerHTML=y["2"];
document.getElementById("udoj").innerHTML=y["3"];
document.getElementById("udoa").innerHTML=y["4"];
document.getElementById("uinvest").innerHTML="Not there in the JSON provided :P";

}

function details(id){
var key=document.getElementById(id).value;
showdetails(key);
}
