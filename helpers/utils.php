<?php

class Utils
{
    /**
     * Konvertiert ein Datum
     * @param date $date originales Datum
     * @param str $format euDot default, euSlash, intDot, intSlash 
     * @return date Datum in DD.MM.YYY (default) oder gewünschtem Format
     */
    public function convertDate($date, $format = "euDot")
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
}


?>