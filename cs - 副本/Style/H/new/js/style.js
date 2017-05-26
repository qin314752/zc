/*ÂÖ²¥

var oImg1=document.getElementById("img1");
var ul1=document.getElementById("ul1");
var aLi=ul1.getElementsByTagName("li");
var j=2;
for(var i= 0;i<aLi.length;i++){
    aLi[i].style.backgroundColor="lightgray";
}
aLi[0].style.backgroundColor="blue";

function tu(){
    oImg1.src="img/"+j+".jpg";
    for(var i= 0;i<aLi.length;i++){
        aLi[i].style.backgroundColor="lightgray";
    }
    aLi[j-1].style.backgroundColor="blue";
    j++;
    if(j>5){
        j=1;
    }
}
var time1=setInterval(tu,2000);

function zhi(f){
    clearInterval(time1);
    oImg1.src="img/"+f+".jpg";
    for(var i= 0;i<aLi.length;i++){
        aLi[i].style.backgroundColor="lightgray";
    }
    aLi[f-1].style.backgroundColor="blue";
    j=f+1;
    if(j>5){
        j=1;
    }
}

function dong(){
    time1=setInterval(tu,2000);
}
function zuo(){
    j--;
    if(j==1){
        j = 6;
    }
    if(j==0){
        j = 5;
    }
    img1.src = "img/"+(j-1)+".jpg";
    var liArr = document.getElementsByTagName("li");
    for(var u= 0 ; u< liArr.length ; u++){
        if( j-1 == u+1 ){
            liArr[u].className = "over";
        }else{
            liArr[u].className = "out";
        }
    }
    for(var i= 0;i<aLi.length;i++){
        aLi[i].style.backgroundColor="lightgray";
    }
    aLi[j-2].style.backgroundColor="blue";
}
function you(){
    img1.src = "img/"+(j)+".jpg";
    var liArr = document.getElementsByTagName("li");
    for(var k = 0 ; k < liArr.length ; k++){
        if( j == k+1 ){
            liArr[k].className = "over";
        }else{
            liArr[k].className = "out";
        }
    }
    for(var i= 0;i<aLi.length;i++){
        aLi[i].style.backgroundColor="lightgray";
    }
    aLi[j-1].style.backgroundColor="blue";
    j++;
    if(j==6){
        j = 1;
    }
}
function ting(){
    clearInterval(time1);
}
*/


/*Ñ¡Ïî¿¨*/
function bian(j){
    var divArr = div1.getElementsByTagName("div");
    for(var i = 0;i<divArr.length;i++){
        divArr[i].style.backgroundColor = "white";
        divArr[i].style.color="gray"
    }
    document.getElementById("top"+j).style.backgroundColor = "#006db8";
    document.getElementById("top"+j).style.color = "#fff";


    var divArr = div2.getElementsByClassName("div_bottom");
    for(var i = 0;i<divArr.length;i++){
        divArr[i].style.display = "none";
    }
    var bottom = document.getElementById("bottom"+j).style.display="block";
}