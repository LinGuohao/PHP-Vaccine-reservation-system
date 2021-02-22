var month = parseInt(document.querySelector("#sessionMonth").innerHTML);
document.querySelector("#Pervious").addEventListener("click",HandlePrevious);
document.querySelector("#Next").addEventListener("click",HandleNext);

if(month == 1)
{
    document.querySelector("#Pervious").disabled = true;   
}else
{
    document.querySelector("#Pervious").disabled = false;   
}
if(month ==3)
{
    //console.log("1");
    document.querySelector("#Next").disabled = true;
}else
{
    document.querySelector("#Next").disabled = false;
}
function HandlePrevious(event)
{
    if(month >1)
    {
        month = month - 1;
        window.location.href=`index.php?month=${month}`;
    }
}

function HandleNext(event)
{
    if(month <3)
    {
        month = month + 1;
        window.location.href=`index.php?month=${month}`;
    }
}

function HandleLogin(event)
{
    window.location.href="Login.php";
}