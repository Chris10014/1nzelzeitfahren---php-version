function test(str = 'test') {
    alert('test function works: ' + str);
    console.log("test function works: " + str);
}
// sticky footer
$(document).ready(function () {
  var viewportHeight = $(window).height();
  var bodyHeight = $("#body").height();;
  var footerHeight = $('#footer').height();

    if (bodyHeight + footerHeight < viewportHeight) {
      $("#footer").addClass("fixed-bottom");
    } else {
      $("#footer").removeClass("fixed-bottom");
    }

});

  $(window).resize(function () {
    var viewportHeight = $(window).height();
    var bodyHeight = $("#body").height();;
    var footerHeight = $('#footer').height();

    if ((bodyHeight + footerHeight) < viewportHeight) {
      $("#footer").addClass("fixed-bottom");
    } else {
      $("#footer").removeClass("fixed-bottom");
    }
  });




/*
Ermittelt die Geschlechterbezeichnung voll ausgeschrieben
@param str var gender Abkürzung des Geschlechts (M, W oder D)
@param int var grid Jahreszuschnitt der Alterklassen. Übernimmt die const AGEGROUPS aus der config.php
@return str Geschlechterbezeichnung voll ausgeschrieben (Männer, Frauen, Diverse)
*/
function fullgender(gender) {
 
  switch (gender) {
    case "M":
      return "Männer";
      break;
    case "W":
      return "Frauen";
      break;
    case "O":
      return "Diverse";
      break;
  }
}

/*
Berechnet die Altersklasse auf Basis des Geburtsjahres
@param int var yearOfBirth Geburtsjahrgang
@param int va grid Jahreszuschnitt der Alterklassen (10er oder 5er Schritte)
@return int Alterklasse 
*/
function agegroup(eventDate, yearOfBirth, grid) {
  
  var age = new Date(eventDate).getFullYear() - yearOfBirth;

  if (age >= 20) {
    if (grid == 10) {
      return Math.floor(age / 10) * 10;
    } else {
      return (Math.floor((age / 10) * 2) / 2) * 10;
    }
  } else {
    return "Jugend";
  }
}


