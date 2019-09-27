// Quand l'user scroll une page le style de la navbar s'adapte
window.onscroll = function() {scrollFunction()};

function scrollFunction() {

  if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
    document.getElementById("navbar").style.height = "60px";
    document.getElementById("navbar").style.borderBottom = "none";

    document.getElementById("navlogo").style.height = "60px";
    document.getElementById("navlogo").style.width = "60px";
    document.getElementById("navlogo").style.border = "none";

    for (let i = 0; i < document.getElementsByClassName("nav-btn").length; i++) {
        document.getElementsByClassName("nav-btn")[i].style.marginTop = "1rem";
    }

  } else {
    document.getElementById("navlogo").style.height = "100px";
    document.getElementById("navlogo").style.width = "100px";
    document.getElementById("navlogo").style.border = "5px solid #c6c6c6";
    document.getElementById("navbar").style.backgroundColor = "#650696";
    document.getElementById("navbar").style.height = "90px";
    document.getElementById("navbar").style.borderBottom = "6px solid #c6c6c6";

    for (let i = 0; i < document.getElementsByClassName("original-btn").length; i++) {
        document.getElementsByClassName("original-btn")[i].style.marginTop = "3rem";
     }
  }
}


//Anime l'icone du menu burger
let forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(let c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(let e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};

let hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
  forEach(hamburgers, function(hamburger) {
    hamburger.addEventListener("click", function() {
      this.classList.toggle("is-active");
    }, false);
  });
}


//Pour le formulaire d'event, affiche les infos/input suplémentaires si leurs checkbox sont check
function checkShow() {
  if(document.getElementById("mandatory_fees")) {
    if (document.getElementById("mandatory_fees").checked) {
      document.getElementById("maxFees").style.display = "flex";
    } else {
      document.getElementById("maxFees").style.display = "none";
    }
  }

  if(document.getElementById("private")) {
    if (document.getElementById("private").checked) {
      document.getElementById("private-info").style.display = "block";
    } else {
      document.getElementById("private-info").style.display = "none";
    }
  }

  if(document.getElementById("mandatory_needs")) {
    if (document.getElementById("mandatory_needs").checked) {
      document.getElementById("needs-group").style.display = "block";
    } else {
      document.getElementById("needs-group").style.display = "none";
    }
  }
}

//Ajoute une ligne pour la liste des besoins
function addElement()
{
  d = document.getElementById("need-block"); 
  d_prime = d.cloneNode(true);
  document.getElementById("needs-group").appendChild(d_prime);
}


checkShow();
