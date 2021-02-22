document.querySelector("#btn").addEventListener("click",HandleConfirm);
window.onload= function(){  
    var c = document.getElementById("customCheck1");
    c.onclick = function(){
        var b = document.getElementById("btn");
       if (c.checked == true)
        {
          b.disabled = false;
        }
      else
        {
          b.disabled = true;
        }			 
    }
  }

function HandleConfirm(event)
{
    const urlSearch = new URLSearchParams(location.search);
    const date = urlSearch.get("date");
    const time = urlSearch.get("time");
    window.location.href=`successful.php?date=${date}&time=${time}`;
}