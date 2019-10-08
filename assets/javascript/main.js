$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    if(document.getElementById('content')){ 
        infiniteScroll();
    }
    
    if(document.getElementById("mandatory_fees")) { 
        checkShow();
    }

    if(document.getElementById("form-fees")) {
        newFees();
    }
  });