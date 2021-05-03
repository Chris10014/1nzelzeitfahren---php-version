<?php

class Utils
{
    /**
     * Konvertiert ein Datum
     * @param date $date originales Datum
     * @param str $format euDot default, euSlash, intDot, intSlash 
     * @return date Datum in DD.MM.YYY (default) oder gewünschtem Format
     */
    public static function convertDate($date, $format = "euDot")
    {
        //Convert it into a timestamp.
        $timestamp = strtotime($date);

        switch ($format) {
            case "euDot":
                //Convert it to DD.MM.YYYY
                return date("d.m.Y", $timestamp);
                break;
            case "euDash":
                //Convert it to DD.MM.YYYY
                return date("d-m-Y", $timestamp);
                break;
            case "euSlash":
                //Convert it to DD.MM.YYYY
                return date("d/m/Y", $timestamp);
                break;
            case "intDash":
                //Convert it to YYYY-MM-DD
                return date("Y-m-d", $timestamp);
                break;
            case "intSlash":
                //Convert it to YYYY-MM-DD
                return date("Y/m/d", $timestamp);
                break;
            default:
                return date("d.m.Y", $timestamp);                  
        } 
    }

    /**
     * Berechnet die Altersklasse auf Basis des Geburtsjahres
     * @param int $yearOfBirth Geburtsjahrgang
     * @param int $grid Jahreszuschnitt der Alterklassen. Übernimmt die const AGEGROUPS aus der config.php
     * @return int Alterklasse 
     */
    public static function ageGroup($yearOfBirth, $grid = AGEGROUPS)
    {
        $age = date('Y') - $yearOfBirth;

        if ($age >= 20) { // is user older than 19?
            if ($grid == 10) {
                return floor(($age / 10)) * 10;
            } else {
                return floor(($age / 10) * 2) / 2 * 10;
            }
        } else { //
            return "Jugend";
        }
    }

    /**
     * Ermittelt die Geschlechterbezeichnung voll ausgeschrieben
     * @param str $gender Abkürzung des Geschlechts (M, W oder D)
     * @param int $grid Jahreszuschnitt der Alterklassen. Übernimmt die const AGEGROUPS aus der config.php
     * @return str Geschlechterbezeichnung voll ausgeschrieben (Männer, Frauen, Diverse)
     */
    public static function fullGender($gender)
    {
        switch ($gender) {
            case "M":
                echo  "Männer";
                break;
            case "W":
                return "Frauen";
                break;
            case "O":
                return "Diverse";
                break;
        }
    }

    /**
     * Verschickt ein E-Mail
     * @param str $to E-Mail Adresse des Empfängers
     * @param str $txt Inhaltstext der E-Mail
     * @return versendet E-Mail
     */
    public static function sendMail($to, $txt)
    {
        $subject = "1zF Registrierungscode";
       
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: anmeldung@1nzelzeitfahren.de";

        // use wordwrap() if lines are longer than 70 characters
        $txt = wordwrap($txt, 70);
        
        mail($to, $subject, $txt, $headers);
    }
}


?>