function test(str = 'test') {
    alert('test function works: ' + str);
    console.log("test function works: " + str);
}
// Window load event used just in case window height is dependant upon images
$(document).ready(function () {
  var docHeight = $(window).height();
  var footerHeight = $("#footer").height();
  var footerTop = $("#footer").position().top + footerHeight;
  if (footerTop < docHeight) {
    $("#footer").css("margin-top", 10 + (docHeight - footerTop) + "px");
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
function agegroup(yearOfBirth, grid) {
  var age = new Date().getFullYear() - yearOfBirth;

  if (grid == 10) {
    return Math.floor(age / 10) * 10;
  } else {
    return (Math.floor((age / 10) * 2) / 2) * 10;
  }
}


