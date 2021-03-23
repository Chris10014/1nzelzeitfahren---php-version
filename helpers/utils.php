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

    public static function ageGroup($yearOfBirth, $grid = AGEGROUPS)
    {
        $age = date('Y') - $yearOfBirth;

        if ($grid == 10) {
            return floor(($age / 10)) * 10;
        } else {
            return floor(($age / 10) * 2) / 2 * 10;
        }
    }

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